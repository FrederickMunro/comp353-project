<?php require_once '../database.php';

if(isset($_POST['employeeID']) && isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['SSN']) &&
    isset($_POST['nameOfFacility']) && isset($_POST['typeOfWorker']) && isset($_POST['hourlyWage']) && isset($_POST['startDate']) && isset($_POST['endDate'])) {
    $publicHW = $conn->prepare('INSERT INTO gnc353_2.PublicHealthWorker (employeeID, firstName, lastName, SSN, nameOfFacility, typeOfWorker, hourlyWage, startDate, endDate)
                                                VALUES (:employeeID, :firstName, :lastName, :SSN, :nameOfFacility, :typeOfWorker, :hourlyWage, :startDate, :endDate);');

    $publicHW->bindParam(':employeeID', $_POST['employeeID']);
    $publicHW->bindParam(':firstName', $_POST['firstName']);
    $publicHW->bindParam(':lastName', $_POST['lastName']);
    $publicHW->bindParam(':SSN', $_POST['SSN']);
    $publicHW->bindParam(':nameOfFacility', $_POST['nameOfFacility']);
    $publicHW->bindParam(':typeOfWorker', $_POST['typeOfWorker']);
    $publicHW->bindParam(':hourlyWage', $_POST['hourlyWage']);
    $publicHW->bindParam(':startDate', $_POST['startDate']);
    $publicHW->bindParam(':endDate', $_POST['endDate']);

    if($publicHW->execute())
        header('Location: .');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Public Health Worker</title>
</head>
<body>
    <h1>Public Health Worker Hiring</h1>
    <form action='./create.php' method='post'>
        <label for='employeeID'>Employee ID</label> <br>
            <input type='number' name='employeeID' id='employeeID'> <br>
        <label for='firstName'>First Name</label> <br>
            <input type='text' name='firstName' id='firstName'> <br>
        <label for='lastName'>Last Name</label> <br>
            <input type='text' name='lastName' id='lastName'> <br>
        <label for='SSN'>SSN</label> <br>
            <input type='text' name='SSN' id='SSN'> <br>
        <label for='nameOfFacility'>Facility Name</label> <br>
            <input type='text' name='nameOfFacility' id='nameOfFacility'> <br>
        <label for='typeOfWorker'>Job</label> <br>
            <input type='text' name='typeOfWorker' id='typeOfWorker'> <br>
        <label for='hourlyWage'>Hourly Wage</label> <br>
            <input type='number' name='hourlyWage' id='hourlyWage'> <br>
        <label for='startDate'>Start Date</label> <br>
            <input type='date' name='startDate' id='startDate'> <br>
        <label for='endDate'>End Date</label> <br>
            <input type='date' name='endDate' id='endDate'> <br>
        <button type='submit'>Submit</button> <br>
    </form>
    <a href='./index.php'>Back to public health worker list</a>
</body>
</html>