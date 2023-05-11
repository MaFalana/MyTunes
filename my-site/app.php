<?php

	require 'vendor/autoload.php';

	$accessToken = $_SESSION["accessToken"];//'BQBVW1k_IgYjRJeiRfN4b6iK26JZ9PcxCy7pWyH1ELZwXMkhvQnPeloolx7aXrI4byWfnAS2-nhi5KhryVSxsD8BybiMQnTNb3raTMfk6JTcMzYpimGzz5VRBIRxK1YMdfgcKSt6pJr9WbM19lqDCBHt0c9VEpl_Bs60uT-4peob_bxrApbIOC-AkjZ6V8E_qU0';//// Fetch the saved access token from somewhere. A database for example.

	$api = new SpotifyWebAPI\SpotifyWebAPI();
	$api->setAccessToken($accessToken);


    // It's now possible to request data from the Spotify catalog
    //print_r(  $api->getTrack('7EjyzZcbLxW7PaaLua9Ksb') );
	//print_r( $api->search('Coloring Book', 'album'));
?>