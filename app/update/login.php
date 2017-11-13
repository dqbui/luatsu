<?php
/**
 * Created by PhpStorm.
 * User: mupisiri
 * Date: 5/14/17
 * Time: 22:57
 */

declare(strict_types=1);

session_start();

require_once dirname(__FILE__).'/../rsc/classes/User.php';

if(isset($_POST["language"])) {

  $login_page = strtolower($_POST["language"]) == "english" ? "/login.html" : "/login-vn.html";
  $home_page = strtolower($_POST["language"]) == "english" ? "/" : "/index-vn.html";

  if(isset($_POST["email"]) && isset($_POST["password"])) {
    $user = new User();
    $user->setEmail($_POST["email"]);
    $user->setPassword($_POST["password"]);
    $user->login();
    if($user->isLoggedIn()) {
      $_SESSION['logged']== true;
      
      header("Location: {$home_page}?msg={$_POST["email"]}");
    } else {
      $_SESSION['logged']== false;
      $msg = "invalid+email+username+combo";
      header("Location: {$login_page}?msg={$msg}");
    }
  } else {
    $msg = "You+are+missing+either+the+email+or+the+username";
    header("Location: {$login_page}?msg={$msg}");
  }

} else {
  $msg = "You+are+missing+the+language+params";
  header("Location: /login.html?msg={$msg}");
}