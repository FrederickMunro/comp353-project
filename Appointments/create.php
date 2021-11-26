<?php require_once '../database.php';

if(isset($_POST['nameOfFacility']) && isset($_POST['timeSlot']) && isset($_POST['firstName']) && isset($_POST['lastName'])) {
    $appointment = $conn->prepare(' INSERT INTO gnc353_2.Appointments (Appointments.nameOfFacility, Appointments.timeSlot, Appointments.firstName, Appointments.lastName)
                                    VALUES (:nameOfFacility, :timeSlot, :firstName, :lastName);');

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
    <title>Add Appointment</title>
</head>
<body>
    <h1>Appointment Creation</h1>
    <form action='./create.php' method='post'>
        <label for='nameOfFacility'>Facility</label> <br>
            <input type='text' name='nameOfFacility' id='nameOfFacility'> <br>
        <label for='timeSlot'>Time Slot</label> <br>
            <input type='datetime-local' name='timeSlot' id='timeSlot'> <br>
        <label for='firstName'>First Name</label> <br>
            <input type='text' name='firstName' id='firstName'> <br>
        <label for='lastName'>Last Name</label> <br>
            <input type='text' name='lastName' id='lastName'> <br>
        <button type='submit'>Submit</button> <br>
    </form>
    <a href='./index.php'>Back to appointment list</a>
</body>
</html>