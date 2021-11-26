<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM gnc353_2.InfectionVariants');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infection Variants</title>
</head>
<body>
    <h1>Infection Variant List</h1>
    <table>
        <thead>
            <tr>
                <td>Name of Variant</td>
                <td>Date Found</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row['nameOfVariant'] ?></td>
                    <td><?= $row['dateFound'] ?></td>
                    <td>
                        <a href='./delete.php?nameOfVariant=<?= $row['nameOfVariant'] ?>&dateFound=<?= $row['dateFound'] ?>'>Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href='./create.php'>Add</a> <br>
    <a href='../'>Return to menu</a>
</body>
</html>