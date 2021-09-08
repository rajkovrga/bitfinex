<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Services\BitfinexService;
use App\Services\RedisService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MainController extends Controller
{
    private $btfService;
    private $redisService;
    private $authService;
    public function __construct(BitfinexService $btfService, RedisService $redisService, AuthService $authService)
    {
        $this->btfService = $btfService;
        $this->redisService = $redisService;
        $this->authService = $authService;
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

            $this->authService->login();
            return redirect('/');
        }
        catch (AuthenticationException $exception)
        {
            return redirect('/')->with("error" ,'User logged in');
        }
        catch (\Exception $exception)
        {
            return redirect('/')->with("error" ,'System error');
        }
    }
    public function logout(Request $request)
    {
        try {
            $this->authService->logout();
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
            $this->redisService->setType( $name);

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

            $this->redisService->removeType( $name);

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
