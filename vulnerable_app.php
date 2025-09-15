<?php
// 🚨 Deliberately Insecure Example for Checkmarx/GitHub Scanning
// Features: Registration + Login (INSECURE)

// Database connection (hardcoded, no error handling best practices)
$conn = mysqli_connect("localhost", "root", "", "sad_practical");
if (!$conn) {

    
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['Register'])) {
    $uname = $_POST['Username'];
    $passwd = $_POST['Password'];
    $add = $_POST['Address'];
    $phone = $_POST['PhoneNo'];

    // 🚨 Vulnerable: SQL Injection, Plaintext Password Storage
    $sql = "INSERT INTO signup (Username, Password, Address, PhoneNo) 
            VALUES ('$uname', '$passwd', '$add', '$phone')";
    if (mysqli_query($conn, $sql)) {
        echo "<p style='color:green;'>Account Created (INSECURE)</p>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if (isset($_POST['Login'])) {
    $uname = $_POST['Username'];
    $passwd = $_POST['Password'];

    // 🚨 Vulnerable: SQL Injection
    $sql = "SELECT * FROM signup WHERE Username = '$uname' AND Password = '$passwd'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "<p style='color:green;'>Login Successful (INSECURE)</p>";
    } else {
        echo "<p style='color:red;'>Invalid Credentials</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vulnerable App</title>
</head>
<body>
    <h2>Register (Insecure)</h2>
    <form method="POST">
        Username: <input type="text" name="Username"><br>
        Password: <input type="password" name="Password"><br>
        Address: <input type="text" name="Address"><br>
        Phone: <input type="text" name="PhoneNo"><br>
        <input type="submit" name="Register" value="Register">
    </form>

    <h2>Login (Insecure)</h2>
    <form method="POST">
        Username: <input type="text" name="Username"><br>
        Password: <input type="password" name="Password"><br>
        <input type="submit" name="Login" value="Login">
    </form>
</body>
</html>
