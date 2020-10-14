<?php

namespace Tests\Feature\Controllers\API;

use App\Enum\searchTypeEnum;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HotelControllerTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();
        //$this->setBaseRoute('admin.login.index');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * A test for user can get data for certain provider
     *
     * @return void
     */
    public function testUserCanGetDataForCertainProvider()
    {
        //loop through avalilable providers and test them
        foreach (\Illuminate\Support\Facades\Config::get('providers') as $provider_code => $provider) {
            logger($provider_code);
            //first init get array
            $requestParams = ['provider_code' => $provider_code];
            //populate reuqest params with provider details
            foreach ($provider['request_params'] as $param) {
                $requestParams [$param['name']] = $param['test_value'];
            }
            logger(print_r($requestParams, true));
            $response = $this->json('GET', '/api/searchHotels/' . searchTypeEnum::SELECTED, $requestParams);

            $response
                ->assertStatus(200)
                ->assertJson([
                ]);
        }

    }

    /**
     * A test for user can get data for all providers
     *
     * @return void
     */
    public function testUserCanGetDataForAllProviders()
    {
        $requestParams = [
            'city' => 'adults_number',
            'from_date' => '11-9-2019',
            'to_date' => '11-9-2019',
            'adults_number' => 4,
        ];
        $response = $this->json('GET', '/api/searchHotels/' . searchTypeEnum::AGGREGATOR, $requestParams);

        $response
            ->assertStatus(200)
            ->assertJson([
            ]);
    }

    /**
     * A test validation for certain provider
     *
     * @return void
     */
    public function testUserValidateGetHotelsCertainProvider()
    {
        //loop through avalilable providers and test them
        foreach (\Illuminate\Support\Facades\Config::get('providers') as $provider_code => $provider) {
            //first init get array
            $requestParams = ['provider_code' => $provider_code];
            //randomley unset values of sent params to chech validation
            $randomMissingParam = random_int(0, $this->count($provider['request_params']));

            //set provider key index
            $providerIndex = 0;

            //populate request params with provider details
            foreach ($provider['request_params'] as $param) {
                //remove random param to invalidate the request
                if ($providerIndex == $randomMissingParam) {
                    continue;
                }
                $requestParams [$param['name']] = $param['test_value'];
                $providerIndex++;
            }
            logger(print_r($requestParams, true));
            $response = $this->json('GET', '/api/searchHotels/' . searchTypeEnum::SELECTED, $requestParams);

            $response
                ->assertStatus(422)
                ->assertJson([
                ]);
        }
    }

    /**
     * A test validation for all providers
     *
     * @return void
     */
    public function testUserValidateGetHotelsAllProviders()
    {
        //init request params
        $requestParams = [
            'city' => 'adults_number',
            'from_date' => '11-9-2019',
            'to_date' => '11-9-2019',
            'adults_number' => 4,
        ];

        //randomley unset values of sent params to chech validation
        unset($requestParams[array_rand($requestParams)]);


        $response = $this->json('GET', '/api/searchHotels/' . searchTypeEnum::AGGREGATOR, $requestParams);

        $response
            ->assertStatus(422)
            ->assertJson([
            ]);
    }

}
