<?php

declare(strict_types=1);

/**
 * Created by PhpStorm.
 * User: mupisiri
 * Date: 3/30/17
 * Time: 15:51
 */



class Lawyers {

  private $lawyers;
  private $type = "lawyer";

  public function __construct() {
    $this->lawyers = [];
  }

  /**
   * loads the lawyers from the database
   */
  public function load() {
    if($this->type != null && strlen($this->type) > 0) {
      //create a connection to the database
      require_once dirname(__FILE__).'/Connection.php';
      $connection = (new Connection());
      try {
        //connect to the database
        $conn = $connection->createConnection();
        $statement = $conn->prepare("SELECT * FROM accounts WHERE type=?");
        //bind the values to the statement
        $statement->bindValue(1, $this->type);
        $statement->execute();

        if ($statement->rowCount() > 0) {
          require_once 'User.php';
          //set the result into an associative array
          while($result = $statement->fetch(PDO::FETCH_ASSOC)) {
            $user = new User();
            //the id of the user
            $user->setId((int) $result["id"]);
            //the first name of the user
            $user->setFirstName($result["firstName"]);
            //the last name of the user
            $user->setLastName($result["lastName"]);
            //the sex of the user
            $user->setSex($result["sex"]);
            //the email of the user
            $user->setEmail($result["email"]);
            //the date of birth of the user
            $user->setDateOfBirth((int)$result["dateOfBirth"]);
            //the date that the user joined the network
            $user->setDateJoined((int) $result["dateJoined"]);
            //add the parameters that we want to load
            $user->setLoadParams(["id", "firstName", "lastname", "email", "password"]);
            //add the lawyers to the lawyers array
            $this->lawyers[] = $user;
          }
        }

        //close the db connection
        $conn = null;
      } catch (PDOException $e) {
        //close the db connection
        $conn = null;
        if ($connection->showError()) {
          die("Failed to load the account from the database with error : {$e->getMessage()}!");
        }
      }//catch
    }
  }//load

  /**
   * converts the array of user objects to an associative array recursively
   */
  public function toArray() {
    $lawyers = [];
    for($i = 0; $i < count($this->lawyers); $i++){
      $lawyers[$i] = $this->lawyers[$i]->toArray();
    }
    return $lawyers;
  }//toArray

}