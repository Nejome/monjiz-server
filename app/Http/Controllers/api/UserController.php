<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController as BaseController;

class UserController extends BaseController
{
    public function login(Request $request)
    {
        if(auth()->attempt(['email' => $request->email, 'password' => $request->password])){
            $user = auth()->user();

            $data['token'] = $user->createToken('token-for-'.$user->id)->plainTextToken;

            $message = 'تم تسجيل الدخول بنجاح';

            return $this->success($message, $data);
        }else{
            $error = 'عفواً قم بالتحقق من صحة بيانات تسجيل الدخول الخاصة بك';

            return $this->error($error);
        }
    }

    public function logout()
    {
        $user = auth()->user();

        $user->tokens()->delete();

        $message = 'تم تسجيل الخروج بنجاح';

        return $this->success($message);
    }
}
