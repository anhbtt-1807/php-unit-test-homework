<?php

namespace Modules\Exercise04\Tests\Feature\Services;

use Carbon\Carbon;
use Modules\Exercise04\Services\CalendarService;
use Tests\TestCase;

class CalendarServiceTest extends TestCase
{
    protected $calendarService;

    protected function setUp(): void
    {
        parent::setup();

        $this->calendarService = new CalendarService();
    }

    /**
     * @dataProvider provider_get_date_class
     */
    public function test_get_date_class($date, $class)
    {
        $response =$this->calendarService->getDateClass($date, ['2021-04-30', '2021-05-01']);

        $this->assertEquals($class, $response);
    }

    function provider_get_date_class()
    {
        return [
            [
                Carbon::createFromFormat('Y-m-d', '2021-05-01'),
                CalendarService::COLOR_RED,
            ],
            [
                Carbon::createFromFormat('Y-m-d', '2021-05-02'),
                CalendarService::COLOR_RED,
            ],
            [
                Carbon::createFromFormat('Y-m-d', '2021-04-30'),
                CalendarService::COLOR_RED,
            ],
            [
                Carbon::createFromFormat('Y-m-d', '2021-05-03'),
                CalendarService::COLOR_BLACK,
            ],
            [
                Carbon::createFromFormat('Y-m-d', '2021-05-08'),
                CalendarService::COLOR_BLUE,
            ],
        ];
    }
}
