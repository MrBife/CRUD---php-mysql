<?php
    session_start();

    $db = mysqli_connect('localhost', 'root', '', 'dockerchallenge');

    // Iniciar variaveis
	$name = "";
	$email = "";
	$id = 0;
    $edit_state = false;

    // Insert
	if (isset($_POST['save'])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		mysqli_query($db, "INSERT INTO users (name, email) VALUES ('$name', '$email')");
		$_SESSION['msg'] = "E-mail salvado ;)";
		header('location: index.php');
    }

    // Update
    if (isset($_POST['update'])) {
        $name = mysqli_real_escape_string($_POST['name']);
        $email = mysqli_real_escape_string($_POST['email']);
        $id = mysqli_real_escape_string($_POST['id']);

        mysqli_query($db, "UPDATE users SET name='$name', email='$email' WHERE id=$id");
        $_SESSION['msg'] = "E-mail atualizado ;)";
        header('location: index.php');
    }

    // Delete
    if (isset($_GET['del'])) {
        $id = $_GET['del'];
        mysqli_query($db, "DELETE FROM users WHERE id=$id");
        $_SESSION['msg'] = "E-mail deletado ;)";
        header('location: index.php');
    }

    // Select
    $results = mysqli_query($db, "SELECT * FROM users");

?>