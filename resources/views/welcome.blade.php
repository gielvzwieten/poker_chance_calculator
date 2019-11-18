<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

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

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
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

                <form class="form-horizontal">
                    @csrf
                    <fieldset>

                        <!-- Form Name -->
                        <legend>Pick a card</legend>

                        <!-- Select Suit -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="suit">Select Suit</label>
                            <div class="col-md-4">
                                <select id="suit" name="suit" class="form-control">
                                    <option value="1">Option one</option>
                                    <option value="2">Option two</option>
                                </select>
                            </div>
                        </div>

                        <!-- Select Card Rank -->
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="cardRank">Select Card Rank</label>
                            <div class="col-md-4">
                                <select id="cardRank" name="cardRank" class="form-control">
                                    <option value="1">Option one</option>
                                    <option value="2">Option two</option>
                                </select>
                            </div>
                        </div>

                        <!-- Submit Form -->
                        <button class="btn btn-primary btn-block">Go</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </body>
</html>
