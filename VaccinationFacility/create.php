<?php require_once '../database.php';

if(isset($_POST['managerID']) && isset($_POST['nameOfFacility']) && isset($_POST['operatingHours']) && isset($_POST['address']) && isset($_POST['phone']) &&
    isset($_POST['typeOfFacility']) && isset($_POST['capacity']) && isset($_POST['appointmentWalkIn']) && isset($_POST['webAddress']) && isset($_POST['numberOfWorkers'])) {
    $vaccinationFacility = $conn->prepare('INSERT INTO gnc353_2.VaccinationFacility (managerID , nameOfFacility , operatingHours , address , phone, typeOfFacility, capacity, appointmentWalkIn, webAddress,numberOfWorkers)
                                 VALUES (:managerID, :nameOfFacility , :operatingHours , :address , :phone, :typeOfFacility, :capacity, :appointmentWalkIn, :webAddress, :numberOfWorkers);');
    
    if(!empty($_POST['managerID']))
        $vaccinationFacility->bindParam(':managerID', $_POST['managerID']);
    else{
        $managerID = NULL;
        $vaccinationFacility->bindParam(':managerID', $managerID);
    }
    $vaccinationFacility->bindParam(':nameOfFacility', $_POST['nameOfFacility']);
    $vaccinationFacility->bindParam(':operatingHours', $_POST['operatingHours']);
    $vaccinationFacility->bindParam(':address', $_POST['address']);
    $vaccinationFacility->bindParam(':phone', $_POST['phone']);
    $vaccinationFacility->bindParam(':typeOfFacility', $_POST['typeOfFacility']);
    $vaccinationFacility->bindParam(':capacity', $_POST['capacity']);
    $vaccinationFacility->bindParam(':appointmentWalkIn', $_POST['appointmentWalkIn']);
    $vaccinationFacility->bindParam(':webAddress', $_POST['webAddress']);
    $vaccinationFacility->bindParam(':numberOfWorkers', $_POST['numberOfWorkers']);

    if($vaccinationFacility->execute())
        header('Location: .');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vaccination Facility</title>
</head>
<body>
    <h1>Vaccination Facility Creation</h1>
    <form action='./create.php' method='post'>
        <label for='managerID'>Manager ID</label> <br>
            <input type='number' name='managerID' id='managerID'> <br>
        <label for='nameOfFacility'>Facility Name</label> <br>
            <input type='text' name='nameOfFacility' id='nameOfFacility'> <br>
        <label for='operatingHours'>Operating Hours</label> <br>
            <input type='text' name='operatingHours' id='operatingHours'> <br>
        <label for='address'>Address</label> <br>
            <input type='text' name='address' id='address'> <br>
        <label for='phone'>Phone Number</label> <br>
            <input type='tel' name='phone' id='phone'> <br>
        <label for='typeOfFacility'>Type of Facility</label> <br>
            <input type='text' name='typeOfFacility' id='typeOfFacility'> <br>
        <label for='capacity'>Capacity</label> <br>
            <input type='number' name='capacity' id='capacity'> <br>
        <label for='appointmentWalkIn'>Appointment WalkIn</label> <br>
            <input type='text' name='appointmentWalkIn' id='appointmentWalkIn'> <br>
        <label for='webAddress'>Web Address</label> <br>
            <input type='text' name='webAddress' id='webAddress'> <br>
        <label for='numberOfWorkers'>Number of Workers</label> <br>
            <input type='number' name='numberOfWorkers' id='numberOfWorkers'> <br>
        <button type='submit'>Submit</button> <br>
    </form>
    <a href='./index.php'>Back to vaccination facility list</a>
</body>
</html>