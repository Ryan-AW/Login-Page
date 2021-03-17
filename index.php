<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset = "UTF-8">
        <link rel="stylesheet" href="styles.css">
        <title>Login Page</title>
    </head>

    <body>
        <form method="post">
            <div class="container">
                <h1>Login</h1>

                <label>Username:</label>
                <input name="username" type="text" maxlength="10"><br>

                <label>Password:</label>
                <input name="password" type="password" maxlength="10"><br>

                <button name="login" type="submit">Login</button>
                <button name="register" type="submit">Register</button>

                <?php
                $string_placement = "<br><span style='color: black;font-size:12px'> %s";

                function VerifyLogin($username, $password) {
                    global $string_placement;

                    try {
                        $db = new PDO("sqlite:Login-Data.db");
                        $result = $db->query("SELECT * FROM tb_userinfo WHERE username = ? AND password = ?");

                        $result->execute(array($username, $password));
                        if ($result->fetchAll()) {
                            session_start();
                            $_SESSION["login"] = true;
                            $_SESSION["username"] = $username;
                            header("location:status.php");
                        }
                        else {
                            echo sprintf($string_placement, "Invalid Username or Password, try again");
                        }
                    
                    } catch (Throwable $e) {
                        echo sprintf($string_placement, "Error Verifying Credentials, try again");
                    }
                }

                if (isset($_POST["login"])) {
                    $username = $_POST["username"];
                    $password = $_POST["password"];

                    if (empty($username) or empty($password)) {
                        echo sprintf($string_placement, "Insufficient Credentials, try again");
                    }
                    else { VerifyLogin($username, $password); }
                }
                elseif (isset($_POST["register"])) { header("location:register.php"); }
                ?>
            </div>
        </form>
    </body>
</html>
