<?php

/**
 * Created by PhpStorm.
 * User: mupisiri
 * Date: 3/30/17
 * Time: 15:51
 */

declare(strict_types=1);

class User {

  private $first_name;
  private $last_name;
  private $email;
  private $password;
  private $date_of_birth;
  private $sex;
  private $date_joined;
  private $id;
  private $load_params;

  public function __construct() {
    $this->first_name = "";
    $this->last_name = "";
    $this->email = "";
    $this->password = "";
    $this->date_of_birth = time();
    $this->sex = "";
    $this->date_joined = time();
    $this->load_params = [];
    $this->id = -1;
  }

  /**
   * @return array
   */
  public function getLoadParams(): array {
    return $this->load_params;
  }

  /**
   * @param array $load_params
   */
  public function setLoadParams(array $load_params) {
    $this->load_params = $load_params;
  }

  /**
   * @return int
   */
  public function getId(): int {
    return $this->id;
  }

  /**
   * @param int $id
   */
  public function setId(int $id) {
    $this->id = $id;
  }

  /**
   * @return string
   */
  public function getFirstName(): string {
    return $this->first_name;
  }

  /**
   * @param string $first_name
   */
  public function setFirstName(string $first_name) {
    $this->first_name = $first_name;
  }

  /**
   * @return string
   */
  public function getLastName(): string {
    return $this->last_name;
  }

  /**
   * @param string $last_name
   */
  public function setLastName(string $last_name) {
    $this->last_name = $last_name;
  }

  /**
   * @return string
   */
  public function getEmail(): string {
    return $this->email;
  }

  /**
   * @param string $email
   */
  public function setEmail(string $email) {
    $this->email = $email;
  }

  /**
   * @return string
   */
  public function getPassword(): string {
    return $this->password;
  }

  /**
   * @param string $password
   */
  public function setPassword(string $password) {
    $this->password = $password;
  }

  /**
   * @return int
   */
  public function getDateOfBirth(): int {
    return $this->date_of_birth;
  }

  /**
   * @param int $date_of_birth
   */
  public function setDateOfBirth(int $date_of_birth) {
    $this->date_of_birth = $date_of_birth;
  }

  /**
   * @return string
   */
  public function getSex(): string {
    return $this->sex;
  }

  /**
   * @param string $sex
   */
  public function setSex(string $sex) {
    $this->sex = $sex;
  }

  /**
   * @return int
   */
  public function getDateJoined(): int {
    return $this->date_joined;
  }

  /**
   * @param int $date_joined
   */
  public function setDateJoined(int $date_joined) {
    $this->date_joined = $date_joined;
  }

  public function createAccount() {
    require_once dirname(__FILE__).'/Connection.php';
    $connection = new Connection();
    try {
      $conn = $connection->createConnection();
      $statement = $conn->prepare(
        "INSERT INTO accounts (`firstName`, `lastName`, `sex`, `email`,".
        " `password`, `dateOfBirth`, `dateJoined`) VALUES (?, ?, ?, ?, ?, ?, ?)"
      );
      $statement->execute([
        $this->first_name,
        $this->last_name,
        $this->sex,
        $this->email,
        $this->password,
        $this->date_of_birth,
        $this->date_joined
      ]);
      //add the user's created id to the current object
      $this->id = (int)$conn->lastInsertId();
      //close the db connection
      $conn = null;
    } catch (PDOException $e) {
      //close the db connection
      $conn = null;
      if($connection->showError()) {
        die("Failed to create account with error : {$e->getMessage()}");
      }
    }//catch
  }

