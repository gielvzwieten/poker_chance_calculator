<?php

namespace Tests\Unit;

use App\Services\CalculateChanceOnNextDrawService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChanceCalculationTest extends TestCase
{
//    use RefreshDatabase;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_chance_on_picking_right_card_is_100_percent_when_one_card_left()
    {
        $newCalculation = new CalculateChanceOnNextDrawService();
        $this->assertEquals('100', $newCalculation->calculate(1));
    }

    public function test_chance_on_picking_right_card_is_50_when_2_cards_left_in_deck(){
        $newCalculation = new CalculateChanceOnNextDrawService();
        $this->assertEquals('50', $newCalculation->calculate(2));
    }

    public function test_chance_on_picking_right_card_when_picking_first_card(){
        $newCalculation = new CalculateChanceOnNextDrawService();
        $wholeDeckLeft = 1/52 * 100;
        $this->assertEquals($wholeDeckLeft, $newCalculation->calculate(52));
    }
}
