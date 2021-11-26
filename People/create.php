<?php require_once '../database.php';

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
    $people = $conn->prepare(' INSERT INTO gnc353_2.People  
                                           (firstName,
                                            lastName,
                                            middleInitial,
                                            dateOfBirth,
                                            medicareCardNumber,
                                            issueDateOfMedicare,
                                            expiryDateOfMedicare,
                                            telephone,
                                            address,
                                            city,
                                            Province,
                                            postalCode,
                                            citizenship,
                                            email,
                                            passportNumber)
                                    VALUES (:firstName,
                                            :lastName,
                                            :middleInitial,
                                            :dateOfBirth,
                                            :medicareCardNumber,
                                            :issueDateOfMedicare,
                                            :expiryDateOfMedicare,
                                            :telephone,
                                            :address,
                                            :city,
                                            :Province,
                                            :postalCode,
                                            :citizenship,
                                            :email,
                                            :passportNumber)');

    $people->bindParam(':firstName', $_POST['firstName']);
    $people->bindParam(':lastName', $_POST['lastName']);
    $people->bindParam(':middleInitial', $_POST['middleInitial']);
    $people->bindParam(':dateOfBirth', $_POST['dateOfBirth']);
    $people->bindParam(':medicareCardNumber', $_POST['medicareCardNumber']);
    $people->bindParam(':issueDateOfMedicare', $_POST['issueDateOfMedicare']);
    $people->bindParam(':expiryDateOfMedicare', $_POST['expiryDateOfMedicare']);
    $people->bindParam(':telephone', $_POST['telephone']);
    $people->bindParam(':address', $_POST['address']);
    $people->bindParam(':city', $_POST['city']);
    $people->bindParam(':Province', $_POST['Province']);
    $people->bindParam(':postalCode', $_POST['postalCode']);
    $people->bindParam(':citizenship', $_POST['citizenship']);
    $people->bindParam(':email', $_POST['email']);
    $people->bindParam(':passportNumber', $_POST['passportNumber']);

    if($people->execute())
        header('Location: .');
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
    <h1>People Creation</h1>
    <form action='./create.php' method='post'>
        <label for='firstName'>First Name</label> <br>
            <input type='text' name='firstName' id='firstName'> <br>
        <label for='lastName'>Last Name</label> <br>
            <input type='text' name='lastName' id='lastName'> <br>
        <label for='middleInitial'>Middle Initial</label> <br>
            <input type='text' name='middleInitial' id='middleInitial'> <br>
        <label for='dateOfBirth'>Date of Birth</label> <br>
            <input type='date' name='dateOfBirth' id='dateOfBirth'> <br>
        <label for='medicareCardNumber'>Medicare Card Number</label> <br>
            <input type='text' name='medicareCardNumber' id='medicareCardNumber'> <br>
        <label for='issueDateOfMedicare'>Medicare Issue Date</label> <br>
            <input type='date' name='issueDateOfMedicare' id='issueDateOfMedicare'> <br>
        <label for='expiryDateOfMedicare'>Medicare Expiry Date</label> <br>
            <input type='date' name='expiryDateOfMedicare' id='expiryDateOfMedicare'> <br>
        <label for='telephone'>Telephone</label> <br>
            <input type='text' name='telephone' id='telephone'> <br>
        <label for='address'>Address</label> <br>
            <input type='text' name='address' id='address'> <br>
        <label for='city'>City</label> <br>
            <input type='text' name='city' id='city'> <br>
        <label for='Province'>Province</label> <br>
            <input type='text' name='Province' id='Province'> <br>
        <label for='postalCode'>Postal Code</label> <br>
            <input type='text' name='postalCode' id='postalCode'> <br>
        <label for='citizenship'>Citizenship</label> <br>
            <input type='text' name='citizenship' id='citizenship'> <br>
        <label for='email'>Email</label> <br>
            <input type='text' name='email' id='email'> <br>
        <label for='passportNumber'>Passport Number</label> <br>
            <input type='text' name='passportNumber' id='passportNumber'> <br>
        <button type='submit'>Submit</button> <br>
    </form>
    <a href='./index.php'>Back to people list</a>
</body>
</html>