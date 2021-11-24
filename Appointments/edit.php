<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM gnc353_2.Appointments AS Appointment WHERE Appointment.nameOfFacility = :nameOfFacility AND Appointment.timeSlot = :timeSlot;');
$statement->bindParam(":nameOfFacility", $_GET['nameOfFacility']);
$statement->bindParam(":timeSlot", $_GET['timeSlot']);
$statement->execute();
$appointment = $statement->fetch(PDO::FETCH_ASSOC);


if(isset($_POST['nameOfFacility']) && isset($_POST['timeSlot']) && isset($_POST['firstName']) && isset($_POST['lastName'])) {
    $appointment = $conn->prepare('UPDATE gnc353_2.Appointments 
                                    SET firstName = :firstName,
                                        lastName = :lastName,
                                    WHERE nameOfFacility = :nameOfFacility,
                                        timeSlot = :timeSlot');

    $appointment->bindParam(':nameOfFacility', $_POST['nameOfFacility']);
    $appointment->bindParam(':timeSlot', $_POST['timeSlot']);
    $appointment->bindParam(':firstName', $_POST['firstName']);
    $appointment->bindParam(':lastName', $_POST['lastName']);

    if($appointment->execute())
        header('Location: .');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment</title>
</head>
<body>
    <h1><?= $statement->errorInfo()[0]; ?></h1>
    <form action='./create.php' method='post'>
        <label for='nameOfFacility'>Facility</label> <br>
            <input type='text' name='nameOfFacility' id='nameOfFacility' value='<?= $appointment['nameOfFacility'] ?? 'NULL' ?>'> <br>
        <label for='timeSlot'>Time Slot</label> <br>
            <input type='datetime-local' name='timeSlot' id='timeSlot' value='<?= $appointment['timeSlot'] ?? '2010-10-10T10:10' ?>'> <br>
        <label for='firstName'>First Name</label> <br>
            <input type='text' name='firstName' id='firstName' value='<?= $appointment['firstName'] ?? 'NULL' ?>'> <br>
        <label for='lastName'>Last Name</label> <br>
            <input type='text' name='lastName' id='lastName' value='<?= $appointment['lastName'] ?? 'NULL' ?>'> <br>
        <button type='submit'>Submit</button> <br>
    </form>
    <a href='./index.php'>Back to appointment list</a>
</body>
</html>