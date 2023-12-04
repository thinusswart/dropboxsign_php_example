<?php

require_once __DIR__ . "/vendor/autoload.php";

$config = Dropbox\Sign\Configuration::getDefaultConfiguration();

// Configure HTTP basic authorization: api_key
$config->setUsername("<API_KEY_HERE>");

$signatureRequestApi = new Dropbox\Sign\Api\SignatureRequestApi($config);

$signer1 = new Dropbox\Sign\Model\SubSignatureRequestTemplateSigner();
$signer1->setRole("Recipient")
    ->setEmailAddress("<RECIPIENT_EMAIL_ADDRESS")
    ->setName("<RECIPIENT_NAME>");

$signingOptions = new Dropbox\Sign\Model\SubSigningOptions();
$signingOptions->setDraw(true)
    ->setType(true)
    ->setUpload(true)
    ->setPhone(false)
    ->setDefaultType(Dropbox\Sign\Model\SubSigningOptions::DEFAULT_TYPE_DRAW);

$data = new Dropbox\Sign\Model\SignatureRequestSendWithTemplateRequest();
$data->setTemplateIds(["<TEMPLATE_ID>"])
    ->setSubject("Non-Disclosure Agreement")
    ->setMessage("Please sign our standard NDA before we can move on to other business")
    ->setSigners([$signer1])
    ->setSigningOptions($signingOptions)
    ->setTestMode(true);

try {
    $result = $signatureRequestApi->signatureRequestSendWithTemplate($data);
    print_r($result);
} catch (Dropbox\Sign\ApiException $e) {
    $error = $e->getResponseObject();
    echo "Exception when calling Dropbox Sign API: "
        . print_r($error->getError());
}