<?php
require('Database/database.php');

try
{
    $bdd = new PDO($DB_DSN, $DB_USER , $DB_PASSWORD);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $exception)
 { 
    die('Erreur : ' . $exception->getMessage());
 }
 ?>