<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'product owner') {
    header('Location: login.php');
    exit;
}

?>