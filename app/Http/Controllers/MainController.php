<?php

namespace App\Http\Controllers;

use App\Services\BitfinexService;
use http\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    private $btfService;
    public function __construct(BitfinexService $btfService)
    {
        $this->btfService = $btfService;
    }
    public function getOne(Request $request, string $name)
    {
        try {
            $data = $this->btfService->getTickers($name);
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
    public function refreshFav(Request $request, string $name)
    {
        try {
            $data = $this->btfService->getTickers($name);
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
    public function refresh(Request $request)
    {
        try {
            $data = $this->btfService->getTickers();
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
    public function login(Request $request)
    {
        try {
            Session::push('isLogin', true);
            return redirect('/');
        }
        catch (\Exception $exception)
        {
            return redirect('/')->with("error" ,'System error');
        }
    }
    public function logout(Request $request)
    {
        try {
            Session::remove('isLogin');
            Session::flush();
            return redirect('/');
        }
        catch (\Exception $exception)
        {
            return redirect('/')->with("error" ,'System error');
        }

    }

    public function add(Request $request, string $name)
    {
        try {
            $types = Redis::get('types');

            if(!str_contains($types, $name))
                throw new \InvalidArgumentException();

            Redis::set('types', $types . ',' . $name);

            return back();
        }
        catch (\InvalidArgumentException $exception)
        {
            return back()->with("error" ,'This model exists in favorites list');
        }
        catch (\Exception $exception)
        {
            return back()->with("error" ,'System error');
        }
    }
    public function remove(Request $request, string $name)
    {
        try {
            $types = Redis::get('types');

            if($types == null)
                throw new ModelNotFoundException();

            if(!str_contains($types, $name))
                throw new ModelNotFoundException();

            Redis::set('types', str_replace(','.$name, "", $types));

            return back();
        }
        catch (ModelNotFoundException $exception)
        {
            return back()->with("error" ,'Model not found and you cannot remove this element from favorites');
        }
        catch (\Exception $exception)
        {
            return back()->with("error" ,'System error');
        }
    }
}
