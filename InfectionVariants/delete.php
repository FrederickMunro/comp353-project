<?php require_once '../database.php';

$statement = $conn->prepare('   DELETE FROM gnc353_2.InfectionVariants 
                                WHERE InfectionVariants.nameOfVariant = :nameOfVariant');
$statement->bindParam(':nameOfVariant', $_GET['nameOfVariant']);

$statement->execute();

header('Location: .');

?>