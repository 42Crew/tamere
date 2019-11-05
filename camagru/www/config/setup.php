#!/usr/bin/php
<?php
  include 'database.php';

  try {
      $bdd = new PDO($DB_DSN_LIGHT, $DB_USER, $DB_PASSWORD);
      $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "CREATE DATABASE IF NOT EXISTS `$DB_NAME`";
      $bdd->exec($sql);
      echo "Database created successfully\n";
  } catch(PDOException $e) {
      echo 'Connection failed: \n ' . $e->getMessage(). "\n";
      exit(-1);
  }

  try {
      $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
      $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "CREATE TABLE IF NOT EXISTS `users` (
        `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        `username` VARCHAR(30) NOT NULL,
        `mail` VARCHAR(100) NOT NULL,
        `password` VARCHAR(256) NOT NULL,
        `flag`  VARCHAR(50)NOT NULL,
        `verified` VARCHAR(1) NOT NULL DEFAULT 'N'
      )";
      $bdd->exec($sql);
      echo "Table users created successfully\n";
} catch (PDOException $e) {
      echo "ERROR CREATING TABLE: ".$e->getMessage(). "\n";
}


?>

