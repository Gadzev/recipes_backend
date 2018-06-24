<?php

namespace App\Libraries;

use GuzzleHttp\Client;
use App\Models\Opaque\OAuthResponse;
use GuzzleHttp\Exception\RequestException;

class AuthManager
{
	public static function proxy(String $grantType, array $data = [])
	{
		$http = new Client();
		$ret = new OAuthResponse();

		$oauthType = array(
			'grant_type' => $grantType,
			'client_id' => env('PASSPORT_CLIENT_ID'),
			'client_secret' => env('PASSPORT_CLIENT_SECRET')
		);

        $params = array_merge($oauthType, $data);

        $uri = sprintf('%s/%s', env('APP_URL'), 'oauth/token');

		try
		{
			$response = $http->post($uri, [
				'form_params' => $params
			]);

			if ($response->getStatusCode() == 200)
			{
				$data = json_decode($response->getBody());
				$ret->accessToken = $data->access_token;
                $ret->refreshToken = $data->refresh_token;
                $ret->expiry = $data->expires_in;
                $ret->success = true;
			}
		}
		catch (RequestException $requestException)
		{
			dd($requestException);
			$ret->success = false;
		}

		return $ret;
	}

	public static function refreshToken(String $refreshToken)
	{
		$oauthResponse = self::proxy('refresh_token', [
			'refresh_token' => $refreshToken
		]);

		return $oauthResponse;
	}
}