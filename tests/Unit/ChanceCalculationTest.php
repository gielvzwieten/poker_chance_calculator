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
        //if i instantiate the CalculateChanceOnNextDrawService with the method Calculate(52,1)
        //I expect the outcome of 100;
        $newCalculation = new CalculateChanceOnNextDrawService();
        $this->assertEquals('100', $newCalculation->calculate(52, 1));


        //- write a phpunit test to test chance calculation and data generator logic.

        // given i am a player
        // when i hit the endpoint / (card.update) to draw an extra card
        // then the % should change accordingly
    }

    public function test_chance_on_picking_right_card_is_50_when_half_deck_left(){
        $newCalculation = new CalculateChanceOnNextDrawService();
        $this->assertEquals('50', $newCalculation->calculate(52, (52/2)+1));
    }

    public function test_chance_on_picking_right_card_when_picking_first_card(){
        $newCalculation = new CalculateChanceOnNextDrawService();
        $wholeDeckLeft = 1/52 * 100;
        $this->assertEquals($wholeDeckLeft, $newCalculation->calculate(52, 52));
    }
}
