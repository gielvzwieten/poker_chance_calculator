<?php


namespace App\Services;


class ShuffleDataService
{
    public function shuffleData($data)
    {
        $shuffledData = shuffle($data);
        return $shuffledData;
    }
}