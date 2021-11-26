<?php require_once '../database.php';

$statement = $conn->prepare('   DELETE FROM gnc353_2.Vaccines
                                WHERE vaccineType  = :vaccineType
                                AND statusOfVaccine  = :statusOfVaccine;');
$statement->bindParam(':vaccineType', $_GET['vaccineType']);
$statement->bindParam(':statusOfVaccine', $_GET['statusOfVaccine']);

$statement->execute();

header('Location: .');

?>