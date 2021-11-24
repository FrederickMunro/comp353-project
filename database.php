<?php
$server = 'gnc353.encs.concordia.ca:3306';
$username = 'gnc353_2';
$password = 'Gam3Day7';
$database = 'gnc353_2';

try {
    $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?>