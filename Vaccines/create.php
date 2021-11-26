<?php require_once '../database.php';

if(isset($_POST['vaccineType']) && isset($_POST['statusOfVaccine']) && isset($_POST['dateOfApproval']) && isset($_POST['suspensionDate'])) {
    $vaccines = $conn->prepare(' INSERT INTO gnc353_2.Vaccines (vaccineType, statusOfVaccine, dateOfApproval, suspensionDate)
                                    VALUES (:vaccineType, :statusOfVaccine, :dateOfApproval, :suspensionDate);');

    $vaccines->bindParam(':vaccineType', $_POST['vaccineType']);
    $vaccines->bindParam(':statusOfVaccine', $_POST['statusOfVaccine']);
    
    if(!empty($_POST['dateOfApproval']))
        $vaccines->bindParam(':dateOfApproval', $_POST['dateOfApproval']);
    else{
        $dateOfApproval = NULL;
        $vaccines->bindParam(':dateOfApproval', $dateOfApproval);
    }

    if(!empty($_POST['suspensionDate']))
        $vaccines->bindParam(':suspensionDate', $_POST['suspensionDate']);
    else{
        $suspensionDate = NULL;
        $vaccines->bindParam(':suspensionDate', $suspensionDate);
    }

    if($vaccines->execute())
        header('Location: .');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Vaccine</title>
</head>
<body>
    <h1>Vaccines</h1>
    <form action='./create.php' method='post'>
        <label for='vaccineType'>Vaccine Name</label> <br>
            <input type='text' name='vaccineType' id='vaccineType'> <br>
        <label for='statusOfVaccine'>Vaccine Status</label> <br>
            <input type='text' name='statusOfVaccine' id='statusOfVaccine'> <br>
        <label for='dateOfApproval'>Approval Date</label> <br>
            <input type='date' name='dateOfApproval' id='dateOfApproval'> <br>
        <label for='suspensionDate'>Suspension Date</label> <br>
            <input type='date' name='suspensionDate' id='suspensionDate'> <br>
        <button type='submit'>Submit</button> <br>
    </form>
    <a href='./index.php'>Back to vaccines list</a>
</body>
</html>