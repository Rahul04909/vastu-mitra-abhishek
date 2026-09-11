<?php
require_once __DIR__ . '/auth_init.php';

if ($auth->isLogged()) {
    $sessionHash = $_COOKIE[$config->cookie_name] ?? null;
    $auth->logout($sessionHash);
}

header('Location: login.php');
exit;
