<?php

namespace App\Services;

class CalculateChanceOnNextDrawService
{

    public function calculate($totalStartingCardsInDeck ,$numberOfCardsLeftInDeck)
    {

        $chanceOnDrawingNextCard = ($totalStartingCardsInDeck + 1 - $numberOfCardsLeftInDeck) / $totalStartingCardsInDeck * 100;

        return $chanceOnDrawingNextCard;
    }

}