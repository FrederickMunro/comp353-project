<?php require_once '../database.php';

$Infection = $conn->prepare('    SELECT * FROM gnc353_2.Infection 
                                    WHERE Infection.firstName = :firstName 
                                        AND Infection.lastName = :lastName
                                        AND Infection.dateOfInfection = :dateOfInfection;');
$Infection->bindParam(":firstName", $_GET['firstName']);
$Infection->bindParam(":lastName", $_GET['lastName']);
$Infection->bindParam(":dateOfInfection", $_GET['dateOfInfection']);
$Infection->execute();
$infections = $Infection->fetch(PDO::FETCH_ASSOC);


if(isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['nameOfInfection']) && isset($_POST['dateOfInfection'])) {
    $statement = $conn->prepare('   UPDATE gnc353_2.Infection 
                                    SET Infection.firstName = :firstName,
                                        Infection.lastName = :lastName,
                                        Infection.nameOfInfection = :nameOfInfection,
                                        Infection.dateOfInfection = :dateOfInfection
                                    WHERE Infection.firstName = :firstName 
                                        AND Infection.lastName = :lastName
                                        AND Infection.dateOfInfection = :dateOfInfection;');

    $statement->bindParam(':firstName', $_POST['firstName']);
    $statement->bindParam(':lastName', $_POST['lastName']);
    $statement->bindParam(':nameOfInfection', $_POST['nameOfInfection']);
    $statement->bindParam(':dateOfInfection', $_POST['dateOfInfection']);

    if($statement->execute()) {
        header('Location: .');
    } else {
        header('Location: ./editInfection.php?firstName='.$_POST['firstName'].'&lastName='.$_POST['lastName'].'&dateOfInfection='.$_POST['dateOfInfection']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Infection</title>
</head>
<body>
    <h1>Infection Editing</h1>
    <form action='./editInfection.php' method='post'>
        <label for='firstName'>First Name</label> <br>
            <input type='text' name='firstName' id='firstName' value='<?= $infections['firstName'] ?? 'NULL' ?>' readonly> <br>
        <label for='lastName'>Last Name</label> <br>
            <input type='text' name='lastName' id='lastName' value='<?= $infections['lastName'] ?? '2010-10-10T10:10' ?>' readonly> <br>
        <label for='nameOfInfection'>Name of Infection</label> <br>
            <input type='text' name='nameOfInfection' id='nameOfInfection' value='<?= $infections['nameOfInfection'] ?? 'NULL' ?>'> <br>
        <label for='dateOfInfection'>Date of Infection</label> <br>
            <input type='date' name='dateOfInfection' id='dateOfInfection' readonly value='<?= $infections['dateOfInfection'] ?? 'NULL' ?>'> <br>
        <button type='submit'>Submit</button> <br>
    </form>
    <a href='./index.php'>Back to people list</a>
</body>
</html>