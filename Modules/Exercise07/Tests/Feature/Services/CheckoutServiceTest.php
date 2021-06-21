<?php

namespace Modules\Exercise07\Tests\Feature\Services;

use Modules\Exercise07\Services\CheckoutService;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CheckoutServiceTest extends TestCase
{
    protected $service;

    public function setUp(): void
    {
        parent::setUp();
        $this->service = new CheckoutService();
    }

    /**
     * @dataProvider input_for_calculate_shipping_fee
     * @param $input
     * @param $expected
     */
    public function test_calculate_shipping_fee($input, $expected)
    {
        $order = $this->service->calculateShippingFee($input);
        $this->assertEquals($expected, $order);
    }

    public function input_for_calculate_shipping_fee()
    {
        return [
            // shippingFee = 0, shippingExpressFee > 0
            [
                [
                    'amount' => 1000,
                    'premium_member' => 1,
                    'shipping_express' => 1,
                ], [
                    'amount' => 1000,
                    'premium_member' => 1,
                    'shipping_express' => 1,
                    'shipping_fee' => 500,
                ]
            ],
            // shippingFee > 0, shippingExpressFee > 0
            [
                [
                    'amount' => 1000,
                    'shipping_express' => 1,
                ], [
                    'amount' => 1000,
                    'shipping_express' => 1,
                    'shipping_fee' => 1000,
                ]
            ],
            //  shippingFee > 0, shippingExpressFee = 0
            [
                [
                    'amount' => 1000,
                ], [
                    'amount' => 1000,
                    'shipping_fee' => 500,
                ]
            ],
            // shippingFee = 0, shippingExpressFee = 0
            [
                [
                    'amount' => 5000,
                ], [
                    'amount' => 5000,
                    'shipping_fee' => 0,
                ]
            ],
        ];
    }
}
