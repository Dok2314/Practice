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
    public function redirectOnOAuthServer(Request $request)
    {
        $redirectUrl = route('redirect.code', ['code' => $request->get('code')]);
        $codeVerifier = Str::random();
        $codeChellange = hash('sha256', $codeVerifier);;

        session(["codeVerifier" => $codeVerifier]);

        $url = GoogleOAuthService::generateOAuthRequestUrl($this->scope, $redirectUrl, $codeChellange);

        return Redirect::to($url);
    }

        public function code($code)
    {
        $codeVerifier = Session::get("codeVerifier");
        $redirectUrl = route('redirect.code', ['code' => $code]);

        $tokenResult = GoogleOAuthService::exchangeCodeOnToken($code, $codeVerifier, $redirectUrl);

        return $tokenResult;
    }
}