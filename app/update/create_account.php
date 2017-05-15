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

if(isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["email"])
  && isset($_POST["password"]) && isset($_POST["sex"])) {

  $user->setFirstName($_POST["firstname"]);
  $user->setLastName($_POST["lastname"]);
  $user->setEmail($_POST["email"]);
  $user->setPassword($_POST["password"]);
  $user->setSex($_POST["sex"]);
  $user->createAccount();
  //$user->setLoadParams(["firstName", "LastName", "email", "dateJoined"]);
  //$user->load();
  $user->login();
  if($user->isLoggedIn()) {
    header('Location: /');
  } else {
    $msg = "invalid+email+username+combo";
    header("Location: /login.html?msg={$msg}");
  }
} else {
  echo json_encode(["status"=>"failure", "message"=>"missing variables"]);
}