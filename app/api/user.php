<?php
/**
 * Created by PhpStorm.
 * User: mupisiri
 * Date: 5/14/17
 * Time: 23:46
 */
require_once '../rsc/classes/User.php';
$user = new User();

if(isset($_GET["email"])) {
  //set the type of the users we want to load
  $user->setEmail($_GET["email"]);
  //load the user
  $user->load();
  //set the load parameters
  $user->setLoadParams(["firstName", "lastName", "email", "sex"]);
  //print out the available user information
  echo json_encode(
    ["status"=>"success", "payload"=>$user->toArray(),"message"=>"none"]
  );
} else {
  echo json_encode(
    ["status"=>"failure", "payload"=>[],"message"=>"missing one or all of the get parameters"]
  );
}