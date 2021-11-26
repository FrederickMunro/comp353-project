<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM gnc353_2.Infection');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infections</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1>List of Infections</h1>
    <table>
        <thead>
            <tr>
                <td>First Name</td>
                <td>Last Name</td>
                <td>Name of Infection</td>
                <td>Date of Infection</td>
                <td>Options</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row['firstName'] ?></td>
                    <td><?= $row['lastName'] ?></td>
                    <td><?= $row['nameOfInfection'] ?></td>
                    <td><?= $row['dateOfInfection'] ?></td>
                    <td>
                        <a href='./edit.php?firstName=<?= $row['firstName'] ?>&lastName=<?= $row['lastName'] ?>&dateOfInfection=<?= $row['dateOfInfection'] ?>'>Edit</a>
                        <a href='./delete.php?firstName=<?= $row['firstName'] ?>&lastName=<?= $row['lastName'] ?>&dateOfInfection=<?= $row['dateOfInfection'] ?>'>Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href='./create.php'>Add</a> <br>
    <a href='../'>Return to menu</a>
</body>
</html>