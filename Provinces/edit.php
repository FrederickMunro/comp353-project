<?php require_once '../database.php';

$province = $conn->prepare('    SELECT * FROM gnc353_2.Provinces 
                                    WHERE name = :name;');
$province->bindParam(":name", $_GET['name']);
$province->execute();
$province = $province->fetch(PDO::FETCH_ASSOC);


if(isset($_POST['name']) && isset($_POST['ageGroup'])) {
    $statement = $conn->prepare('   UPDATE gnc353_2.Provinces 
                                    SET name = :name,
                                        ageGroup = :ageGroup
                                    WHERE name = :name;');

    $statement->bindParam(':name', $_POST['name']);
    $statement->bindParam(':ageGroup', $_POST['ageGroup']);

    if($statement->execute()) {
        header('Location: .');
    } else {
        header('Location: ./edit.php?name='.$_POST['name']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Province</title>
</head>
<body>
    <h1>Province Editing</h1>
    <form action='./edit.php' method='post'>
        <label for='name'>Ages</label> <br>
            <input type='text' name='name' id='name' value='<?= $province['name'] ?? 'NULL' ?>' readonly> <br>
        <label for='ageGroup'>Age Group</label> <br>
            <input type='number' name='ageGroup' id='ageGroup' value='<?= $province['ageGroup'] ?? 'NULL' ?>'> <br>
        <button type='submit'>Submit</button> <br>
    </form>
    <a href='./index.php'>Back to province list</a>
</body>
</html>