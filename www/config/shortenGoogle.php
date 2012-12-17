<?php
define('GOOGLE_API_KEY', 'qNKLYAiMdvnF8cp_hCtd__KC');
define('GOOGLE_ENDPOINT', 'https://www.googleapis.com/urlshortener/v1');

    function shortenUrl($longUrl)
    {
        // initialize the cURL connection
        $ch = curl_init(
            sprintf('https://www.googleapis.com/urlshortener/v1/url')
        );

        // tell cURL to return the data rather than outputting it
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // create the data to be encoded into JSON
        $requestData = array(
            'longUrl' => $longUrl
        );

        // change the request type to POST
        curl_setopt($ch, CURLOPT_POST, true);

        // set the form content type for JSON data
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));

        // set the post body to encoded JSON data
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($requestData));

        // perform the request
        $result = curl_exec($ch);
        curl_close($ch);

		
        // decode and return the JSON response
        return json_decode($result, true);
    }