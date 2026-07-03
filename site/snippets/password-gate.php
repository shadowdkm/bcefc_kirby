<?php
/**
 * Password Gate Snippet
 * Simple shared-password gate for pages with password_protected enabled.
 *
 * @var \Kirby\Cms\Page $page
 */

$correctPassword = (string)option('bcefc.protectPassword', '');
$sessionKey    = 'bcefc_content_unlocked';
$attemptsKey   = 'bcefc_gate_attempts';
$lockUntilKey  = 'bcefc_gate_lock_until';
$maxAttempts   = 5;
$lockSeconds   = 60;

$session = $kirby->session();
$error   = false;
$locked  = false;

$lockUntil = (int)$session->get($lockUntilKey, 0);
if ($lockUntil > time()) {
    $locked = true;
}

if (
    $locked === false &&
    $correctPassword !== '' &&
    $kirby->request()->is('POST')
) {
    // Guard against non-string submissions (e.g. gate_password[]=x)
    // before ever touching them, so malformed input can't trigger a
    // PHP type-conversion warning.
    $rawToken    = $kirby->request()->get('csrf');
    $rawPassword = $kirby->request()->get('gate_password');
    $submittedToken    = is_string($rawToken) ? $rawToken : '';
    $submittedPassword = is_string($rawPassword) ? $rawPassword : '';

    if (csrf($submittedToken) && hash_equals($correctPassword, $submittedPassword)) {
        $session->set($sessionKey, true);
        $session->remove($attemptsKey);
        $session->remove($lockUntilKey);
        go($page->url());
    }

    $error = true;
    $attempts = (int)$session->get($attemptsKey, 0) + 1;

    if ($attempts >= $maxAttempts) {
        $session->set($lockUntilKey, time() + $lockSeconds);
        $session->set($attemptsKey, 0);
        $locked = true;
    } else {
        $session->set($attemptsKey, $attempts);
    }
}
?>
<section class="password-gate">
  <div class="container password-gate__inner">
    <span class="password-gate__icon">
      <svg class="icon" aria-hidden="true"><use href="#icon-lock"></use></svg>
    </span>
    <h1 class="password-gate__title"><?= $page->title()->esc() ?></h1>

    <?php if ($locked): ?>
    <p class="password-gate__text"><?= t('protect.locked', 'Too many incorrect attempts. Please wait a minute before trying again.') ?></p>
    <?php else: ?>
    <p class="password-gate__text"><?= t('protect.prompt', 'This page is password protected. Please enter the password to continue.') ?></p>

    <?php if ($error): ?>
    <p class="password-gate__error"><?= t('protect.error', 'Incorrect password. Please try again.') ?></p>
    <?php endif ?>

    <form method="POST" class="password-gate__form">
      <input type="hidden" name="csrf" value="<?= csrf() ?>">
      <label for="gate_password" class="sr-only"><?= t('protect.password_label', 'Password') ?></label>
      <input
        type="password"
        id="gate_password"
        name="gate_password"
        placeholder="<?= t('protect.password_label', 'Password') ?>"
        autocomplete="off"
        autofocus
        required
      >
      <button type="submit" class="btn btn-primary"><?= t('protect.submit', 'Enter') ?></button>
    </form>
    <?php endif ?>
  </div>
</section>
