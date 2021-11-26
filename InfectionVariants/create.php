<?php require_once '../database.php';

if(isset($_POST['nameOfVariant']) && isset($_POST['dateFound'])) {
    $infectionvariant = $conn->prepare(' INSERT INTO gnc353_2.InfectionVariants (InfectionVariants.nameOfVariant, InfectionVariants.dateFound)
                                    VALUES (:nameOfVariant, :dateFound);');

    $infectionvariant->bindParam(':nameOfVariant', $_POST['nameOfVariant']);
    $infectionvariant->bindParam(':dateFound', $_POST['dateFound']);

    if($infectionvariant->execute())
        header('Location: .');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Infection Variant</title>
</head>
<body>
    <h1>Infection Variant Creation</h1>
    <form action='./create.php' method='post'>
        <label for='nameOfVariant'>Variant Name</label> <br>
            <input type='text' name='nameOfVariant' id='nameOfVariant'> <br>
        <label for='dateFound'>Date Found</label> <br>
            <input type='date' name='dateFound' id='dateFound'> <br>
        <button type='submit'>Submit</button> <br>
    </form>
    <a href='./index.php'>Back to infection variant list</a>
</body>
</html>