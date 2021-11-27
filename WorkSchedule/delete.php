<?php require_once '../database.php';

$statement = $conn->prepare('   DELETE FROM gnc353_2.WorkSchedule
                                WHERE publicHealthWorkerID  = :publicHealthWorkerID;');
$statement->bindParam(':publicHealthWorkerID', $_GET['publicHealthWorkerID']);

$statement->execute();

header('Location: .');

?>