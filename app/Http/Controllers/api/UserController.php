<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $user = Auth::user();

            $data['token'] = $user->createToken('token-for-'.$user->id)->plainTextToken;

            $data['user'] = $user;

            $message = 'تم تسجيل الدخول بنجاح';

            return $this->success($message, $data);
        }else{
            $error = 'عفواً قم بالتحقق من صحة البيانات المدخلة';

            return $this->error($error);
        }
    }

    public function logout()
    {
        $user = Auth::user();

        $user->tokens()->delete();

        $message = 'تم تسجيل الخروج بنجاح';

        return $this->success($message);
    }
}
