<?php
require_once "../libs/Startup.php";
Startup::_init(true);
use helpers\Validator;
use models\User;

$username = $_POST['username'];
$password = $_POST['password'];
$repeated_password = $_POST['repeated_password'];
$email = $_POST['email'];
$full_name = $_POST['full_name'];


$is_username_valid = Validator::exists($username);
$is_password_valid = Validator::exists($password);
$is_repeated_password_valid = Validator::exists($repeated_password) && Validator::arePasswordsEqual($password, $repeated_password);
$is_email_valid = Validator::exists($email) && Validator::isValidEmail($email);
$is_full_name_valid = Validator::exists($full_name);

if (!($is_username_valid && $is_password_valid && $is_repeated_password_valid && $is_email_valid && $is_full_name_valid)) {
    header('Location: ../views/RegisterView.php?username=' . json_encode($is_username_valid) . '&password=' . json_encode($is_password_valid) . '&repeated_password=' . json_encode($is_repeated_password_valid) . '&email=' . json_encode($is_email_valid) . '&full_name=' . json_encode($is_full_name_valid));
} else {
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $user = User::create($username, $password_hash, $email, $full_name);
    try {
    	$user->insert();
    	header('Location: ../views/HomePageView.php');
    } catch (Exception $ex) {
    	http_response_code(500);
 		header('Location: ../views/Error.php?message=Server error.&status_code=500');
    }
}
?> 