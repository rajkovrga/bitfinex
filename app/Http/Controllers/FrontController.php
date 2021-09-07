<?php

namespace App\Http\Controllers;

use App\Services\BitfinexService;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    private $bitfinexService;
    public function __construct(BitfinexService $bitfinexService)
    {
        $this->bitfinexService = $bitfinexService;
    }


    public function home(Request $request)
    {
        $data = $this->bitfinexService->getTickers();
        return view('pages.home')->with(["data" => $data]);
    }
}
