<?php
require_once '../helper/Database.php';
require_once '../src/View/Template.php';

$template = new Template();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: lobby.php");
        exit();
    } else {
        $template->render('login_form', ['error' => "Invalid username or password."]);
    }
} else {
    $template->render('login_form');
}
?>