<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Libraries\AuthManager;
use App\Constants\Messages;
use App\Constants\Errors;
use App\Constants\ResponseType;

class AuthController extends V1Controller
{
    public function auth(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|email',
            'password' => 'required|min:6'
        ]);

        $username = $request->get('username');
        $password = $request->get('password');

        $oauthResponse = AuthManager::proxy('password', [
            'username' => $username,
            'password' => $password
        ]);

        if ($oauthResponse->success)
            return $this->respond($oauthResponse->toArray(), [], Messages::OAUTH_TOKEN_ISSUED);
        else
            return $this->respond(null, [ Errors::AUTHENTICATION_FAILED], Errors::REQUEST_FAILED, ResponseType::FORBIDDEN);
    }
}
