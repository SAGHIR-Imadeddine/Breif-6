<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'scrum master') {
    header('Location: login.php');
    exit;
}

?>