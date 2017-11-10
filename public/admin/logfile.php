<?php
require_once("../../includes/initialize.php");

$logfile = SITE_ROOT.DS.'logs'.DS.'logs.txt';

if(isset($_GET) && $_GET['clear'] == "true") {
    file_put_contents($logfile, "");
    $logger->log_action("Logs cleared", "by User ID {$session->user_id}");
//    redirect_to("logfile.php");
}

include_layout_template('admin_header.php')?>

    <pre>
        <?php var_dump($_GET); ?>
    </pre>
    <div id="main">

    <h2>Log History</h2>

    <a href="index.php">&laquo; Back</a><br />

    <ul>
    <?php
        $logger->get_logs();
    ?>
    </ul>

    <p><a href="logfile.php?clear=true">Clear log file</a><p>

<?php include_layout_template('admin_footer.php')?>