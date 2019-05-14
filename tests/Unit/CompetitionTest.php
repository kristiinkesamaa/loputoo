<?php

//namespace Tests\Unit;

use App\Competition;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompetitionTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testConvertDatetimeForView()
    {
        $competitions = factory(Competition::class, 2)->make();

        $output = Competition::convert_datetime_for_view($competitions)[1];

        $this->assertEquals("24.05.2019", $output->datetime);
    }
}
