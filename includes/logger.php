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
}


$logger = new Logger;