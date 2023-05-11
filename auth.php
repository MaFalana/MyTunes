<?php
    require 'vendor/autoload.php';

    $client_id = '79741001fa474806af793ca85f6c0ed1'; // Your client id
	$client_secret = '5ba82dd1d44a45d5a6d9059af1c3131b'; // Your secret

    $session = new SpotifyWebAPI\Session($client_id, $client_secret);

    $session->requestCredentialsToken();
    $accessToken = $session->getAccessToken();

    $_SESSION["accessToken"] = $accessToken;// Store the access token somewhere. In a database for example.

    // Send the user along and fetch some data!
    //header('Location: app.php');
    //die();
?>