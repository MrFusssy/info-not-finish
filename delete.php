<?php
    // including data connection file
    include("phpfile/config.php");

    // getting id of data
    $id = $_GET['id'] ?? '';
    $id = mysqli_escape_string($mysqli, $id);
    $statement = mysqli_prepare($mysqli, "DELETE FROM `owner_list` WHERE `id` =  ?");
    mysqli_stmt_bind_param($statement, 's', $id);
    $res = mysqli_stmt_execute($statement);

    if ($res) echo "Matagumpay na nabura";
    
    echo "<script>setTimeout(() => { window.location.href='/info/admin.php' }, 2000)</script>";

?>