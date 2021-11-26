<?php require_once '../database.php';

$vaccine = $conn->prepare('    SELECT * FROM gnc353_2.Vaccines 
                                    WHERE vaccineType = :vaccineType
                                    AND statusOfVaccine  = :statusOfVaccine;');
$vaccine->bindParam(':vaccineType', $_GET['vaccineType']);
$vaccine->bindParam(':statusOfVaccine', $_GET['statusOfVaccine']);
$vaccine->execute();
$vaccine = $vaccine->fetch(PDO::FETCH_ASSOC);


if(isset($_POST['vaccineType']) && isset($_POST['statusOfVaccine']) && isset($_POST['dateOfApproval']) && isset($_POST['suspensionDate'])) {
    $statement = $conn->prepare('   UPDATE gnc353_2.Vaccines 
                                    SET vaccineType = :vaccineType,
                                        statusOfVaccine = :statusOfVaccine,
                                        dateOfApproval = :dateOfApproval,
                                        suspensionDate = :suspensionDate
                                    WHERE vaccineType = :vaccineType
                                    AND statusOfVaccine  = :statusOfVaccine;');

    $statement->bindParam(':vaccineType', $_POST['vaccineType']);
    $statement->bindParam(':statusOfVaccine', $_POST['statusOfVaccine']);
    
    if(!empty($_POST['dateOfApproval']))
        $statement->bindParam(':dateOfApproval', $_POST['dateOfApproval']);
    else{
        $dateOfApproval = NULL;
        $statement->bindParam(':dateOfApproval', $dateOfApproval);
    }

    if(!empty($_POST['suspensionDate']))
        $statement->bindParam(':suspensionDate', $_POST['suspensionDate']);
    else{
        $suspensionDate = NULL;
        $statement->bindParam(':suspensionDate', $suspensionDate);
    }

    if($statement->execute()) {
        header('Location: .');
    } else {
        header('Location: ./edit.php?vaccineType='.$_POST['vaccineType'].'&statusOfVaccine='.$_POST['statusOfVaccine']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Vaccine</title>
</head>
<body>
    <h1>Vaccine Editing</h1>
    <form action='./edit.php' method='post'>
        <label for='vaccineType'>Vaccine Name</label> <br>
            <input type='text' name='vaccineType' id='vaccineType' value='<?= $vaccine['vaccineType'] ?? 'NULL' ?>'> <br>
        <label for='statusOfVaccine'>Vaccine Status</label> <br>
            <input type='text' name='statusOfVaccine' id='statusOfVaccine' value='<?= $vaccine['statusOfVaccine'] ?? 'NULL' ?>'> <br>
        <label for='dateOfApproval'>Approval Date</label> <br>
            <input type='date' name='dateOfApproval' id='dateOfApproval' value='<?= $vaccine['dateOfApproval'] ?? 'NULL' ?>'> <br>
        <label for='suspensionDate'>Suspension Date</label> <br>
            <input type='date' name='suspensionDate' id='suspensionDate' value='<?= $vaccine['suspensionDate'] ?? 'NULL' ?>'> <br>
        <button type='submit'>Submit</button> <br>
    </form>
    <a href='./index.php'>Back to vaccine list</a>
</body>
</html>