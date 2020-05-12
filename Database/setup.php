<?php
require 'database.php';

function setup($dbh,$dbname)
{
    $sql = "DROP DATABASE IF EXISTS ".$dbname;
	$result = $dbh->exec($sql);
	$sql = "CREATE DATABASE IF NOT EXISTS ".$dbname;
	$result = $dbh->exec($sql);
	$sql = "USE ".$dbname;
    $result = $dbh->exec($sql);
    
    $sql = "CREATE TABLE users (
    user VARCHAR(32) NOT NULL PRIMARY KEY,
    passwd VARCHAR(255) NOT NULL,
    mail VARCHAR(128) NOT NULL,
    date_user DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
    confirmkey TEXT NOT NULL,
    confirm_account INT(1) NOT NULL DEFAULT 0,
    n_mdp INT(1) NOT NULL DEFAULT 0
        )";
    $result = $dbh->exec($sql);

    $sql = "CREATE TABLE images (
    id_image INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    user_image VARCHAR(32) NOT NULL,
    date_image DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_img_user FOREIGN KEY (user_image) REFERENCES users(user)
    )";
    $result = $dbh->exec($sql);

    $sql = "CREATE TABLE commentaires (
    com_id INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    commentaire VARCHAR(255) NOT NULL,
    com_user VARCHAR(32) NOT NULL,
    com_id_image INT(10) NOT NULL,
    CONSTRAINT fk_com_user FOREIGN KEY (com_user) REFERENCES users(user),
    CONSTRAINT fk_com_image FOREIGN KEY (com_id_image) REFERENCES images(id_image)
    )";
    $result = $dbh->exec($sql);

    $sql = "CREATE TABLE likes (
    id_like INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    liked INT(1) NOT NULL,
    likes_user VARCHAR(32) NOT NULL,
    likes_id_image INT(10) NOT NULL,
    CONSTRAINT fk_likes_user FOREIGN KEY (likes_user) REFERENCES users(user),
    CONSTRAINT fk_likes_id FOREIGN KEY (likes_id_image) REFERENCES images(id_image)
    )";
    $result = $dbh->exec($sql);
}

$dsn = "mysql:host=".$DB_HOST;
$db = new PDO(  
    $dsn,
    $DB_USER,
    $DB_PASSWORD
            );
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
setup($db,$DB_NAME);
echo 'setup completed'.PHP_EOL;
?>