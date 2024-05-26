<?php
require_once '../helper/Database.php';
require_once '../src/Util/Validator.php';
require_once '../src/Util/EmailSender.php';
require_once '../src/View/Template.php';

$template = new Template();
$database =

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = $_POST['full_name'];
    $birthYear = $_POST['birth_year'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $username = $_POST['username'];
    $profilePicture = $_FILES['profile_picture'];

    $validator = new Validator();

    if ($validator->validateRegistration($fullName, $birthYear, $gender, $country, $city, $email, $password, $confirmPassword, $username, $profilePicture)) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $profilePicturePath = 'uploads/' . basename($profilePicture['name']);
        move_uploaded_file($profilePicture['tmp_name'], $profilePicturePath);



        $stmt = $pdo->prepare("INSERT INTO users (full_name, birth_year, gender, country, city, email, password, username, profile_picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$fullName, $birthYear, $gender, $country, $city, $email, $hashedPassword, $username, $profilePicturePath])) {
            $emailSender = new EmailSender();
            $emailSender->sendVerificationEmail($email);
            $template->render('register_form', ['success' => "Registration successful. Please check your email to verify your account."]);
        } else {
            $template->render('register_form', ['error' => "Registration failed. Please try again."]);
        }
    } else {
        $template->render('register_form', ['error' => "Validation failed. Please check your input."]);
    }
} else {
    $template->render('register_form');
}
?>