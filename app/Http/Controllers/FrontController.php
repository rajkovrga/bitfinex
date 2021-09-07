<?php

namespace App\Http\Controllers;

use App\Services\BitfinexService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class FrontController extends Controller
{
    private $bitfinexService;
    public function __construct(BitfinexService $bitfinexService)
    {
        $this->bitfinexService = $bitfinexService;
    }
    public function getOne(Request $request, string $name)
    {
        try {
            $data = $this->bitfinexService->getTickers($name);

            return view('pages.one')->with(['data' => $data[0]]);
        }
        catch (ModelNotFoundException $exception)
        {
            return redirect('/')->with('error', 'Model not found');
        }
        catch (\Exception $exception)
        {
            return redirect('/')->with("error" ,'System error');
        }
    }

    public function home(Request $request)
    {
        try {

        $data = $this->bitfinexService->getTickers();
        return view('pages.home')->with(["data" => $data]);
        }
        catch (\Exception $exception)
        {
            return redirect('/')->with("error" ,'System error');
        }
    }

    public function favorite(Request $request)
    {
        try {
            $types = Redis::connection('redis')->getName('types');
            $data = $this->bitfinexService->getTickers($types);
            return view('pages.fav')->with(["data" => $data]);
        }  catch (\Exception $exception) {
            return redirect('/')->with("error", 'System error');
        }
    }
}
