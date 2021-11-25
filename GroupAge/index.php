<?php require_once '../database.php';

$statement = $conn->prepare('SELECT * FROM gnc353_2.GroupAge');
$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Age Groups</title>
</head>
<body>
    <h1>Age Groups</h1>
    <table>
        <thead>
            <tr>
                <td>Age Group</td>
                <td>Ages</td>
                <td>Group Value</td>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                <tr>
                    <td><?= $row['ageGroup'] ?></td>
                    <td><?= $row['ages'] ?></td>
                    <td><?= $row['groupValue'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <a href='../'>Return to menu</a>
</body>
</html>