<?php require_once '../database.php';

$vaccinationFacility = $conn->prepare('SELECT * FROM gnc353_2.VaccinationFacility WHERE nameOfFacility = :nameOfFacility;');
$vaccinationFacility->bindParam(":nameOfFacility", $_GET['nameOfFacility']);
$vaccinationFacility->execute();
$vaccinationFacility = $vaccinationFacility->fetch(PDO::FETCH_ASSOC);


if(isset($_POST['managerID']) && isset($_POST['nameOfFacility']) && isset($_POST['operatingHours']) && isset($_POST['address']) && isset($_POST['phone']) &&
    isset($_POST['typeOfFacility']) && isset($_POST['capacity']) && isset($_POST['appointmentWalkIn']) && isset($_POST['webAddress']) && isset($_POST['numberOfWorkers'])) {
    $statement = $conn->prepare('UPDATE gnc353_2.VaccinationFacility 
                                    SET managerID = :managerID,
                                        nameOfFacility = :nameOfFacility,
                                        operatingHours = :operatingHours,
                                        address = :address,
                                        phone = :phone,
                                        typeOfFacility = :typeOfFacility,
                                        capacity = :capacity,
                                        appointmentWalkIn = :appointmentWalkIn,
                                        webAddress = :webAddress,
                                        numberOfWorkers = :numberOfWorkers
                                    WHERE nameOfFacility = :nameOfFacility;');

    if(!empty($_POST['managerID']))
        $statement->bindParam(':managerID', $_POST['managerID']);
    else{
        $managerID = NULL;
        $statement->bindParam(':managerID', $managerID);
    }
    $statement->bindParam(':nameOfFacility', $_POST['nameOfFacility']);
    $statement->bindParam(':operatingHours', $_POST['operatingHours']);
    $statement->bindParam(':address', $_POST['address']);
    $statement->bindParam(':phone', $_POST['phone']);
    $statement->bindParam(':typeOfFacility', $_POST['typeOfFacility']);
    $statement->bindParam(':capacity', $_POST['capacity']);
    $statement->bindParam(':appointmentWalkIn', $_POST['appointmentWalkIn']);
    $statement->bindParam(':webAddress', $_POST['webAddress']);
    $statement->bindParam(':numberOfWorkers', $_POST['numberOfWorkers']);

    if($statement->execute()) {
        header('Location: .');
    } else {
        header('Location: ./edit.php?nameOfFacility='.$_POST['nameOfFacility']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Vaccination Facility</title>
</head>
<body>
    <h1>Vaccination Facility Editing</h1>
    <form action='./edit.php' method='post'>
        <label for='managerID'>Manager ID</label> <br>
            <input type='number' name='managerID' id='managerID' value='<?= $vaccinationFacility['managerID'] ?? 'NULL' ?>'> <br>
        <label for='nameOfFacility'>Facility Name</label> <br>
            <input type='text' name='nameOfFacility' id='nameOfFacility' value='<?= $vaccinationFacility['nameOfFacility'] ?? 'NULL' ?>'> <br>
        <label for='operatingHours'>Operating Hours</label> <br>
            <input type='text' name='operatingHours' id='operatingHours' value='<?= $vaccinationFacility['operatingHours'] ?? 'NULL' ?>'> <br>
        <label for='address'>Address</label> <br>
            <input type='text' name='address' id='address' value='<?= $vaccinationFacility['address'] ?? 'NULL' ?>'> <br>
        <label for='phone'>Phone Number</label> <br>
            <input type='tel' name='phone' id='phone' value='<?= $vaccinationFacility['phone'] ?? '000-000-0000' ?>'> <br>
        <label for='typeOfFacility'>Job</label> <br>
            <input type='text' name='typeOfFacility' id='typeOfFacility' value='<?= $vaccinationFacility['typeOfFacility'] ?? 'NULL' ?>'> <br>
        <label for='capacity'>Capacity</label> <br>
            <input type='number' name='capacity' id='capacity' value='<?= $vaccinationFacility['capacity'] ?? '-1' ?>'> <br>
        <label for='appointmentWalkIn'>Appointment WalkIn</label> <br>
            <input type='text' name='appointmentWalkIn' id='appointmentWalkIn' value='<?= $vaccinationFacility['appointmentWalkIn'] ?? 'NULL' ?>'> <br>
        <label for='webAddress'>Web Address</label> <br>
            <input type='text' name='webAddress' id='webAddress' value='<?= $vaccinationFacility['webAddress'] ?? 'NULL' ?>'> <br>
        <label for='numberOfWorkers'>Number of Workers</label> <br>
            <input type='number' name='numberOfWorkers' id='numberOfWorkers' value='<?= $vaccinationFacility['numberOfWorkers'] ?? '-1' ?>'> <br>
        <button type='submit'>Submit</button> <br>
    </form>
    <a href='./index.php'>Back to vaccination facility list</a>
</body>
</html>