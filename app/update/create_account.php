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
  && isset($_POST["pwd"]) && isset($_POST["gender"])) {

  $user->setFirstName($_POST["firstname"]);
  $user->setLastName($_POST["lastname"]);
  $user->setEmail($_POST["email"]);
  $user->setPassword($_POST["pwd"]);
  $user->setSex($_POST["gender"]);
  $user->createAccount();
  $user->setLoadParams(["firstName", "LastName", "email", "dateJoined"]);
  $user->load();
  echo json_encode($user->toArray());
  header('Location: http://www.luatsu.com');
} else {

}