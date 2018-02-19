<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class CashMachineControllerTest extends WebTestCase
{

    /**
     * @param int $httpResponse
     * @param array $response
     * @param int $value
     * @dataProvider dataSetCashMachine
     */
    public function testIndex($httpResponse, $response, $value)
    {
        $client = static::createClient();

        $client->request('GET', '/' . $value);

        $this->assertEquals($httpResponse, $client->getResponse()->getStatusCode());

        $this->assertEquals($response, json_decode($client->getResponse()->getContent(), true));
    }

    /**
     * @return array
     */
    public function dataSetCashMachine()
    {
        return [
            [
                Response::HTTP_OK,
                ['code' => Response::HTTP_OK,  'data' => ['cash' =>  []]],
                ""
            ],
            [
                Response::HTTP_NOT_FOUND,
                ['code' =>  Response::HTTP_NOT_FOUND, 'error' => 'No route found for "GET /-100"'],
                "-100"
            ],
            [
                Response::HTTP_OK,
                ['code' => Response::HTTP_OK, 'data' => ['cash' =>  [100, 100]]],
                "200"
            ],
            [
                Response::HTTP_BAD_REQUEST,
                ['code' =>  Response::HTTP_BAD_REQUEST, 'error' => 'Note not available for this value.'],
                "125"
            ],
            [
                Response::HTTP_OK,
                ['code' => Response::HTTP_OK,  'data' => ['cash' =>  [50, 20, 10]]],
                "80"
            ]
        ];
    }
}
