<?php
/**
 * Created by PhpStorm.
 * User: mupisiri
 * Date: 5/14/17
 * Time: 20:21
 */
require_once '../rsc/classes/Users.php';
$users = new Users();

if(isset($_GET["type"]) && isset($_GET["count"])) {
  //set the type of the users we want to load
  $users->setType($_GET["type"]);
  //set the number of users that you want to load
  $users->setCount((int)$_GET["count"]);
  //load the lawyers
  $users->load();
  //print out the available lawyers
  echo json_encode(
    ["status"=>"success", "payload"=>$users->toArray(),"message"=>"none"]
  );
} else {
  echo json_encode(
    ["status"=>"failure", "payload"=>$users->toArray(),"message"=>"missing one or all of the get parameters"]
  );
}

