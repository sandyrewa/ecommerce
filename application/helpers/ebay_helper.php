<?php
/********************************************
Constants used for Trading API calls.
Replace keys and tokens with your information.

********************************************/

// eBay site to use - 0 = United States
DEFINE("SITEID",0);

// production vs. sandbox flag - true=production
DEFINE("FLAG_PRODUCTION",false);

// eBay Trading API version to use
//DEFINE("API_COMPATIBILITY_LEVEL",779);
DEFINE("API_COMPATIBILITY_LEVEL",779);
    
/* Set the Dev, App and Cert IDs
Create these on developer.ebay.com
check if need to use production or sandbox keys */
if (FLAG_PRODUCTION) {

	// PRODUCTION
	// Set the production URL for Trading API
	DEFINE("API_URL",'https://api.ebay.com/ws/api.dll');
	
	// Set production credentials (from developer.ebay.com)
	DEFINE("API_DEV_NAME",'<YOUR_PRODUCTION_DEV_ID>');
	DEFINE("API_APP_NAME",'<YOUR_PRODUCTION_APP_ID>');
	DEFINE("API_CERT_NAME",'<YOUR_PRODUCTION_CERT_ID>');
	
	// Set the auth token for the user profile used
	DEFINE("AUTH_TOKEN",'YOUR_PRODUCTION_TOKEN'); 
	         
} else {  

	// SANDBOX
	// Set the sandbox URL for Trading API calls
	DEFINE("API_URL",'https://api.sandbox.ebay.com/ws/api.dll');
	
	// Set sandbox credentials (from developer.ebay.com)
	DEFINE("API_DEV_NAME",'4bc8c3ce-1755-46f7-98c0-498bc81c861a');
	DEFINE("API_APP_NAME",'sandeeps-393c-4415-963a-9dabf2bae7e2');
	DEFINE("API_CERT_NAME",'5d8d5f41-7428-4155-bf9e-d4d4d7728b3b');
	
	// Set the auth token for the user profile used
	DEFINE("AUTH_TOKEN",'AgAAAA**AQAAAA**aAAAAA**GH03VA**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wFk4GhDJiGoQ+dj6x9nY+seQ**4BEDAA**AAMAAA**fRsbmqS6cR5k+G4/i24LveskRJGl5+kIgvxzCU05KvWyoHf2S7nJf1CngIo5tYu2QvNFFhVcQiZesdINQvs7Ax/ZvkaWLO9Ia0V1r+svvEInPhnC8GUxkzb6k+yGvrrjeEMwtnNkMvRhBA+j8vfTAi+ct7iyy9xXrv8owfpNSO0YMP6GlOtlu3qEbDjrHTN/5SyoGQegdomgro4VQDd+IW2/1cLzACt3ONZYXlmJZstumJyGnR8/6i2mxmzsb2Bgao4DCoIjgRCRou/zc96MVDOxZrfls0lWwE4xhTbQ+DNucWwJlfcCD9ZTS0r/W5yM8SWcbG2iAHe69GtZnvdCo40BjBYT8uYT3n3Xmx3UUqriO7nHHebbAJPGwgwMT+a0TncdVogqb5o2rV4x5UYSRxt9k3H401a/Gm7a2mnIG9/TjzX67NNnp/CoZcTIukcJaIvQT7szXvYrx/ibqhldiBMkFTsVg0jhM3qSsnLRz8tHkPBTqvdijopQf6T+nbyfQlXmMh2JbcIRH/nUMQcSftMKbxeEzrjQpMQbCQ2XBmvHkt98+NML/91XD8Ctq4O5l4y8KVW1O0zEdD7J8aqKg6No8LXs1u+g7nomg71wqe43JtZmV0shjZrhVupt15VP2Dp6l7g827VzaVnaP71rUW4JJ2nh4xyQVa/rJIM9OM1I4J8GNyT67nyQvkYNsAH6OBGDfIv5gw7sbPZiEnqFbtWVNZNlW8p/Ysh9h56Z3GLvpgWgqLDPIF359Hc3nN/o');                 
}

// function for add product on ebay site

