<?php

namespace App\Http\Controllers\V1;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\Constants\Messages;
use App\Constants\ResponseType;
use Illuminate\Http\JsonResponse;

class UserController extends V1Controller
{
    public function store(Request $request) : JsonResponse
    {
        $rules = [
            'name' => 'sometimes|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:72'
        ];

        $this->validate($request, $rules);

        $user = new User();
        $user->name = $request->get('name') != null ? $request->get('name') : '';
        $user->email = $request->get('email');
        $user->password = Hash::make($request->get('password'));
        $user->saveOrFail();

        return $this->respond($user->toArray(), [], Messages::USER_CREATED, ResponseType::CREATED);
    }
}
