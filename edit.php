<?php
include_once("config.php");

    
if(isset($_POST['update'])) {
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

        echo "<script>setTimeout(() => { window.location.href='/IMPORTANT/Puppals/contacts.html' }, 2000)</script>";
        die();
    }
    $statement = mysqli_prepare($mysqli, "UPDATE `owner_list` (`name`, `email`, `phone_number`, `message`) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($statement, 'ssss', $name, $email, $phone, $message);
    mysqli_stmt_execute($statement);

    echo 'Successfully edited the table.';
}
?>
<?php 

$statement = mysqli_prepare($mysqli, "SELECT * FROM `owner_list` WHERE (`name`, `email`, `phone_number`, `message`) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($statement, 'ssss', $name, $email, $phone, $message);
    mysqli_stmt_execute($statement);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
</head>
<body>
    <a href="admin.php">Admin</a>
    <br><br>

    <form action="edit.php" name="admin" method="POST">
        <table border="0">
            <tr>
                <td>Name</td>
                <td><input type="text" name="name" value="<?php echo $name;?>"></td>
            </tr>
            <tr>
            <td>Email</td>
                <td><input type="text" name="email" value="<?php echo $email;?>"></td>
            </tr>
            <tr>
            <td>Phone Number</td>
                <td><input type="text" name="phone_number" value="<?php echo $phone;?>"></td>
            </tr>
            <tr>
            <td>Message</td>
                <td><input type="text" name="message" value="<?php echo $message;?>"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value="<?php echo $_GET['id'];?>"></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>