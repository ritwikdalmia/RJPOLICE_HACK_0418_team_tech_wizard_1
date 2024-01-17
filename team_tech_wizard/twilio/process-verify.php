<?php

require __DIR__ . '/vendor/autoload.php';
require './connection.php';

use Twilio\Rest\Client;

$sid = "AC92f7c2cdb11803478cf1d95059c013ed";
$token = "98cd0c66795f5ee09c4de0135fc525ae";
$serviceId = "VSda086f0106bed491d2ac5c44118e0e74";

$twilio = new Client($sid, $token);

if (isset($_POST['submit'])) {

    $vCode = $_POST['token'];
    $phone = $_POST['Mno'];

    $verification_check = $twilio->verify->v2->services($serviceId)
        ->verificationChecks
        ->create(
            $vCode,
            ["to" => "+" . $phone]
        );
    if ($verification_check->status == 'approved') {
        // checks if the user already exist in db
        $query = "SELECT Mno FROM users WHERE Mno = $phone";
        $result = $connection->query($query);

        if ($result->num_rows > 0) {
            $alert = "Welcome back to your account!";
        } 
    } else {
          $alert = "Welcome,No account found!";
    }
}
