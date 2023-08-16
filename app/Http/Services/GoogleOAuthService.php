<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class GoogleOAuthService
{
    private static string $clientId = '17045592431-4n68fvp5d442iv338ubd0u0hcdtug5i3.apps.googleusercontent.com';

    private static string $clientSecret = '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';

    private static string $OAuthServerEndpoint = "https://accounts.google.com/o/oauth2/v2/auth";

    private static string $tokenEndpoint = "https://oauth2.googleapis.com/token";

    public static function generateOAuthRequestUrl(string $scope, string $redirectUrl, string $codeChallange): string
    {
        $endpoint = self::$OAuthServerEndpoint;

        $queryParams = [
            "client_id" => self::$clientId,
            "redirect_url" => $redirectUrl,
            "response_type" => "code",
            "scope" => $scope,
            "code_challenge" => $codeChallange,
            "code_challenge_method" => "S256",
        ];

        $query_string = http_build_query($queryParams);

        dd($endpoint . "?" . $query_string);
        return $endpoint . "?" . $query_string;
    }

    public static function exchangeCodeOnToken(string $code, string $codeVerifier, string $redirectUrl)
    {
        $endpoint = self::$tokenEndpoint;

        $queryParams = [
            "client_id" => self::$clientId,
            "client_secret" => self::$clientSecret,
            "code" => $code,
            "code_verifier" => $codeVerifier,
            "grant_type" => "authorization_code",
            "redirect_uri" => $redirectUrl,
        ];

        return Http::post($endpoint, $queryParams);
    }

    public static function refreshToken(string $refreshToken)
    {
        
    }
}