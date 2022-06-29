<?php 


require_once('oc-config.php');
require_once(ABSPATH . '/oc-functions.php');
require_once(ABSPATH . '/oc-settings.php');
require_once(ABSPATH . "/oc-includes/adminActions.php");


$webhook_data = new System\Webhook();
	$getWebhooks = $webhook_data->getWebhookRequestSetting();

	if ($getWebhooks) {
		foreach ($getWebhooks as $data) {
			$curl = curl_init();
			$url = $data["webhook_uri"];
			$json = json_decode($data["webhook_json"]);
			
			curl_setopt_array($curl, [
				CURLOPT_URL => $url,
				CURLOPT_HTTPHEADER => array('Content-Type: application/json'),
				CURLOPT_HEADER => false,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_POSTFIELDS => $json,
			]);

			$response = curl_exec($curl);

			if ($error = curl_error($curl)) {
				throw new Exception($error);
			}

			curl_close($curl);
			$response = json_decode($response, true);

			var_dump('Response:', $response);
		}
	}

// https://discord.com/api/webhooks/991672534091173949/Qo-aShOFUcLPYDE3hQxXTrJM2yNyehsCXXstmjuYM6xe4sCl7FGfbwLydVY3dDsHgREu

// $json = '{
//     "glossary": {
//         "title": "example glossary",
// 		"GlossDiv": {
//             "title": "S",
// 			"GlossList": {
//                 "GlossEntry": {
//                     "ID": "SGML",
// 					"SortAs": "SGML",
// 					"GlossTerm": "Standard Generalized Markup Language",
// 					"Acronym": "SGML",
// 					"Abbrev": "ISO 8879:1986",
// 					"GlossDef": {
//                         "para": "A meta-markup language, used to create markup languages such as DocBook.",
// 						"GlossSeeAlso": ["GML", "XML"]
//                     },
// 					"GlossSee": "markup"
//                 }
//             }
//         }
//     }
// }';

// echo json_encode($json) . "\n";
// var_dump(json_decode($json, true));
// function isJson($string) {
//     json_decode($string);
//     return json_last_error() === JSON_ERROR_NONE;
//  }