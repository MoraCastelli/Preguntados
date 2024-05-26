<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require_once '../helper/Database.php';
require_once '../src/View/Template.php';

$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT full_name, score FROM users WHERE id = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();

$stmt = $pdo->prepare("SELECT * FROM games WHERE user_id = ?");
$stmt->execute([$userId]);
$games = $stmt->fetchAll();

$template = new Template();
$template->render('lobby', ['user' => $user, 'games' => $games]);
?>