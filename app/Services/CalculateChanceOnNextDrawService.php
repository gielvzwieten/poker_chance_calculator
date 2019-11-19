<?php

namespace App\Services;

class CalculateChanceOnNextDrawService
{

    public function calculate($numberOfCardsLeftInDeck)
    {

        $chanceOnDrawingNextCard = 1 / $numberOfCardsLeftInDeck * 100;

        return $chanceOnDrawingNextCard;
    }

}