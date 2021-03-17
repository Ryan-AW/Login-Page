<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset = "UTF-8">
        <link rel="stylesheet" href="styles.css">
        <title>Registration Page</title>
    </head>

    <body>
        <form method="post">
            <div class="container">
                <h1>Registration</h1>

                <label>Username:</label>
                <input name="username" type="text" maxlength="10"><br>

                <label>Password:</label>
                <input name="password" type="password" maxlength="10"><br>

                <label>Confirm Password:</label>
                <input name="confirm_password" type="password" maxlength="10"><br>

                <button name="register" type="submit">Register Account</button>
                <button name="login" type="submit">Back to Login</button>

                <?php
                    $string_placement = "<br><span style='color: black; font-size:12px'> %s";

                    function VerifyCredentials($username) {
                        global $string_placement;

                        try {
                            $db = new PDO("sqlite:Login-Data.db");
                            $result = $db->query("SELECT * FROM tb_userinfo WHERE username='$username'");
                            if ($result->fetchAll()) {
                                echo sprintf($string_placement, "Username Already Taken");
                                exit();
                            }
                        
                        } catch (Throwable $e) {
                            echo sprintf($string_placement, "Error Registering Account, try again");
                            exit();
                        }
                    }
                    function RegisterAccount($username, $password) {
                        global $string_placement;

                        try {
                            $db = new SQLite3("Login-Data.db");
                            $db->exec("INSERT INTO tb_userinfo(username, password) VALUES('$username', '$password')");
                            echo sprintf($string_placement, "<span style='color: #00ff00'>Account Registered</span>");
                        
                        } catch (Throwable $e) {
                            echo sprintf($string_placement, "Error Registering Account, try again");
                            exit();
                        }
                    }
                    if (isset($_POST["login"])) {
                        header("location:index.php");
                    }
                    elseif (isset($_POST["register"])) {
                        $username = $_POST["username"];
                        $password = $_POST["password"];
                        $confirm_password = $_POST["confirm_password"];

                        if (empty($username) or empty($password) or empty($confirm_password)) {
                            echo sprintf($string_placement, "Insufficient Information, try again");
                        }
                        elseif ($password != $confirm_password) {
                            echo sprintf($string_placement, "Passwords do not match");
                        }
                        elseif ($username == $password) {
                            echo sprintf($string_placement, "Username cannot be the same as Password");
                        }
                        elseif (strlen($username) <= 3 or strlen($password) <= 3) {
                            echo sprintf($string_placement, "Username or Password is too short");
                        }
                        elseif (strlen($username) > 10 or strlen($password) > 10) {
                            echo sprintf($string_placement, "Username or Password is too long");
                        }
                        else {
                            VerifyCredentials($username);
                            RegisterAccount($username, $password);
                        }
                    }
                ?>
            </div>
        </form>
    </body>
</html>
