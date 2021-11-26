<?php require_once '../database.php';

if(isset($_POST['name']) && isset($_POST['ageGroup'])) {
    $ageGroup = $conn->prepare(' INSERT INTO gnc353_2.Provinces (name, ageGroup)
                                    VALUES (:name, :ageGroup);');

    $ageGroup->bindParam(':name', $_POST['name']);
    $ageGroup->bindParam(':ageGroup', $_POST['ageGroup']);

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
    <title>Add Province</title>
</head>
<body>
    <h1>Province</h1>
    <form action='./create.php' method='post'>
        <label for='name'>Province Name</label> <br>
            <input type='text' name='name' id='name'> <br>
        <label for='ageGroup'>Age Group ID</label> <br>
            <input type='number' name='ageGroup' id='ageGroup'> <br>
        <button type='submit'>Submit</button> <br>
    </form>
    <a href='./index.php'>Back to province list</a>
</body>
</html>