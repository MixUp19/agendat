<?php

require '../vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

function subirAzure ($file, $containerName) {
    global $msg;
    $storageAccountName = 'proyectoagendat';

    $verb = 'PUT';

    $accessToken = getenv('KEY_STRING_AGENDAT');
    echo $accessToken . '<br>';
    $archivo = $file;

    $blobName = $archivo['name'];

    $type = $archivo['type'];
    $versionPut = '2015-02-21';
    $client = new Client();
    $endpoint = "https://$storageAccountName.blob.core.windows.net/$containerName/$blobName";
    echo $endpoint;
    $date = gmdate("D, d M Y H:i:s T");
    $size = $archivo['size'];
    $string = "$verb\n\n\n$size\n\n$type\n\n\n\n\n\n\nx-ms-blob-type:BlockBlob\nx-ms-date:$date\nx-ms-version:$versionPut\n/$storageAccountName/$containerName/$blobName";
    $hsmac = hash_hmac('sha256', $string, base64_decode($accessToken), true);
    $sign = base64_encode($hsmac);
    $fileContent = file_get_contents($archivo['tmp_name']);
    echo $date. "<br>";
    echo $type. "<br>";
    echo $size. "<br>";
    try {
        // Send PUT request to upload the image
        $response = $client->request('PUT', $endpoint, [
            'headers' => [
                'x-ms-version' => $versionPut,
                'x-ms-date' => $date,
                'Content-Type' => $type,
                'x-ms-blob-type' => 'BlockBlob',
                'Content-Length' => $size,
                'Authorization' => 'SharedKey ' . $storageAccountName . ':' . $sign
            ],
            'body' =>  $fileContent // Open the image file for reading
        ]);
        echo "hola2";
        // Check if the request was successful
        if ($response->getStatusCode() === 201) {
             
            $msg= '<p>Image uploaded successfully!</p>';
             $msg =$msg. '<img src="' . $endpoint . '" alt="">';
        } else {
            $msg= 'Failed to upload image. Status code: ' . $response->getStatusCode();
        }
    } catch (RequestException $e) {
        if ($e->hasResponse()) {
            $response = $e->getResponse();
            $msg = 'Error uploading image. Status code: ' . $response->getStatusCode() . '<br>';
            $msg .= 'Response: ' . nl2br($response->getBody()->getContents()). nl2br($string);
        } else {
            $msg = 'Error uploading image: ' . $e->getMessage() . '<br>';
        }
    } finally{
        
        echo $msg;
    }
    return $endpoint;
};