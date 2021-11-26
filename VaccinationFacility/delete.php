<?php require_once '../database.php';

$statement = $conn->prepare('DELETE FROM gnc353_2.VaccinationFacility WHERE VaccinationFacility.nameOfFacility = :nameOfFacility');
$statement->bindParam(':nameOfFacility', $_GET['nameOfFacility']);

$statement->execute();

header('Location: .');

?>