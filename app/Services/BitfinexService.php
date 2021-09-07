<?php

namespace App\Services;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Http;

class BitfinexService
{
    public  function getTickers(string $symbols = 'tBTCUSD,tETHUSD,tLTCUSD,tLTCBTC,tETHBTC')
    {
        $data =  Http::get('https://api-pub.bitfinex.com/v2/tickers',[
            'symbols' => $symbols,
        ])->json();

        if($data == null)
            throw new ModelNotFoundException();

        return $data;
    }

}
