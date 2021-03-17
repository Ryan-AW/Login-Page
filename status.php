<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset = "UTF-8">
        <link rel="stylesheet" href="styles.css">
        <title>Login Status</title>
    </head>

    <body class="chat-page">
        <?php
            session_start();
            if (isset($_SESSION["login"]) && $_SESSION["login"] == true) {
                echo "<h2>Login Successful</h2><div style='text-align: center; color: green'>Logged In: (" . $_SESSION["username"] . ")</div>";
            }
            else {
                echo "<div id='login-error'>Please <a href='index.php'>Log In</a> to use this page</div>";
                exit();
            }
        ?>
    </body>
</html>
