<?php
$sessionLifetime = 1800;
$sessionPath = '/';
$sessionDomain = '';
$sessionSecure = false;
$sessionHttpOnly = true;
ini_set('session.gc_maxlifetime', $sessionLifetime);
session_set_cookie_params(
    $sessionLifetime,
    $sessionPath,
    $sessionDomain,
    $sessionSecure,
    $sessionHttpOnly
);
session_start();
if (!isset($_SESSION['userId'])) {
    header('Location: index.php');
    exit;
}