<?php require_once '../database.php';

$statement = $conn->prepare('DELETE FROM gnc353_2.Appointments WHERE Appointments.nameOfFacility = :nameOfFacility AND Appointments.timeSlot = :timeSlot');
$statement->bindParam(':nameOfFacility', $_GET['nameOfFacility']);
$statement->bindParam(':timeSlot', $_GET['timeSlot']);

$statement->execute();

header('Location: .');

?>