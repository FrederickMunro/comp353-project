<?php require_once '../database.php';

$statement = $conn->prepare('   DELETE FROM gnc353_2.Provinces
                                WHERE name = :name;');
$statement->bindParam(':name', $_GET['name']);

$statement->execute();

header('Location: .');

?>