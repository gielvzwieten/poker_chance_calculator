<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Poker Chance Calculator</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">


    <div class="content">
        <div class="title m-b-md">
            Poker Chance Calculator
        </div>

        <form class="form-horizontal" action="{{route('card.store')}}" method="post">
            @csrf
            <fieldset>

                <!-- Form Name -->
                <legend>Pick a card</legend>

                <!-- Select Suit -->
                <div class="form-group">
                    <label class="col-md-4 control-label" for="card">Select Card</label>
                    <div class="col-md-4">
                        <select id="card" name="card" class="form-control" onchange="this.form.submit()">
                            @foreach($cards as $card)
                                @if(session('userCard'))
                                    <option value="{{$card->id}}" {{ $card->id == session('userCard')->id ? 'selected' : '' }}>{{$card->card}}</option>
                                @else
                                    <option value="{{$card->id}}">{{$card->card}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>

            </fieldset>
        </form>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('message'))
            <p style="color: green">{{ session('message') }}</p>
        @endif

        @if(session()->has('shuffledCards'))
            <h1>Draw New Card</h1>
            <form action="{{route('card.update', $card)}}" method="post">
                @csrf
                @method('PATCH')
                {{--<input type="text" name="card">--}}
                <button class="btn btn-primary btn-block">Draw New Card</button>
            </form>

            <p>Chance on next card being your chosen card: {{round($chanceOnDrawingNextCard, 2) ?? ''}} %</p>
            <p>{{$numberOfCardsLeftInDeck}} cards left</p>
        @endif

    </div>
</div>
</body>
</html>

