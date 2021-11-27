<?php require_once '../database.php';

$statement = $conn->prepare('   DELETE FROM gnc353_2.Infection
                                WHERE Infection.firstName = :firstName 
                                    AND Infection.lastName = :lastName
                                    AND Infection.dateOfInfection = :dateOfInfection;');
$statement->bindParam(':firstName', $_GET['firstName']);
$statement->bindParam(':lastName', $_GET['lastName']);
$statement->bindParam(':dateOfInfection', $_GET['dateOfInfection']);

$statement->execute();

header('Location: .');

?>