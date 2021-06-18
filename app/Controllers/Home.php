<?php

namespace App\Controllers;

/**
 * Simple request to Codelocks API
 * 
 * Example of a simple request to Codelocks API using Guzzle
 *
 * @version 1.0
 * @author Tom.Davies
 */

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException as GuzzleRequestEx;
use GuzzleHttp\Exception\ClientException as GuzzleClientEx;

class Home extends BaseController{

    public $_client;

    public function __construct() {

        /**
         * Initialise GuzzleClient
         */
        $this->_client = new GuzzleClient([
            'timeout' => 10
        ]);
    }

    public function index() {

        /**
         * Parameters for request.
         * See Codelocks Swagger documentation
         * NOTE - Update API key and API URL.
         */
        $vAPIKey = '{{API Key here}}';                                          //  API Key
        $vLockID = '202009301410';                                              //  Lock identifer or timwcode
        $vPath = '{{API URL}}/netcode/'. $vLockID;     
        $aParams = [
            'start' => '2021-01-01 11:00',                                      //  Start date/time Format-> yyyy-MM-dd hh:mm:00
            'duration' => '1',                                                  //  Duration Integer
            'lockmodel' => 'KL1060C2',                                          //  Model of Lock
            'identifier' => '123456'                                            //  Access key / lock numeric identifer
            ];

        try{
            /**
             * Make request to the API.
             */
            $res = $this->_client->request('GET', $vPath, [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'x-api-key' => $vAPIKey,
                    ],
                'query' => $aParams
            ]);

            /**
             * Get JSON body from response.
             * NOTE - In production response should be validated
             */
            $oJson = json_decode($res->getBody());

            // Set content type
            header('Content-Type: application/json');

            echo json_encode($oJson, JSON_PRETTY_PRINT);
        }
        catch(GuzzleRequestEx $ex) {
            $vErrorMessage = strtolower($ex->getMessage());
            $vErrorType = 'Unknown';
            if(preg_match("/cURL error [0-9]+/i", $vErrorMessage, $output_array)) {
                if(count($output_array) == 1) {
                    $vErrorType = $output_array[0];
                }
            }
            switch($vErrorType) {
                case "curl error 7":
                    log_message('error',
                        'get_data - 504 - curl error 7. The request to the tertiary endpoint experienced a timeout.');

                    // Set content type
                    header('Content-Type: application/json');

                    echo json_encode(array(

                        'apikey' => $vAPIKey,
                        'result' => '504 - Guzzle Curl Error 7. Check logs.'

                    ), JSON_PRETTY_PRINT);

                    break;


                default:
                    log_message('error', 'get_data - 500 - error. -> ' . $vErrorMessage);

                    // Set content type
                    header('Content-Type: application/json');
                    echo json_encode(array(

                        'apikey' => $vAPIKey,
                        'result' => '500 - Guzzle General Request Error. Check logs',
                        'message' => $vErrorMessage

                    ), JSON_PRETTY_PRINT);

                    break;
            }
        }
        catch(GuzzleClientEx $ex){
            log_message('error', 'get_data - 502 Guzzle Client Error, Status Code -> ' .$ex->getResponse()->getStatusCode()
                .', Request URL -> ' .$ex->getRequest()->getUri());

            // Set content type
            header('Content-Type: application/json');
            echo json_encode(array(

                'apikey' => $vAPIKey,
                'result' => '502 - Guzzle Client Error. Check logs'

            ), JSON_PRETTY_PRINT);

        }
    }
}
