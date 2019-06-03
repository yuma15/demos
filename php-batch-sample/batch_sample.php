<?php
// php ini setting
ini_set('memory_limit', '512M');
ini_set('max_execution_time', 3600);
ini_set('default_charset', 'UTF-8');
ini_set('date.timezone', 'Asia/Tokyo');

// variables
$logfile = "logfile.txt";

const INFO = "INFO";
const ERROR = "ERROR";

// get argument
$test_arg1 = $argv[1];
$test_arg2 = $argv[2];

logger(INFO, "arg1 = $test_arg1");
logger(INFO, "arg2 = $test_arg2");

// csv input and output
$csv_input_file = "sample_input.csv";
$csv_output_file = "sample_output.csv";
$file = new SplFileObject($csv_input_file);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $db->query('select * from testtable');
    $rows = $stmt -> fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as $row) {
        $line = implode(' ', $row);
        logger(INFO, "get db data: $line");
    }
} catch (PDOException $e) {
    logger(ERROR, "database error: ".$e->getMessage());
}
$db = null;

// Web API access
$base_url = 'http://zipcloud.ibsnet.co.jp/api/search?zipcode=';
$zipcode = '1020082';

$curl = curl_init();

$option = [
    CURLOPT_URL => $base_url.$zipcode,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_RETURNTRANSFER => true,
];
curl_setopt_array($curl, $option);

$response = curl_exec($curl);
logger(INFO, "get web api data: $response");
// if you want to use json as array, use json_decode
// $result = json_decode($response, true);
curl_close($curl);

// function
function logger($level, $message) {
    global $logfile;
    $log = date("Y-m-d H:i:s");
    $log .= " ";
    $log .= "[$level]";
    $log .= " ";
    $log .= $message;
    $log .= "\n";
    print $log;
    file_put_contents($logfile, $log, FILE_APPEND | LOCK_EX);
}
