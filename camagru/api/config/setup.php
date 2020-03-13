<?php

include_once('database.php');

// CREATE DATABASE
try {
        // Connect to Mysql server
		$pdo = new Database($DB_DSN, $DB_USER, $DB_PASSWORD, NULL);
		$dbh = $pdo->conn;
		$DB_NAME = "camagru";
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE `".$DB_NAME."`";
        $dbh->exec($sql);
        echo "Database created successfully\n";
    } catch (PDOException $e) {
        echo "ERROR \n".$e->getMessage();
        exit(-1);
    }
    
// CREATE TABLE COMMENT
try {
        $pdo = new Database($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh = $pdo->conn;
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `comment` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `comment` varchar(255) NOT NULL,
            `post_id` int(11) NOT NULL,
            `user_id` int(11) NOT NULL DEFAULT '8',
            PRIMARY KEY (`id`)
          )";
        $dbh->exec($sql);
        echo "Table created \n";
    } catch (PDOException $e) {
         echo "ERROR \n".$e->getMessage();
    }
// CREATE TABLE POST
try {
        $pdo = new Database($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbh = $pdo->conn;
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `post` (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `user_id` int(11) NOT NULL,
			  `src` varchar(255) NOT NULL,
			  `likes` int(11) DEFAULT '0',
			  `deslikes` int(11) DEFAULT '0',
			  PRIMARY KEY (`id`)
			)";
        $dbh->exec($sql);
        echo "Table created \n";
    } catch (PDOException $e) {
         echo "ERROR \n".$e->getMessage();
    }

  // CREATE TABLE USERS
try {
        $pdo = new Database($DB_DSN, $DB_USER, $DB_PASSWORD);
    $dbh = $pdo->conn;
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `user` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `name` varchar(45) NOT NULL,
      `email` varchar(255) NOT NULL,
      `password` varchar(255) NOT NULL,
      `token` varchar(255) NOT NULL,
      `token_validate` varchar(45) NOT NULL,
      `account_status` varchar(45) NOT NULL,
      `notifications` int(11) NOT NULL DEFAULT '1',
      PRIMARY KEY (`id`)
    )";
        $dbh->exec($sql);
        echo "Table created";
    } catch (PDOException $e) {
         echo "ERROR \n".$e->getMessage();
    }


?>

