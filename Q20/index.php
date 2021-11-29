<?php require_once '../database.php';
$statmentOneRan = false;
$statmentTwoRan = false;
$statmentThreeRan = false;
$statmentFourRan = false;
if(isset($_POST['firstName']) && isset($_POST['lastName'])){
    $statement = $conn->prepare('SELECT firstName, lastName, dateOfBirth FROM People
                                 WHERE firstName = :firstName AND lastName = :lastName;');

    $statement->bindParam(':firstName', $_POST['firstName']);
    $statement->bindParam(':lastName', $_POST['lastName']);

    if($statement->execute()){
        if($statement->rowCount() > 0)
            $statmentOneRan = true;
    }

    $statementTwo = $conn->prepare('SELECT Appointments.nameOfFacility, Appointments.timeSlot, VaccinationFacility.address 
                                    FROM Appointments, VaccinationFacility
                                    WHERE Appointments.nameOfFacility = VaccinationFacility.nameOfFacility AND firstName =:firstName AND lastName = :lastName;');

    $statementTwo->bindParam(':firstName', $_POST['firstName']);
    $statementTwo->bindParam(':lastName', $_POST['lastName']);

    if($statementTwo->execute()){
        if($statementTwo->rowCount() > 0)
            $statmentTwoRan = true;
    }

    $statementThree = $conn->prepare('SELECT vaccineType, lotNumber, dateOfVaccination, nameOfFacility 
                                      FROM Vaccination
                                      WHERE patientFirstName = :firstName AND patientLastName = :lastName;');

    $statementThree->bindParam(':firstName', $_POST['firstName']);
    $statementThree->bindParam(':lastName', $_POST['lastName']);

    if($statementThree->execute()){
        if($statementThree->rowCount() > 0)
            $statmentThreeRan = true;
    }

    $statementFour = $conn->prepare('SELECT dateOfInfection FROM Infection
                                     WHERE firstName = :firstName AND lastName = :lastName;');

    $statementFour->bindParam(':firstName', $_POST['firstName']);
    $statementFour->bindParam(':lastName', $_POST['lastName']);

    if($statementFour->execute()){
        if($statementFour->rowCount() > 0)
            $statmentFourRan = true;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Person Report</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <?php if($statmentOneRan == false) { ?>
    <h1>Person to Get Report On</h1>
        <form action='./index.php' method='post'>
            <label for='firstName'>First Name</label> <br>
                <input type='text' name='firstName' id='firstName'> <br>
            <label for='lastName'>Last Name</label> <br>
                <input type='text' name='lastName' id='lastName'> <br>
            <button type='submit'>Submit</button> <br>
        </form>
        <a href='../'>Return to menu</a>
    <?php } 
    else { ?>
        <h1>Person Report</h1>
    <?php if ($statmentOneRan == true) { ?>
        <h1>User Information</h1>
        <table>
            <thead>
                <tr>
                    <td>First Name</td>
                    <td>Last Name</td>
                    <td>Date of Birth</td>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $statement->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                    <tr>
                        <td><?= $row['firstName'] ?></td>
                        <td><?= $row['lastName'] ?></td>
                        <td><?= $row['dateOfBirth'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>

    <?php if ($statmentTwoRan == true) { ?>
        <h1>Appointment Information</h1>
        <table>
            <thead>
                <tr>
                    <td>Facility Name</td>
                    <td>Time Slot</td>
                    <td>Address</td>
                </tr>
            </thead>
            <tbody>
                <?php while ($rowTwo = $statementTwo->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                    <tr>
                        <td><?= $rowTwo['nameOfFacility'] ?></td>
                        <td><?= $rowTwo['timeSlot'] ?></td>
                        <td><?= $rowTwo['address'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>

    <?php if ($statmentThreeRan == true) { ?>
        <h1>Vaccination Information</h1>
        <table>
            <thead>
                <tr>
                    <td>Vaccine Name</td>
                    <td>Lot Number</td>
                    <td>Date of Vaccination</td>
                    <td>Facility Name</td>
                </tr>
            </thead>
            <tbody>
                <?php while ($rowThree = $statementThree->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                    <tr>
                        <td><?= $rowThree['vaccineType'] ?></td>
                        <td><?= $rowThree['lotNumber'] ?></td>
                        <td><?= $rowThree['dateOfVaccination'] ?></td>
                        <td><?= $rowThree['nameOfFacility'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>

    <?php if ($statmentFourRan == true) { ?>
        <h1>Infection Information</h1>
        <table>
            <thead>
                <tr>
                    <td>Date Of Infection</td>
                </tr>
            </thead>
            <tbody>
                <?php while ($rowFour = $statementFour->fetch(PDO::FETCH_ASSOC, PDO::FETCH_ORI_NEXT)) { ?>
                    <tr>
                        <td><?= $rowFour['dateOfInfection'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } ?>
    <a href='../'>Return to menu</a>
<?php } ?>
</body>
</html>