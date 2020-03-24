#!/usr/bin/php
<?php
/**
 * Sendmail replacement that logs the message to a file
 */
$logfile = '/var/log/cron.log';

//prevent reading from stdin blocking our process
if (posix_isatty(STDIN)) {
    echo "Usage: echo message | sendmail.php\n";
    exit(1);
}

$lines = file_get_contents('php://stdin');

file_put_contents(
    $logfile,
    json_encode(
        [
            'date'   => date('Y-m-d H:i:s'),
            'params' => $argv,
            'input'  => $lines,
        ]
    ) . "\n",
    FILE_APPEND
);
?>
