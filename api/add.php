<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");

require_once 'google/vendor/autoload.php';

$client = new Google_Client();
$client->setApplicationName("ToDo");
$client->setDeveloperKey("AIzaSyAE1Y9QK4chUgrvLfitXQ7VEDPxk4_d1Us");

$service = new Google_Service_Sheets($client);

$spreadsheetId = '1KnHB5abxKeFw3T_QKj2ZlOJjDrmmyT8ioc6-KAv8Dfo';
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