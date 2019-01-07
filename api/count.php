<?php
require_once 'google/vendor/autoload.php';
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
$client = new \Google_Client();
$client->setApplicationName('API2');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');


$client->setAuthConfig(__DIR__ . '/key.json');

$service = new Google_Service_Sheets($client);

$spreadsheetId = '1OEs_UwfU8Y1bI3OHMNaEJFWBe_NyzUx9FUAKoFwH0vY';
$range = 'Sheet1!A1';
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();
$wip = 0;
if (empty($values)) {
    print "No data found.\n";
} else {
    foreach ($values as $row) {
        $wip = $row[0];
    }
}
$wip++;
$values = [
    [
        $wip
    ]
];
$body = new Google_Service_Sheets_ValueRange([
    'values' => $values
]);
$params = [
    'valueInputOption' => "USER_ENTERED"
];
$result = $service->
spreadsheets_values->update($spreadsheetId, $range,
$body, $params);
printf("%d cells updated.", $result->getUpdatedCells());
?>