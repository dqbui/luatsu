<?php

/**
 * Created by PhpStorm.
 * User: mupisiri
 * Date: 3/30/17
 * Time: 16:01
 */
class Connection {

  private $error_reporting = true;

  /**
   * creates a connection to the millennial media network
   * @return PDO, the connection to the mysql database via PDO
   */
  public function createConnection() {
    $connection = new PDO("mysql:host=localhost;dbname=lawyers", "root", "tendai10");
    $connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    return $connection;
  }

  /**
   * @return bool, true to show db errors or false otherwise
   */
  public function showError():bool{
    return $this->error_reporting;
  }

}