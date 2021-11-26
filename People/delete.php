<?php require_once '../database.php';

$statement = $conn->prepare('   DELETE FROM gnc353_2.People 
                                WHERE People.firstName = :firstName 
                                    AND People.lastName = :lastName
                                    AND People.middleInitial = :middleInitial;');
$statement->bindParam(':firstName', $_GET['firstName']);
$statement->bindParam(':lastName', $_GET['lastName']);
$statement->bindParam(':middleInitial', $_GET['middleInitial']);

$statement->execute();

header('Location: .');

?>