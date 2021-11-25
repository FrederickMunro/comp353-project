<?php require_once '../database.php';

$statement = $conn->prepare('DELETE FROM gnc353_2.PublicHealthWorker WHERE PublicHealthWorker.employeeID = :employeeID AND PublicHealthWorker.nameOfFacility = :nameOfFacility AND PublicHealthWorker.startDate = :startDate;');
$statement->bindParam(':employeeID', $_GET['employeeID']);
$statement->bindParam(':nameOfFacility', $_GET['nameOfFacility']);
$statement->bindParam(':startDate', $_GET['startDate']);

$statement->execute();

header('Location: .');

?>