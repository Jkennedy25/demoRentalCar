<?php
require_once "login-page.php"

session_start();

if(isset($_POST['uname']) && isset($_POST['password'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return data;
    }
}

$uname = validate($_POST['uname']);
$password = validate($_POST['password']);

if(empty($uname)) {
    header ("Location: login-page.php?error=Invalid User Name!");
    exit();
}

else if(empty($password)) {
    header ("Location: login-page.php?error=Invalid Password!");
    exit();
}

$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) === 1) {
    $row = mysqli_fetch_assoc($result);
    if($row['user_name'] === $uname && $row['password'] === $pass) {
        echo "Successfully Logged In";
        $_SESSION['user_name'] = $row['user_name'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['id'] = $row['id'];
        header("Location: home.php");
        exit();
    }
    else {
        header("Location: login-page.php?error=Invalid User Name or Password");
        exit();
    }
}
else {
    header("Location: index.php");
}