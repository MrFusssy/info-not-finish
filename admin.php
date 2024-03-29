<?php 
    include_once("phpfile/config.php");
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<style>

    input[type="text"] {
        margin: 20px 3px 20px 20px ;
        border-color: #ddd;
    }

    input[name="search"] {
        padding: 4px;
        margin: 5px;
        border-color: #ddd;
    }
    input[name="search"]:hover {
        background-color: black;
        color: #ddd;
    }


    input[name="delete"] {
        padding: 4px;
        margin: 5px;
        border-color: #ddd;
    }
    input[name="delete"]:hover {
        background-color: black;
        color: #ddd;
    }
    table {
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 20px;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }

    a {
        padding: 4px 10px 2px 10px;
        border: 2px solid #ddd;
        text-decoration: none;
        color: black;
        margin-left: 4.5px;
    }
    a:hover {
        background-color: black;
        color: #ddd;
    }



</style>
<body>
    <form action="" method="GET">
        <input type="text" name="term" id="term">
        <input type="submit" name="search" value="Search"> 
    </form>

    <!-- Table list -->
    <table>
        <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Email</td>
                <td>Phone number</td>
                <td>Message</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
            <?php 
                $term = $_GET['term'] ?? '';
                $term = mysqli_escape_string($mysqli, $term);
                $term = "%" . $term . "%";
                $statement = mysqli_prepare($mysqli, "SELECT * FROM `owner_list` WHERE `name` LIKE ? OR `email` LIKE ?");
                mysqli_stmt_bind_param($statement, 'ss', $term, $term);
                mysqli_stmt_execute($statement);

                $result = mysqli_stmt_get_result($statement);
                $rows = array();
                while ($row = mysqli_fetch_assoc($result)) {
                    $rows[] = $row;
                }
                mysqli_stmt_close($statement);
            ?>
            <?php if (count($rows) <= 0): ?>
                <tr>
                    <td colspan="6"></td>
                </tr>
            <?php else: ?>
                <?php foreach($rows as $row): ?>
                    <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['phone_number'] ?></td>
                        <td><?php echo $row['message'] ?></td>
                        <td>
                            <a href="/info/edit.php?id=<?php echo $row['id'] ?>">Edit</a>
                            <form action="/info/delete.php" onsubmit="return confirm('Are you sure you want to delete this Data?')">
                                <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
                                <input type="submit" name="delete" value="Delete">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>