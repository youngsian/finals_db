<?php
session_start();
include('config.php'); // Make sure this connects to your database

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Basic input sanitization
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Simple user check (assumes password is plain text)
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $username;
        header("Location: index.php"); // redirect after login
        exit();
    } else {
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            margin: 0;
            background: linear-gradient(135deg, #8e44ad, #3498db);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .login-box {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0px 10px 25px rgba(0,0,0,0.3);
            width: 300px;
        }
        .login-box h2 {
            text-align: center;
            margin-bottom: 25px;
        }
        .login-box input[type="text"], .login-box input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0 16px;
            border: none;
            background: #f0f0f0;
            border-radius: 10px;
        }
        .login-box input[type="submit"] {
            width: 100%;
            padding: 10px;
            background: #3498db;
            border: none;
            color: white;
            border-radius: 10px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .login-box input[type="submit"]:hover {
            background: #2980b9;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="login-box">
    <h2>Login</h2>
    <?php if (!empty($error)) echo '<p class="error">' . $error . '</p>'; ?>
    <form method="POST" action="">
        <input type="text" name="username" placeholder="Username" required/>
        <input type="password" name="password" placeholder="Password" required/>
        <input type="submit" name="login" value="Log In"/>
    </form>
</div>
</body>
</html>
