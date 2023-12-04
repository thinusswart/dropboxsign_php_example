<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = Dropbox\Sign\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("<API_KEY_HERE>");

$signatureRequestApi = new Dropbox\Sign\Api\SignatureRequestApi($config);

$signatureRequestId = "<SIGNATURE_REQUEST_ID>";
$fileType = "pdf";

try {
    $result = $signatureRequestApi->signatureRequestFiles($signatureRequestId, $fileType);
    copy($result->getRealPath(), __DIR__ . '/signed_response.pdf');
} catch (Dropbox\Sign\ApiException $e) {
    $error = $e->getResponseObject();
    echo "Exception when calling Dropbox Sign API: "
        . print_r($error->getError());
}
