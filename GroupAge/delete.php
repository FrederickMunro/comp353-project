<?php require_once '../database.php';

$statement = $conn->prepare('   DELETE FROM gnc353_2.GroupAge
                                WHERE ageGroup  = :ageGroup;');
$statement->bindParam(':ageGroup', $_GET['ageGroup']);

$statement->execute();

header('Location: .');

?>