// Function to call the Trading API AddItem
function getAddItem($addTitle, $addCatID, $addSPrice, $addPicture, $addDesc) {
	
	/* Sample XML Request Block for minimum AddItem request
	see ... for sample XML block given length*/
	
	// Create unique id for adding item to prevent duplicate adds
	$uuid = md5(uniqid());
	
	// create the XML request
	$xmlRequest  = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
	$xmlRequest .= "<AddItemRequest xmlns=\"urn:ebay:apis:eBLBaseComponents\">";
	$xmlRequest .= "<ErrorLanguage>en_US</ErrorLanguage>";
	$xmlRequest .= "<WarningLevel>High</WarningLevel>";
	$xmlRequest .= "<Item>";
	$xmlRequest .= "<Title>" . $addTitle . "</Title>";
	$xmlRequest .= "<Description>" . $addDesc . "</Description>";
	$xmlRequest .= "<PrimaryCategory>";
	$xmlRequest .= "<CategoryID>" . $addCatID . "</CategoryID>";
	$xmlRequest .= "</PrimaryCategory>";
	$xmlRequest .= "<StartPrice>" . $addSPrice . "</StartPrice>";
	$xmlRequest .= "<ConditionID>1000</ConditionID>";
	$xmlRequest .= "<CategoryMappingAllowed>true</CategoryMappingAllowed>";
	$xmlRequest .= "<Country>US</Country>";
	$xmlRequest .= "<Currency>USD</Currency>";
	$xmlRequest .= "<DispatchTimeMax>3</DispatchTimeMax>";
	$xmlRequest .= "<ListingDuration>Days_7</ListingDuration>";
	$xmlRequest .= "<ListingType>Chinese</ListingType>";
	$xmlRequest .= "<PaymentMethods>PayPal</PaymentMethods>";
	$xmlRequest .= "<PayPalEmailAddress>sandyrewa@gmail.com</PayPalEmailAddress>";
	$xmlRequest .= "<PictureDetails>";
	$xmlRequest .= "<PictureURL>" . $addPicture . "</PictureURL>";
	$xmlRequest .= "</PictureDetails>";
	$xmlRequest .= "<PostalCode>05485</PostalCode>";
	$xmlRequest .= "<Quantity>1</Quantity>";
	$xmlRequest .= "<ReturnPolicy>";
	$xmlRequest .= "<ReturnsAcceptedOption>ReturnsAccepted</ReturnsAcceptedOption>";
	$xmlRequest .= "<RefundOption>MoneyBack</RefundOption>";
	$xmlRequest .= "<ReturnsWithinOption>Days_30</ReturnsWithinOption>";
	$xmlRequest .= "<Description>" . $addDesc . "</Description>";
	$xmlRequest .= "<ShippingCostPaidByOption>Buyer</ShippingCostPaidByOption>";
	$xmlRequest .= "</ReturnPolicy>";
	$xmlRequest .= "<ShippingDetails>";
	$xmlRequest .= "<ShippingType>Flat</ShippingType>";
	$xmlRequest .= "<ShippingServiceOptions>";
	$xmlRequest .= "<ShippingServicePriority>1</ShippingServicePriority>";
	$xmlRequest .= "<ShippingService>USPSMedia</ShippingService>";
	$xmlRequest .= "<ShippingServiceCost>2.50</ShippingServiceCost>";
	$xmlRequest .= "</ShippingServiceOptions>";
	$xmlRequest .= "</ShippingDetails>";
	$xmlRequest .= "<Site>US</Site>";
	$xmlRequest .= "<UUID>" . $uuid . "</UUID>";
	$xmlRequest .= "</Item>";
	$xmlRequest .= "<RequesterCredentials>";
	$xmlRequest .= "<eBayAuthToken>" . AUTH_TOKEN . "</eBayAuthToken>";
	$xmlRequest .= "</RequesterCredentials>";
	$xmlRequest .= "<WarningLevel>High</WarningLevel>";
	$xmlRequest .= "</AddItemRequest>";
	//print_r($xmlRequest);
	// define our header array for the Trading API call
	// notice different headers from shopping API and SITE_ID changes to SITEID
	$headers = array(
		'X-EBAY-API-SITEID:'.SITEID,
		'X-EBAY-API-CALL-NAME:AddItem',
		'X-EBAY-API-REQUEST-ENCODING:XML',
		'X-EBAY-API-COMPATIBILITY-LEVEL:' . API_COMPATIBILITY_LEVEL,
		'X-EBAY-API-DEV-NAME:' . API_DEV_NAME,
		'X-EBAY-API-APP-NAME:' . API_APP_NAME,
		'X-EBAY-API-CERT-NAME:' . API_CERT_NAME,
		'Content-Type: text/xml;charset=utf-8'
		/*X-EBAY-API-APP-ID:sandeeps-393c-4415-963a-9dabf2bae7e2
		X-EBAY-API-VERSION:893
		X-EBAY-API-SITE-ID:0
		X-EBAY-API-CALL-NAME:GeteBayTime
		X-EBAY-API-REQUEST-ENCODING:XML*/
	);
	
	// initialize our curl session
	$session  = curl_init(API_URL);

	// set our curl options with the XML request
	curl_setopt($session, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($session, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($session, CURLOPT_POST, true);
	curl_setopt($session, CURLOPT_POSTFIELDS, $xmlRequest);
	curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
	
	// execute the curl request
	$responseXML = curl_exec($session);
	
	/*if($responseXML===false){
		print_r(curl_getinfo($session));
		print (curl_error($session));
	}
	print_r($responseXML);*/
	// close the curl session
	curl_close($session);

	// return the response XML
	return $responseXML;
}
?>