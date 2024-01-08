
    

<?php
//including data connection file
include_once("config.php");

if(isset($_POST['submit'])) {
    // echo "<pre>";
    // die(var_dump($_POST));

    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone_number'] ?? '';
    $message = $_POST['message'] ?? '';

    $name = mysqli_real_escape_string($mysqli, $name);
    $email = mysqli_real_escape_string($mysqli, $email);
    $phone = mysqli_real_escape_string($mysqli, $phone);
    $message = mysqli_real_escape_string($mysqli, $message);

    // check if the fields are empty
    if(empty($name) || empty($email) || empty($phone) || empty($message)) {
        if(empty($name)) {
            echo "<font color='red'>Name field is empty.</font><br>";
        }
        if(empty($email)) {
            echo "<font color='red'>Name field is empty.</font><br>";
        }
        if(empty($phone)) {
            echo "<font color='red'>Name field is empty.</font><br>";
        }
        if(empty($message)) {
            echo "<font color='red'>Name field is empty.</font><br>";
        }
        // back to previous page

        echo "<script>setTimeout(() => { window.location.href='/info/IMPORTANT/Puppals/contacts.html' }, 2000)</script>";
        die();
    }

    // adding data
    
    $statement = mysqli_prepare($mysqli, "INSERT INTO `owner_list` (`name`, `email`, `phone_number`, `message`) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($statement, 'ssss', $name, $email, $phone, $message);
    mysqli_stmt_execute($statement);

    echo 'Successfully inserted to the table.';

    echo "<script>setTimeout(() => { window.location.href='/info/IMPORTANT/Puppals/contacts.html' }, 2000)</script>";
}
?>


