<?php
require_once("../../includes/initialize.php");

if($session->is_logged_in()) {
    redirect_to("index.php");
}

if (isset($_POST['username'])){ //Form has been submitted

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    //Check db to see if user exists
    $found_user = User::authenticate($username, $password);

        if($found_user){
            $session->login($found_user);
            redirect_to("index.php");
        } else {
            // username/password combo was not found in the database
            $message = "Username/password combination incorrect.";
        }

} else { // Form has not been submitted.
    $username = "";
    $password = "";
    $message = "";
}


?>
<html>
<head>
    <title>Photo Gallery</title>
    <link href="../styles/main.css" media="all" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="header">
    <h1>Photo Gallery - Log in</h1>
</div>
<div id="main">
    <pre>
        <?php var_dump($_POST)?>
        <?php var_dump($_SESSION)?>
    </pre>

    <h2>Staff Login</h2>

    <?php echo output_message($message); ?>

    <form action="login.php" method="post">
        <table>
            <tr>
                <td>Username:</td>
                <td>
                    <input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>" />
                </td>
            </tr>
            <tr>
                <td>Password:</td>
                <td>
                    <input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>" />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Login" />
                </td>
            </tr>
        </table>
    </form>
</div>
<div id="footer">Copyright <?php echo date("Y", time()); ?>, Kevin Skoglund</div>
</body>
</html>
<?php if(isset($database)) { $database->close_connection(); } ?>
