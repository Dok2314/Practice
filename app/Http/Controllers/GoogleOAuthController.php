<?php

namespace App\Http\Controllers;

use App\Http\Services\GoogleOAuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class GoogleOAuthController extends Controller
{
    private string $scope = "https://www.googleapis.com/auth/youtube";
    public function redirectOnOAuthServer()
    {
        $redirectUrl = route('redirect.code');
        $codeVerifier = Str::random();
        $codeChellange = hash('sha256', $codeVerifier);;

        session(["codeVerifier" => $codeVerifier]);

        $url = GoogleOAuthService::generateOAuthRequestUrl($this->scope, $redirectUrl, $codeChellange);

        return Redirect::to($url);
    }

    public function code(Request $request)
    {
        $codeVerifier = Session::get("codeVerifier");
        $redirectUrl = $request->get('code');

        $tokenResult = GoogleOAuthService::exchangeCodeOnToken($request->get('code'), $codeVerifier, $redirectUrl);

        return $tokenResult;
    }
}