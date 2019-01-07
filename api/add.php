<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

require_once 'google/vendor/autoload.php';

$client = new Google_Client();
$client->setApplicationName("ToDo");
$client->setDeveloperKey("YOURAPIKEY");

$service = new Google_Service_Sheets($client);

$spreadsheetId = '1OEs_UwfU8Y1bI3OHMNaEJFWBe_NyzUx9FUAKoFwH0vY';
$range = 'Sheet1!A1';
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();

if (empty($values)) {
    print "No data found.\n";
} else {
    foreach ($values as $row) {
        echo $row[0];
    }
}
?>