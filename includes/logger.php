<?php

class Logger {

    public function log_action ($action,$message="") {
        $logfile = SITE_ROOT.DS.'logs'.DS.'logs.txt';
        $new = file_exists($logfile) ? false : true;
        if($handle = fopen($logfile,'a')){
                $timestamp = strftime('%Y-%m-%d %T',time());
                $content   = $timestamp . " | " . $action . ": " . $message . PHP_EOL;
            fwrite($handle,$content);
            fclose($handle);
            if($new) {
                chmod($logfile,0755);
            }
        } else{
            die("Could not open log file for writing");
          }
    }

    public function get_logs(){
        $logfile = SITE_ROOT.DS.'logs'.DS.'logs.txt';


        $handle = fopen($logfile,'r');
        if ($handle){
            while(($line = fgets($handle)) !== false){
                $line = trim($line);
                if($line != ""){
                    echo "<li> {$line} <li>";
                }
            }
            fclose($handle);
        } else {
            echo "Error opening file.";
        }
    }
}

$logger = new Logger;