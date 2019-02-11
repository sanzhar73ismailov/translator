<?php

try {
	header("Access-Control-Allow-Orgin: *");
    header("Access-Control-Allow-Methods: *");
    header("Content-Type: application/json; charset=utf-8");
	
	$lang = $_REQUEST['lang'];
    $data = array(
    'key' => "", //enterp key of Yandex
    'lang' => $lang,
	'format' => "html",
	'text' => $_REQUEST['text']
);

    # Create a connection
	$url = 'https://translate.yandex.net/api/v1.5/tr.json/translate';
	$ch = curl_init($url);
	# Form data string
	$postString = http_build_query($data, '', '&');
	# Setting our options
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postString);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	# Get the response
	$response = curl_exec($ch);
	if($response === false) {
		echo json_encode(array('error' => curl_error($ch)));
	} else {
		echo $response;
	}
	
	//echo curl_error($ch);
	//curl_exec($ch);
	//print_r($response);
	//var_dump($response);

	curl_close($ch);


} catch (Exception $e) {
    echo json_encode(array('error' => $e->getMessage()));
}

?>