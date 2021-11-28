<?php require_once '../database.php';
$ran = false;
$noAppointment = false;
if(isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['middleInitial']) && isset($_POST['nameOfFacility'])) {
    $statement = $conn->prepare('SELECT * FROM Appointments
WHERE firstName = :firstName AND lastName = :lastName AND nameOfFacility = :nameOfFacility;');

    $statement->bindParam(':firstName', $_POST['firstName']);
    $statement->bindParam(':lastName', $_POST['lastName']);
    $statement->bindParam(':nameOfFacility', $_POST['nameOfFacility']);    

    if($statement->execute()){
        if($statement->rowCount() > 0)
            $noAppointment = false;
        else
            $noAppointment = true;
    }


    if(!$noAppointment){
        $row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);

        $doses = $conn->prepare('SELECT *
                                 FROM Vaccination 
                                 WHERE patientFirstName = :firstName;');
        $doses->bindParam(':firstName', $_POST['firstName']);

        if($doses->execute())
            $doseNumber = $doses->rowCount() + 1;

        $nurseID = $conn->prepare('SELECT *
                                   FROM PublicHealthWorker 
                                   WHERE nameOfFacility = :nameOfFacility AND typeOfWorker = "Nurse";');

        $nurseID->bindParam(':nameOfFacility', $_POST['nameOfFacility']); 

        $nurseID->execute();

        $rowTwo = $nurseID->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT);

        $vaccination = $conn->prepare('INSERT INTO gnc353_2.Vaccination (publicHealthWorkerID, patientFirstName, patientLastName, nameOfFacility, vaccineType, dateOfVaccination, doseNumber, lotNumber)
                                       VALUES (:publicHealthWorkerID, :patientFirstName, :patientLastName, :nameOfFacility, :vaccineType, :dateOfVaccination, :doseNumber, :lotNumber);'); 

        if($_POST['nameOfFacility'] == "Jean-Coutu"){
            $vaccineType = "Moderna";
            $lotNumber = "123JJ45";
        }

        if($_POST['nameOfFacility'] == "Children Hospital"){
            $vaccineType = "Johnson&Johnson";
            $lotNumber = "4323H212L";
        }

        if($_POST['nameOfFacility'] == "CLSC"){
            $vaccineType = "AstraZeneca";
            $lotNumber = "10934F04";
        }

        if($_POST['nameOfFacility'] == "Jewish-General"){
            $vaccineType = "Pfizer";
            $lotNumber = "495MG56";
        }

        $vaccination->bindParam(':publicHealthWorkerID', $rowTwo['employeeID']);
        $vaccination->bindParam(':patientFirstName', $_POST['firstName']);
        $vaccination->bindParam(':patientLastName', $_POST['lastName']);
        $vaccination->bindParam(':nameOfFacility', $_POST['nameOfFacility']);
        $vaccination->bindParam(':vaccineType',  $vaccineType);
        $vaccination->bindParam(':dateOfVaccination', $row['timeSlot']);
        $vaccination->bindParam(':doseNumber', $doseNumber);
        $vaccination->bindParam(':lotNumber', $lotNumber);

        if($vaccination->execute()){
            $ran = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php if($ran == false && $noAppointment == true) { ?>
    <h1>No Appointment Found!</h1>
    <a href='../'>Return to menu</a>
    <?php } 
    else if($ran == false && $noAppointment == false){ ?>
        <h1>Appointments</h1>
        <form action='./index.php' method='post'>
            <label for='firstName'>First Name</label> <br>
                <input type='text' name='firstName' id='firstName'> <br>
            <label for='lastName'>Last Name</label> <br>
                <input type='text' name='lastName' id='lastName'> <br>
            <label for='middleInitial'>Middle Initial</label> <br>
                <input type='text' name='middleInitial' id='middleInitial'> <br>
            <label for='nameOfFacility'>Facility Name</label> <br>
                <input type='text' name='nameOfFacility' id='nameOfFacility'> <br>
            <button type='submit'>Submit</button> <br>
        </form>
        <a href='../'>Return to menu</a>
    <?php } else if($ran == true) { ?>
    <h1>Vaccination Successful</h1>
    <a href='../'>Return to menu</a>
    <?php } ?>
</body>
</html>