  /**
   * loads an account from the server
   */
  public function load() {
    if($this->id != -1 || strlen($this->email) > 0) {
      //create a connection to the database
      require_once dirname(__FILE__).'/Connection.php';
      $connection = (new Connection());
      try {
        //connect to the database
        $conn = $connection->createConnection();
        $statement = $conn->prepare("SELECT * FROM accounts WHERE id=? OR email=?");
        //bind the values to the statement
        $statement->bindValue(1, $this->id);
        $statement->bindValue(2, $this->email);
        $statement->execute();
        if ($statement->rowCount() > 0) {
          //set the result into an associative array
          $result = $statement->fetch(PDO::FETCH_ASSOC);
          //the id of the user
          $this->id = (int)$result["id"];
          //the first name of the user
          $this->first_name = $result["firstName"];
          //the last name of the user
          $this->last_name = $result["lastName"];
          //the sex of the user
          $this->sex = $result["sex"];
          //the email of the user
          $this->email = $result["email"];
          //the date of birth of the user
          $this->date_of_birth = $result["dateOfBirth"];
          //the date that the user joined the network
          $this->date_joined = (int) $result["dateJoined"];
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
   * deletes an account from the server
   */
  public function deleteAccount() {
    //create a connection to the database
    require_once dirname(__FILE__).'/Connection.php';
    $connection = new Connection();
    try {
      //connect to the database
      $conn = $connection->createConnection();
      $statement = $conn->prepare("DELETE FROM accounts WHERE id=? OR email=?");
      //bind the values to the statement
      $statement->bindValue(1, $this->id);
      $statement->bindValue(1, $this->email);
      $statement->execute();
      //close the db connection
      $conn = null;
    } catch (PDOException $e) {
      //close the db connection
      $conn = null;
      if($connection->showError()) {
        die("Failed to delete account from the database with error : {$e->getMessage()}");
      }
    }//catch
  }//deleteAccount

  /**
   * @return bool, true is the account exists and false otherwise
   */
  public function accountExists(): bool {
    //create a connection to the database
    require_once dirname(__FILE__).'/Connection.php';
    $connection = new Connection();
    try {
      if($this->email != null && $this->password != null) {
        //connect to the database
        $conn = $connection->createConnection();
        $statement = $conn->prepare("SELECT * FROM accounts WHERE email=? AND password=?");
        //bind the values to the statement
        $statement->bindValue(1, $this->email);
        $statement->bindValue(2, $this->password);
        $statement->execute();
        //close the db connection
        $conn = null;
        //get the number of rows
        return $statement->rowCount() > 0;
      }
    } catch (PDOException $e) {
      //close the db connection
      $conn = null;
      if($connection->showError()) {
        die("Failed to check if the account exists with error : {$e->getMessage()}");
      }
    }//catch
    return false;
  }//accountExists

  /**
   * logs into an existing account
   */
  public function login() {
    //login if the account exists
    if($this->accountExists()) {
      $_SESSION["id"] = $this->id;
      $_SESSION["email"] = $this->email;
    }
  }//login

  /**
   * @return bool, true if the user is logged in
   */
  public function isLoggedIn(): bool{
    return isset($_SESSION["id"]) && isset($_SESSION["email"]);
  }//isLoggedIn

  /**
   * logs into an existing account
   */
  public function logout() {

  }//login

  /**
   * @return array, converts the current object to an array
   */
  public function toArray(): array {
    $object_arr = [];
    if(in_array("id", array_keys($this->load_params))) {
      $object_arr["id"] = (string)$this->id;
    }
    if(in_array("firstName", array_keys($this->load_params))) {
      $object_arr["firstName"] = $this->first_name;
    }
    if(in_array("lastName", array_keys($this->load_params))) {
      $object_arr["lastName"] = $this->last_name;
    }
    if(in_array("sex", array_keys($this->load_params))) {
      $object_arr["sex"] = $this->sex;
    }
    if(in_array("email", array_keys($this->load_params))) {
      $object_arr["email"] = $this->email;
    }
    if(in_array("dateOfBirth", array_keys($this->load_params))) {
      $object_arr["dateOfBirth"] = (string)$this->date_of_birth;
    }
    if(in_array("dateJoined", array_keys($this->load_params))) {
      $object_arr["dateJoined"] = (string)$this->date_joined;
    }
    return $object_arr;
  }//toArray

}