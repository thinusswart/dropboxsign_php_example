<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = Dropbox\Sign\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("<API_KEY_HERE>");

$templateApi = new Dropbox\Sign\Api\TemplateApi($config);

$accountId = "<EMAIL_ADDRESS_YOU_SIGNED_UP_WITH>";

try {
    $result = $templateApi->templateList($accountId);
    print_r($result);
} catch (Dropbox\Sign\ApiException $e) {
    $error = $e->getResponseObject();
    echo "Exception when calling Dropbox Sign API: "
        . print_r($error->getError());
}
