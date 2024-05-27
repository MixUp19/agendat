<?php

function subirAzure($file){
echo"hola";
$storageAccountName = 'proyectoagendat';
$containerName = 'ejercicios';
$verb = 'PUT';
echo"hola2";

$accessToken = getenv('KEY_STRING_AGENDAT');
echo"hola3";
$archivo = $_FILES['blob'];
$blobName = $archivo['name'];
$imagePath = $archivo['tmp_name'];
$type = $archivo['type'];
$versionPut = '2015-02-21';
echo"hola4";
$endpoint = "https://$storageAccountName.blob.core.windows.net/$containerName/$blobName";
echo"hola5";
$date = gmdate("D, d M Y H:i:s T");
$size = $archivo['size'];

$string="$verb\n\n\n$size\n\n$type\n\n\n\n\n\n\nx-ms-blob-type:BlockBlob\nx-ms-date:$date\nx-ms-version:$versionPut\n/$storageAccountName/$containerName/$blobName";
$sign = base64_encode(hash_hmac('sha256', $string, base64_decode($accessToken)));
$headers = [
    'x-ms-version: ' . $versionPut,
    'x-ms-date: ' . $date,
    'Content-Type: ' . $size,
    'x-ms-blob-type: BlockBlob',
    'Content-Length: ' . $size,
    'Authorization: SharedKey ' . $storageAccountName . ':' . $sign
];
echo"hola6";
$ch = curl_init($endpoint);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
curl_setopt($ch, CURLOPT_POSTFIELDS, file_get_contents($archivo['tmp_name']));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
echo"hola7";
try {
    // Execute the cURL request
    $response = curl_exec($ch);
    echo"hola8";
    // Get the HTTP status code
    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    echo"hola9";
    // Check if the request was successful
    if ($statusCode === 201) {
        echo 'Image uploaded successfully!';
        // Additional logic if needed for successful upload
    } else {
        echo nl2br($string) . '<br>'; 
        echo 'Failed to upload image. Status code: ' . $statusCode . nl2br($response);
        // Additional error handling logic if needed
    }
} catch (Exception $e) {
    // Handle exceptions
    echo 'Error uploading image: ' . $e->getMessage();
}

// Close cURL session
curl_close($ch);
return $endpoint;
}
