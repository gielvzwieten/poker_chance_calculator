<?php

namespace App\Http\Controllers;

use App\Card;
use App\Services\CalculateChanceOnNextDrawService;
use Illuminate\Http\Request;

class CardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CalculateChanceOnNextDrawService $chanceOnNextDraw)
    {
        $cards = Card::all();
        if (session()->has('shuffledCards')){

//            $totalStartingCardsInDeck = $this->totalStartingCardsInDeck;
            $numberOfCardsLeftInDeck = $this->numberOfCardsLeftInDeck();

            $chanceOnDrawingNextCard = $chanceOnNextDraw->calculate($numberOfCardsLeftInDeck);
            return view('card.index', compact('cards', 'chanceOnDrawingNextCard', 'numberOfCardsLeftInDeck'));

        }


        return view('card.index', compact('cards'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
        $playerCard = Card::where('id', $request->card)->first();
        session()->put('userCard', $playerCard);


//        redirect back to the index
        return redirect()->route('card.index');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Card  $card
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CalculateChanceOnNextDrawService $chanceOnNextDraw)
    {
            $cardOnTopOfDeck = $request->session()->get('shuffledCards')[0]['id'];
            $playersCard = $request->session()->get('userCard')->id;

            if ($playersCard !== $cardOnTopOfDeck) {

                $request->session()->forget('shuffledCards.0');
                $wholeDeck = $request->session()->get('shuffledCards');
                session()->put('shuffledCards', array_values($wholeDeck));
                return redirect()->route('card.index');

            } else {

                $numberOfCardsLeftInDeck = $this->numberOfCardsLeftInDeck();

                $chanceOnDrawingNextCard = $chanceOnNextDraw->calculate($numberOfCardsLeftInDeck);

                session()->flash('message', 'You picked the right card! Your chance on picking this card was ' . $chanceOnDrawingNextCard . '%. Please pick a new card to start the game again' );

                $request->session()->forget(['shuffledCards', 'userCard']);
            }
            return redirect()->route('card.index');
    }

    private function numberOfCardsLeftInDeck() {
        return count(request()->session()->get('shuffledCards'));
    }

}
