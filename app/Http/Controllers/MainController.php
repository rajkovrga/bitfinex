<?php

namespace App\Http\Controllers;

use App\Services\BitfinexService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class MainController extends Controller
{
    private $btfService;
    public function __construct(BitfinexService $btfService)
    {
        $this->btfService = $btfService;
    }

    public function refresh(Request $request)
    {
        try {
            $data = $this->btfService->getTickers();
            dd($data);
            return response()->json($data);
        }
        catch (ModelNotFoundException $exception)
        {
            return response("Model not found", 404);
        }
        catch (\Exception $exception)
        {
            return response("Server error" . $exception->getMessage(), 400);
        }

    }
}
