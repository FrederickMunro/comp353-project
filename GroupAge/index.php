<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM gnc353_2.GroupAge AS GroupAge');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Age Groups</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h1>Age Group List</h1>
    <table>
        <thead>
            <tr>
                <td>Age Group ID</td>
                <td>Ages</td>
                <td>Group Value</td>
                <td>Options</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row['ageGroup'] ?></td>
                    <td><?= $row['ages'] ?></td>
                    <td><?= $row['groupValue'] ?></td>
                    <td>
                        <a href='./edit.php?ageGroup=<?= $row['ageGroup'] ?>'>Edit</a>
                        <a href='./delete.php?ageGroup=<?= $row['ageGroup'] ?>'>Delete</a>
                    </td>

                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href='./create.php'>Add</a> <br>
    <a href='../'>Return to menu</a>
</body>
</html>