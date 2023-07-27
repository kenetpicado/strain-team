<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Hash;

class ForgotPasswordService
{
    public function __invoke($user)
    {
        $clear_password = substr(md5(uniqid(rand(), true)), 0, 10);

        $user->update([
            'password' => Hash::make($clear_password),
        ]);

        return $clear_password;
    }

}
