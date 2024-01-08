<?php
    // including data connection file
    include("config.php");

    // getting id of data
    $id = $_GET['id'];

    // deleting row table
    $result = mysqli_query($mysqli, "DELETE FROM owner_list WHERE id=$id");

    // redirecting to display page
    header("Location:/info/admin.php");

?>