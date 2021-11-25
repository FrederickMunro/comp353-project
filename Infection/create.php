<?php require_once '../database.php';

if(isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['nameOfInfection']) && isset($_POST['dateOfInfection'])) {
    $infection = $conn->prepare(' INSERT INTO gnc353_2.Infection (Infection.firstName, Infection.lastName, Infection.nameOfInfection, Infection.dateOfInfection)
                                    VALUES (:firstName, :lastName, :nameOfInfection, :dateOfInfection);');

    $infection->bindParam(':firstName', $_POST['firstName']);
    $infection->bindParam(':lastName', $_POST['lastName']);
    $infection->bindParam(':nameOfInfection', $_POST['nameOfInfection']);
    $infection->bindParam(':dateOfInfection', $_POST['dateOfInfection']);

    if($infection->execute())
        header('Location: .');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Infection</title>
</head>
<body>
    <h1>Infections</h1>
    <form action='./create.php' method='post'>
        <label for='firstName'>First Name</label> <br>
            <input type='text' name='firstName' id='firstName'> <br>
        <label for='lastName'>Last Name</label> <br>
            <input type='text' name='lastName' id='lastName'> <br>
        <label for='nameOfInfection'>Name of Infection</label> <br>
            <input type='text' name='nameOfInfection' id='nameOfInfection'> <br>
        <label for='dateOfInfection'>Date of Infection</label> <br>
            <input type='date' name='dateOfInfection' id='dateOfInfection'> <br>
        <button type='submit'>Submit</button> <br>
    </form>
    <a href='./index.php'>Back to infections list</a>
</body>
</html>