<?php require_once '../database.php';

$groupAge = $conn->prepare('    SELECT * FROM gnc353_2.GroupAge 
                                    WHERE ageGroup = :ageGroup;');
$groupAge->bindParam(":ageGroup", $_GET['ageGroup']);
$groupAge->execute();
$groupAge = $groupAge->fetch(PDO::FETCH_ASSOC);


if(isset($_POST['ageGroup']) && isset($_POST['ages']) && isset($_POST['groupValue'])) {
    $statement = $conn->prepare('   UPDATE gnc353_2.GroupAge 
                                    SET ageGroup = :ageGroup,
                                        ages = :ages,
                                        groupValue = :groupValue
                                    WHERE ageGroup = :ageGroup;');

    $statement->bindParam(':ageGroup', $_POST['ageGroup']);
    $statement->bindParam(':ages', $_POST['ages']);
    $statement->bindParam(':groupValue', $_POST['groupValue']);

    if($statement->execute()) {
        header('Location: .');
    } else {
        header('Location: ./edit.php?ageGroup='.$_POST['ageGroup']);
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
    <form action='./edit.php' method='post'>
        <label for='ageGroup'>Age Group</label> <br>
            <input type='number' name='ageGroup' id='ageGroup' value='<?= $groupAge['ageGroup'] ?? 'NULL' ?>'> <br>
        <label for='ages'>Ages</label> <br>
            <input type='text' name='ages' id='ages' value='<?= $groupAge['ages'] ?? 'NULL' ?>'> <br>
        <label for='groupValue'>Group Values</label> <br>
            <input type='number' name='groupValue' id='groupValue' value='<?= $groupAge['groupValue'] ?? 'NULL' ?>'> <br>
        <button type='submit'>Submit</button> <br>
    </form>
    <a href='./index.php'>Back to group age list</a>
</body>
</html>