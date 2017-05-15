<?php
/**
 * Created by PhpStorm.
 * User: mupisiri
 * Date: 5/14/17
 * Time: 20:21
 */

require_once '../rsc/classes/Lawyers.php';

$lawyers = new Lawyers();
//load the lawyers
$lawyers->load();
//print out the available lawyers
echo json_encode($lawyers->toArray());