<?php
include 'dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = $_POST['u_Name'];
    $email = $_POST['u_email'];
    $password = $_POST['u_Pw'];
    $confirmPassword = $_POST['confirmPassword'];
    $phoneNumber = $_POST['u_PhoneNum'];
    $p_address = $_POST['u_Address'];


    if ($password !== $confirmPassword) {
        echo "<script>alert('Password and Confirm Password do not match');</script>";
        exit;
    }

    $hashedPassword = sha1($password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("INSERT INTO tbl_users (u_name, u_email, u_pw, u_phoneNum, u_address) VALUES (:u_name, :u_email, :u_pw, :u_phoneNum, :u_address)");
    $stmt->bindParam(':u_name', $name);
    $stmt->bindParam(':u_email', $email);
    $stmt->bindParam(':u_pw', $hashedPassword); 
    $stmt->bindParam(':u_phoneNum', $phoneNumber);
    $stmt->bindParam(':u_address', $p_address);
    $stmt->execute();

    echo "<script>alert('Registration Successful');</script>";
    echo "<script>window.location.href='index.php'</script>";
}
?>



<!DOCTYPE html>
<html>
<head>
    <title>My Clinic Register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
        <a href="main.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <span class="fs-4 ms-4">Matthew H's Clinic</span>
        </a>

        <ul class="nav nav-pills mr-2">
            <li class="nav-item"><a href="main.php" class="nav-link">Login</a></li>
            <li class="nav-item"><a href="register.php" class="nav-link active" aria-current="page">Register</a></li>
        </ul>
    </header>

    <div class="container mt-2">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2>Register</h2>
                <form action="register.php" method="post" name="registerForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="name" class="form-control" id="u_Name" name="u_Name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="u_email" name="u_email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="u_Pw" name="u_Pw">
                    </div>
                    <div class="mb-3">
                        <label for="confirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class ="form-label">Phone Number</label>
                        <input type="text" class="form-control" id="u_PhoneNum" name="u_PhoneNum"> 
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="u_Address" name="u_Address" style="height: 100px"></textarea>
                    </div>


                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="text-center">Matthew H's Clinic © 2024</p>
                </div>
            </div>
        </div>
    </footer>
</body>