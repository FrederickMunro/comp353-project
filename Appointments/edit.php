<?php require_once '../database.php';

$appointments = $conn->prepare('    SELECT * FROM gnc353_2.Appointments 
                                    WHERE Appointments.nameOfFacility = :nameOfFacility 
                                        AND Appointments.timeSlot = :timeSlot;');
$appointments->bindParam(":nameOfFacility", $_GET['nameOfFacility']);
$appointments->bindParam(":timeSlot", $_GET['timeSlot']);
$appointments->execute();
$appointment = $appointments->fetch(PDO::FETCH_ASSOC);


if(isset($_POST['nameOfFacility']) && isset($_POST['timeSlot']) && isset($_POST['firstName']) && isset($_POST['lastName'])) {
    $statement = $conn->prepare('   UPDATE gnc353_2.Appointments 
                                    SET Appointments.nameOfFacility = :nameOfFacility,
                                        Appointments.timeSlot = :timeSlot
                                        Appointments.firstName = :firstName,
                                        Appointments.lastName = :lastName
                                    WHERE Appointments.nameOfFacility = :nameOfFacility 
                                        AND Appointments.timeSlot = :timeSlot;');

    $statement->bindParam(':nameOfFacility', $_POST['nameOfFacility']);
    $statement->bindParam(':timeSlot', $_POST['timeSlot']);
    $statement->bindParam(':firstName', $_POST['firstName']);
    $statement->bindParam(':lastName', $_POST['lastName']);

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
    <title>Edit Appointment</title>
</head>
<body>
    <h1>Appointment Editing</h1>
    <form action='./edit.php' method='post'>
        <label for='nameOfFacility'>Facility</label> <br>
            <input type='text' name='nameOfFacility' id='nameOfFacility' value='<?= $appointment['nameOfFacility'] ?? 'NULL' ?>' readonly> <br>
        <label for='timeSlot'>Time Slot</label> <br>
            <input type='datetime-local' name='timeSlot' id='timeSlot' value='<?= $appointment['timeSlot'] ?? '2010-10-10T10:10' ?>' readonly> <br>
        <label for='firstName'>First Name</label> <br>
            <input type='text' name='firstName' id='firstName' value='<?= $appointment['firstName'] ?? 'NULL' ?>'> <br>
        <label for='lastName'>Last Name</label> <br>
            <input type='text' name='lastName' id='lastName' value='<?= $appointment['lastName'] ?? 'NULL' ?>'> <br>
        <button type='submit'>Submit</button> <br>
    </form>
    <a href='./index.php'>Back to appointment list</a>
</body>
</html>