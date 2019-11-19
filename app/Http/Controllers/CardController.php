<?php

namespace App\Http\Controllers;

use App\Card;
use App\Services\CalculateChanceOnNextDrawService;
use Illuminate\Http\Request;

class CardController extends Controller
{

    /**
     * @param CalculateChanceOnNextDrawService $chanceOnNextDraw
     * @return \Illuminate\Http\Response
     */
    public function index(CalculateChanceOnNextDrawService $chanceOnNextDraw)
    {
        $cards = Card::all();

        if (!session()->has('shuffledCards')){
            return view('card.index', compact('cards'));
        }

        $numberOfCardsLeftInDeck = count(request()->session()->get('shuffledCards'));
        $chanceOnDrawingNextCard = $chanceOnNextDraw->calculate($numberOfCardsLeftInDeck);

        return view('card.index', compact('cards', 'chanceOnDrawingNextCard', 'numberOfCardsLeftInDeck'));
    }

    /**
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->session()->regenerate();

//        Put all shuffled cards to the session when a player picks a card
        $cards = Card::all();
        $cardsShuffled = $cards->shuffle()->toArray();
        session()->put('shuffledCards', $cardsShuffled);

//        Put the picked card by user to the session
        $playerCard = Card::find($request->card);
        session()->put('userCard', $playerCard);

//        redirect back to the index
        return redirect()->route('card.index');
    }


    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  CalculateChanceOnNextDrawService $chanceOnNextDraw
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CalculateChanceOnNextDrawService $chanceOnNextDraw)
    {
            $cardOnTopOfDeck = $request->session()->get('shuffledCards')[0]['id'];
            $playerCard = $request->session()->get('userCard')->id;

            if ($playerCard !== $cardOnTopOfDeck) {

                $request->session()->forget('shuffledCards.0');
                $wholeDeck = $request->session()->get('shuffledCards');

                session()->put('shuffledCards', array_values($wholeDeck));

            } else {

                $numberOfCardsLeftInDeck = count(request()->session()->get('shuffledCards'));
                $chanceOnDrawingNextCard = $chanceOnNextDraw->calculate($numberOfCardsLeftInDeck);

                session()->flash('message', 'You picked the right card! Your chance on picking this card was ' . $chanceOnDrawingNextCard . '%. Please pick a new card to start the game again' );

                $request->session()->forget(['shuffledCards', 'userCard']);
            }

            return redirect()->route('card.index');
    }

}
