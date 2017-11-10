<?php
require_once('../../includes/initialize.php');
//if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>

<?php include_layout_template('admin_header.php')?>
<h2>Menu</h2>
<ul>
    <li><a href="logfile.php"> Get Logs </a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>
<?php
$user = User::find_user_by_id(1);
echo $user->full_name();

echo "<hr />";

$users = User::find_all();
foreach($users as $user) {
    echo "User: ". $user->username ."<br />";
    echo "Name: ". $user->full_name() ."<br /><br />";
}

?>

<?php include_layout_template('admin_footer.php')?>
