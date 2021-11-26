<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM gnc353_2.Provinces AS Provinces');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Provinces</title>
</head>
<body>
    <h1>Province List</h1>
    <table>
        <thead>
            <tr>
                <td>Province Name</td>
                <td>Age Group ID</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['ageGroup'] ?></td>
                    <td>
                        <a href='./edit.php?name=<?= $row['name'] ?>'>Edit Age Group ID</a>
                        <a href='./delete.php?name=<?= $row['name'] ?>'>Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href='./create.php'>Add</a> <br>
    <a href='../'>Return to menu</a>
</body>
</html>