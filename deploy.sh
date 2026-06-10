#!/usr/bin/env bash
# deploy.sh — SSH into server and pull latest code from GitHub
# Usage: bash deploy.sh

set -euo pipefail

SCRIPT_DIR="$(cd "$(dirname "$0")" && pwd)"
ENV_FILE="$SCRIPT_DIR/deploy.env"

if [ ! -f "$ENV_FILE" ]; then
  echo "ERROR: deploy.env not found."
  echo "Copy deploy.env.example to deploy.env and fill in your server details."
  exit 1
fi

source "$ENV_FILE"

: "${DEPLOY_HOST:?Set DEPLOY_HOST in deploy.env}"
: "${DEPLOY_USER:?Set DEPLOY_USER in deploy.env}"
: "${DEPLOY_PATH:?Set DEPLOY_PATH in deploy.env}"

DEPLOY_PORT="${DEPLOY_PORT:-22}"
SSH_OPTS="-p $DEPLOY_PORT -o StrictHostKeyChecking=accept-new"
if [ -n "${DEPLOY_KEY:-}" ]; then
  SSH_OPTS="$SSH_OPTS -i $DEPLOY_KEY"
fi

echo ""
echo "  Server : $DEPLOY_USER@$DEPLOY_HOST:$DEPLOY_PATH"
echo ""
read -r -p "Deploy now? (y/N) " CONFIRM
[[ "$CONFIRM" =~ ^[Yy]$ ]] || { echo "Aborted."; exit 0; }

echo ""
ssh $SSH_OPTS "$DEPLOY_USER@$DEPLOY_HOST" bash << REMOTE
  set -e
  cd "$DEPLOY_PATH"

  echo "→ Fixing file ownership..."
  sudo chown -R "${DEPLOY_USER}:www-data" "$DEPLOY_PATH"
  sudo chmod -R 775 "$DEPLOY_PATH"

  echo "→ Pulling from GitHub..."
  git pull origin master

  echo "→ Updating Composer dependencies..."
  composer install --no-dev --optimize-autoloader --quiet

  echo "→ Clearing Kirby cache..."
  rm -rf media/cache site/cache/* 2>/dev/null || true

  echo ""
  echo "Deploy complete."
REMOTE
