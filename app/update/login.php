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

if(isset($_POST["email"]) && isset($_POST["password"])) {
  $user = new User();
  $user->setEmail($_POST["email"]);
  $user->setPassword($_POST["password"]);
  $user->login();
  if($user->isLoggedIn()) {
    header('Location: /');
  } else {
    $msg = "invalid+email+username+combo";
    header("Location: /login.html?msg={$msg}");
  }
} else {
  $msg = "You+are+missing+either+the+email+or+the+username";
  header("Location: /login.html?msg={$msg}");
}