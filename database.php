<?php
$server = 'localhost:3306';
$username = 'root';
$password = '';
$database = 'gnc353_2';

try {
    $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?>