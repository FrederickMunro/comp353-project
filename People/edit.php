<?php require_once '../database.php';

$peoples = $conn->prepare('    SELECT * FROM gnc353_2.People 
                                    WHERE firstName = :firstName
                                        AND lastName = :lastName
                                        AND middleInitial = :middleInitial;');
$peoples->bindParam(":firstName", $_GET['firstName']);
$peoples->bindParam(":lastName", $_GET['lastName']);
$peoples->bindParam(":middleInitial", $_GET['middleInitial']);
$peoples->execute();
$people = $peoples->fetch(PDO::FETCH_ASSOC);

if( isset($_POST['firstName']) && 
    isset($_POST['lastName']) && 
    isset($_POST['middleInitial']) &&
    isset($_POST['dateOfBirth']) && 
    isset($_POST['medicareCardNumber']) && 
    isset($_POST['issueDateOfMedicare']) &&
    isset($_POST['expiryDateOfMedicare']) && 
    isset($_POST['telephone']) && 
    isset($_POST['address']) &&
    isset($_POST['city']) && 
    isset($_POST['Province']) && 
    isset($_POST['postalCode']) &&
    isset($_POST['citizenship']) && 
    isset($_POST['email']) && 
    isset($_POST['passportNumber'])) {
    $statement = $conn->prepare('   UPDATE gnc353_2.People  
                                    SET People.firstName = :firstName,
                                        People.lastName = :lastName,
                                        People.middleInitial = :middleInitial,
                                        People.dateOfBirth = :dateOfBirth,
                                        People.medicareCardNumber = :medicareCardNumber,
                                        People.issueDateOfMedicare = :issueDateOfMedicare,
                                        People.expiryDateOfMedicare = :expiryDateOfMedicare,
                                        People.telephone = :telephone,
                                        People.address = :address,
                                        People.city = :city,
                                        People.Province = :Province,
                                        People.postalCode = :postalCode,
                                        People.citizenship = :citizenship,
                                        People.email = :email,
                                        People.passportNumber = :passportNumber 
                                    WHERE   People.firstName = :firstName AND 
                                        People.lastName = :lastName AND 
                                        People.middleInitial = :middleInitial;');

    $statement->bindParam(':firstName', $_POST['firstName']);
    $statement->bindParam(':lastName', $_POST['lastName']);
    $statement->bindParam(':middleInitial', $_POST['middleInitial']);
    $statement->bindParam(':dateOfBirth', $_POST['dateOfBirth']);
    $statement->bindParam(':medicareCardNumber', $_POST['medicareCardNumber']);
    $statement->bindParam(':issueDateOfMedicare', $_POST['issueDateOfMedicare']);
    $statement->bindParam(':expiryDateOfMedicare', $_POST['expiryDateOfMedicare']);
    $statement->bindParam(':telephone', $_POST['telephone']);
    $statement->bindParam(':address', $_POST['address']);
    $statement->bindParam(':city', $_POST['city']);
    $statement->bindParam(':Province', $_POST['Province']);
    $statement->bindParam(':postalCode', $_POST['postalCode']);
    $statement->bindParam(':citizenship', $_POST['citizenship']);
    $statement->bindParam(':email', $_POST['email']);
    $statement->bindParam(':passportNumber', $_POST['passportNumber']);

    if($statement->execute()) {
        header('Location: .');
    } else {
        header('Location: ./edit.php?firstName='.$_POST['firstName'].'&lastName='.$_POST['lastName'].'&middleInitial='.$_POST['middleInitial']);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add People</title>
</head>
<body>
    <h1>Edit People</h1>
    <form action='./edit.php' method='post'>
        <label for='firstName'>First Name</label> <br>
            <input type='text' name='firstName' id='firstName' value='<?= $people['firstName'] ?>' readonly> <br>
        <label for='lastName'>Last Name</label> <br>
            <input type='text' name='lastName' id='lastName' value='<?= $people['lastName'] ?>' readonly> <br>
        <label for='middleInitial'>Middle Initial</label> <br>
            <input type='text' name='middleInitial' id='middleInitial' value='<?= $people['middleInitial'] ?>' readonly> <br>
        <label for='dateOfBirth'>Date of Birth</label> <br>
            <input type='date' name='dateOfBirth' id='dateOfBirth' value='<?= $people['dateOfBirth'] ?>'> <br>
        <label for='medicareCardNumber'>Medicare Card Number</label> <br>
            <input type='text' name='medicareCardNumber' id='medicareCardNumber' value='<?= $people['medicareCardNumber'] ?>'> <br>
        <label for='issueDateOfMedicare'>Medicare Issue Date</label > <br>
            <input type='date' name='issueDateOfMedicare' id='issueDateOfMedicare' value='<?= $people['issueDateOfMedicare'] ?>'> <br>
        <label for='expiryDateOfMedicare'>Medicare Expiry Date</label> <br>
            <input type='date' name='expiryDateOfMedicare' id='expiryDateOfMedicare' value='<?= $people['expiryDateOfMedicare'] ?>'> <br>
        <label for='telephone'>Telephone</label> <br>
            <input type='text' name='telephone' id='telephone' value='<?= $people['telephone'] ?>'> <br>
        <label for='address'>Address</label> <br>
            <input type='text' name='address' id='address' value='<?= $people['address'] ?>'> <br>
        <label for='city'>City</label> <br>
            <input type='text' name='city' id='city' value='<?= $people['city'] ?>'> <br>
        <label for='Province'>Province</label> <br>
            <input type='text' name='Province' id='Province' value='<?= $people['Province'] ?>'> <br>
        <label for='postalCode'>Postal Code</label> <br>
            <input type='text' name='postalCode' id='postalCode' value='<?= $people['postalCode'] ?>'> <br>
        <label for='citizenship'>Citizenship</label> <br>
            <input type='text' name='citizenship' id='citizenship' value='<?= $people['citizenship'] ?>'> <br>
        <label for='email'>Email</label> <br>
            <input type='text' name='email' id='email' value='<?= $people['email'] ?>'> <br>
        <label for='passportNumber'>Passport Number</label> <br>
            <input type='text' name='passportNumber' id='passportNumber' value='<?= $people['passportNumber'] ?>'> <br>
        <button type='submit'>Submit</button> <br>
    </form>
    <a href='./index.php'>Back to people list</a>
</body>
</html>