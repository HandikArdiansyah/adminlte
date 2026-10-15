<?php
// Remember Me
if (isset($_POST['remember_me'])) {
    setcookie('username', $username, time() + (86400 * 30), "/"); // 30 hari
} else {
    if (isset($_COOKIE['username'])) {
        setcookie('username', '', time() - 3600, "/"); // Hapus cookie
    }
}