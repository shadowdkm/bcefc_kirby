<?php

// prepend a fake host to ensure that PHP can parse the path even if it contains weird stuff;
// afterwards just take the plain path back out from the parsed result
$uri = parse_url('https://getkirby.com/' . ltrim($_SERVER['REQUEST_URI'], '/'), PHP_URL_PATH) ?? '/';
$uri = urldecode($uri);

// emulate the .htaccess rules that block direct access to the
// content, site and kirby folders, and to dotfiles like .git —
// the PHP built-in server has no concept of mod_rewrite, so without
// this a request like /content/some/page/file.txt or /.git/config
// would be served as a plain static file, bypassing any
// template-level logic (e.g. password gates) or exposing repo internals
$relativePath = ltrim($uri, '/');
$isBlockedFolder = false;
foreach (['content/', 'site/', 'kirby/'] as $prefix) {
	if (str_starts_with($relativePath, $prefix)) {
		$isBlockedFolder = true;
		break;
	}
}
$isDotfile = (bool)preg_match('#(^|/)\.(?!well-known(/|$))#', $relativePath);

if ($isBlockedFolder || $isDotfile) {
	$_SERVER['SCRIPT_NAME'] = '/index.php';
	require $_SERVER['DOCUMENT_ROOT'] . $_SERVER['SCRIPT_NAME'];
	return true;
}

// emulate Apache's `mod_rewrite` functionality, but prevent
// disclosure of the existence of files outside the document root
$path = $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim($uri, '/');
if (
	$uri !== '/' &&
	file_exists($path) === true &&
	substr(realpath($path), 0, strlen($_SERVER['DOCUMENT_ROOT'])) === $_SERVER['DOCUMENT_ROOT']
) {
	return false;
}

$_SERVER['SCRIPT_NAME'] = '/index.php';

require $_SERVER['DOCUMENT_ROOT'] . $_SERVER['SCRIPT_NAME'];
