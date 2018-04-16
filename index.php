<?php include('server.php'); 

    // Pegar ID para dar update
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $edit_state = true;
        $rec = mysqli_query($db, "SELECT * FROM users WHERE id=$id");
        $record = mysqli_fetch_array($rec);
        $name = $record['name'];
        $email = $record['email'];
        $id = $record['id'];
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Nac - Docker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>

    <?php if (isset($_SESSION['msg'])): ?>
        <div class="msg">
            <?php
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            ?>
        </div>
    <?php endif ?>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_array($results)) { ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>
                    <a class="edit_btn" href="index.php?edit=<?php echo $row['id']; ?>">Edit</a>
                </td>
                <td>
                    <a class="del_btn" href="server.php?del=<?php echo $row['id']; ?>">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <form method="post" action="server.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="input-group">
            <label>Name</label>
            <input type="text" name="name" value="<?php echo $name; ?>">
        </div>
        <div class="input-group">
            <label>email</label>
            <input type="text" name="email" value="<?php echo $email; ?>">
        </div>
        <div class="input-group">
            <?php if ($edit_state == false): ?>
                <button type="submit" name="save" class="btn">Save</button>
            <?php else: ?>
                <button type="submit" name="update" class="btn">Update</button>
            <?php endif ?>
        </div>
    </form>
</body>
</html>