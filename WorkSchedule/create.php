<?php require_once '../database.php';

if(isset($_POST['publicHealthWorkerID']) && isset($_POST['nameOfFacility']) && isset($_POST['dayOfWeek'])) {
    $workSchedule = $conn->prepare(' INSERT INTO gnc353_2.WorkSchedule (publicHealthWorkerID, nameOfFacility, dayOfWeek)
                                    VALUES (:publicHealthWorkerID, :nameOfFacility, :dayOfWeek);');

    $workSchedule->bindParam(':publicHealthWorkerID', $_POST['publicHealthWorkerID']);
    $workSchedule->bindParam(':nameOfFacility', $_POST['nameOfFacility']);
    $workSchedule->bindParam(':dayOfWeek', $_POST['dayOfWeek']);

    if($workSchedule->execute())
        header('Location: .');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add A Work Schedule</title>
</head>
<body>
    <h1>Work Schedule</h1>
    <form action='./create.php' method='post'>
        <label for='publicHealthWorkerID'>Public Health Worker ID</label> <br>
            <input type='number' name='publicHealthWorkerID' id='publicHealthWorkerID'> <br>
        <label for='nameOfFacility'>Facility Name</label> <br>
            <input type='text' name='nameOfFacility' id='nameOfFacility'> <br>
        <label for='dayOfWeek'>Date</label> <br>
            <input type='date' name='dayOfWeek' id='dayOfWeek'> <br>
        <button type='submit'>Submit</button> <br>
    </form>
    <a href='./index.php'>Back to work schedule list</a>
</body>
</html>