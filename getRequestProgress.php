<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = Dropbox\Sign\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("<API_KEY_HERE>");

$signatureRequestApi = new Dropbox\Sign\Api\SignatureRequestApi($config);

$signatureRequestId = "<SIGNATURE_REQUEST_ID>";

try {
    $result = $signatureRequestApi->signatureRequestGet($signatureRequestId);
    print_r($result);
} catch (Dropbox\Sign\ApiException $e) {
    $error = $e->getResponseObject();
    echo "Exception when calling Dropbox Sign API: "
        . print_r($error->getError());
}