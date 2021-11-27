<?php require_once '../database.php';

$workSchedule = $conn->prepare('    SELECT * FROM gnc353_2.WorkSchedule 
                                    WHERE publicHealthWorkerID = :publicHealthWorkerID;');
$workSchedule->bindParam(":publicHealthWorkerID", $_GET['publicHealthWorkerID']);
$workSchedule->execute();
$workSchedule = $workSchedule->fetch(PDO::FETCH_ASSOC);


if(isset($_POST['publicHealthWorkerID']) && isset($_POST['nameOfFacility']) && isset($_POST['dayOfWeek'])) {
    $statement = $conn->prepare('   UPDATE gnc353_2.WorkSchedule 
                                    SET publicHealthWorkerID = :publicHealthWorkerID,
                                        nameOfFacility = :nameOfFacility,
                                        dayOfWeek = :dayOfWeek
                                    WHERE publicHealthWorkerID = :publicHealthWorkerID;');

    $statement->bindParam(':publicHealthWorkerID', $_POST['publicHealthWorkerID']);
    $statement->bindParam(':nameOfFacility', $_POST['nameOfFacility']);
    $statement->bindParam(':dayOfWeek', $_POST['dayOfWeek']);

    if($statement->execute()) {
        header('Location: .');
    } else {
        header('Location: ./edit.php?publicHealthWorkerID='.$_POST['publicHealthWorkerID']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Work Schedule</title>
</head>
<body>
    <h1>Work Schedule Editing</h1>
    <form action='./edit.php' method='post'>
        <label for='publicHealthWorkerID'>Public Health Worker ID</label> <br>
            <input type='number' name='publicHealthWorkerID' id='publicHealthWorkerID' value='<?= $workSchedule['publicHealthWorkerID'] ?? 'NULL' ?>'> <br>
        <label for='nameOfFacility'>Facility Name</label> <br>
            <input type='text' name='nameOfFacility' id='nameOfFacility' value='<?= $workSchedule['nameOfFacility'] ?? 'NULL' ?>'> <br>
        <label for='dayOfWeek'>Date</label> <br>
            <input type='date' name='dayOfWeek' id='dayOfWeek' value='<?= $workSchedule['dayOfWeek'] ?? 'NULL' ?>'> <br>

        <button type='submit'>Submit</button> <br>
    </form>
    <a href='./index.php'>Back to work schedule list</a>
</body>
</html>