<?php require_once '../database.php';

$publicHW = $conn->prepare('SELECT * FROM gnc353_2.PublicHealthWorker AS PublicHealthWorker WHERE PublicHealthWorker.employeeID = :employeeID AND PublicHealthWorker.nameOfFacility = :nameOfFacility AND PublicHealthWorker.startDate = :startDate;');
$publicHW->bindParam(":employeeID", $_GET['employeeID']);
$publicHW->bindParam(":nameOfFacility", $_GET['nameOfFacility']);
$publicHW->bindParam(":startDate", $_GET['startDate']);
$publicHW->execute();
$publicHW = $publicHW->fetch(PDO::FETCH_ASSOC);


if(isset($_POST['employeeID']) && isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['SSN']) &&
    isset($_POST['nameOfFacility']) && isset($_POST['typeOfWorker']) && isset($_POST['hourlyWage']) && isset($_POST['startDate']) && isset($_POST['endDate'])) {
    $statement = $conn->prepare('UPDATE gnc353_2.PublicHealthWorker 
                                    SET employeeID = :employeeID,
                                        firstName = :firstName,
                                        lastName = :lastName,
                                        SSN = :SSN,
                                        nameOfFacility = :nameOfFacility,
                                        typeOfWorker = :typeOfWorker,
                                        hourlyWage = :hourlyWage,
                                        startDate = :startDate,
                                        endDate = :endDate
                                    WHERE employeeID = :employeeID AND
                                        nameOfFacility = :nameOfFacility AND 
                                        startDate = :startDate;');

    $statement->bindParam(':employeeID', $_POST['employeeID']);
    $statement->bindParam(':firstName', $_POST['firstName']);
    $statement->bindParam(':lastName', $_POST['lastName']);
    $statement->bindParam(':SSN', $_POST['SSN']);
    $statement->bindParam(':nameOfFacility', $_POST['nameOfFacility']);
    $statement->bindParam(':typeOfWorker', $_POST['typeOfWorker']);
    $statement->bindParam(':hourlyWage', $_POST['hourlyWage']);
    $statement->bindParam(':startDate', $_POST['startDate']);
    $statement->bindParam(':endDate', $_POST['endDate']);

    if($statement->execute()) {
        header('Location: .');
    } else {
        header('Location: ./edit.php?nameOfFacility='.$_POST['nameOfFacility'].'&timeSlot='.$_POST['timeSlot']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Public Health Worker</title>
</head>
<body>
    <h1>Public Health Worker Editing</h1>
    <form action='./edit.php' method='post'>
        <label for='employeeID'>Employee ID</label> <br>
            <input type='number' name='employeeID' id='employeeID' value='<?= $publicHW['employeeID'] ?? 'NULL' ?>'readonly> <br>
        <label for='firstName'>First Name</label> <br>
            <input type='text' name='firstName' id='firstName' value='<?= $publicHW['firstName'] ?? 'NULL' ?>'readonly> <br>
        <label for='lastName'>Last Name</label> <br>
            <input type='text' name='lastName' id='lastName' value='<?= $publicHW['lastName'] ?? 'NULL' ?>'readonly> <br>
        <label for='SSN'>SSN</label> <br>
            <input type='text' name='SSN' id='SSN' value='<?= $publicHW['SSN'] ?? 'NULL' ?>'readonly> <br>
        <label for='nameOfFacility'>Facility Name</label> <br>
            <input type='text' name='nameOfFacility' id='nameOfFacility' value='<?= $publicHW['nameOfFacility'] ?? 'NULL' ?>'> <br>
        <label for='typeOfWorker'>Job</label> <br>
            <input type='text' name='typeOfWorker' id='typeOfWorker' value='<?= $publicHW['typeOfWorker'] ?? 'NULL' ?>'> <br>
        <label for='hourlyWage'>Hourly Wage</label> <br>
            <input type='number' name='hourlyWage' id='hourlyWage' value='<?= $publicHW['hourlyWage'] ?? 'NULL' ?>'> <br>
        <label for='startDate'>Start Date</label> <br>
            <input type='date' name='startDate' id='startDate' value='<?= $publicHW['startDate'] ?? 'NULL' ?>' readonly> <br>
        <label for='endDate'>End Date</label> <br>
            <input type='date' name='endDate' id='endDate' value='<?= $publicHW['endDate'] ?? '2010-10-10T10:10' ?>'> <br>
        <button type='submit'>Submit</button> <br>
    </form>
    <a href='./index.php'>Back to Public Health Worker list</a>
</body>
</html>