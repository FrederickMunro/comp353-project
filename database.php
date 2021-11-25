<?php
$dbServername = "gnc353.encs.concordia.ca:3306";
$dbUsername = "gnc353_2";
$dbPassword = "Gam3Day7";
$dbName = "gnc353_2";

try {
    $conn = new PDO("mysql:host=$dbServername;dbname=$dbName;", $dbUsername, $dbPassword);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

?>