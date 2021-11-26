<?php require_once '../database.php';

if(isset($_POST['ageGroup']) && isset($_POST['ages']) && isset($_POST['groupValue'])) {
    $ageGroup = $conn->prepare(' INSERT INTO gnc353_2.GroupAge (ageGroup, ages, groupValue)
                                    VALUES (:ageGroup, :ages, :groupValue);');

    $ageGroup->bindParam(':ageGroup', $_POST['ageGroup']);
    $ageGroup->bindParam(':ages', $_POST['ages']);
    $ageGroup->bindParam(':groupValue', $_POST['groupValue']);

    if($ageGroup->execute())
        header('Location: .');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Group Age</title>
</head>
<body>
    <h1>Group Ages</h1>
    <form action='./create.php' method='post'>
        <label for='ageGroup'>Age Group</label> <br>
            <input type='number' name='ageGroup' id='ageGroup'> <br>
        <label for='ages'>Ages</label> <br>
            <input type='text' name='ages' id='ages'> <br>
        <label for='groupValue'>Group Values</label> <br>
            <input type='number' name='groupValue' id='groupValue'> <br>
        <button type='submit'>Submit</button> <br>
    </form>
    <a href='./index.php'>Back to group ages list</a>
</body>
</html>