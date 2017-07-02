<?php
/**
 * Created by PhpStorm.
 * User: mupisiri
 * Date: 3/30/17
 * Time: 16:41
 */

declare(strict_types=1);

require_once dirname(__FILE__).'/../rsc/classes/User.php';

$user = new User();

if(isset($_POST["language"])) {

  $sign_up_page = strtolower($_POST["language"]) == "english" ? "/signup.html" : "/signup-vn.html";
  $login_page = strtolower($_POST["language"]) == "english" ? "/login.html" : "/login-vn.html";

  if (isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["email"])
    && isset($_POST["password"]) && isset($_POST["retype-password"]) && isset($_POST["sex"])) {
    //before proceeding, make sure that the passwords that the user entered are the same
    if ($_POST["password"] == $_POST["retype-password"]) {
      $user->setFirstName($_POST["firstname"]);
      $user->setLastName($_POST["lastname"]);
      $user->setEmail($_POST["email"]);
      $user->setPassword($_POST["password"]);
      $user->setSex($_POST["sex"]);
      $user->createAccount();
      $user->login();
      if ($user->isLoggedIn()) {
        header('Location: /');
      } else {
        $msg = "invalid+email+username+combo";
        header("Location: {$login_page}?msg={$msg}");
      }
    } else {
      $msg = "retyped+password+is+not+the+same+as+the+actual+password";
      header("Location: {$sign_up_page}?msg={$msg}");
    }
  } else {
    $msg = "You+are+missing+some+parameters";
    header("Location: {$sign_up_page}?msg={$msg}");
  }

} else {
  $msg = "You+are+missing+the+language+params";
  header("Location: /signup.html?msg={$msg}");
}