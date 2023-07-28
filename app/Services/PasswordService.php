<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;

class PasswordService
{
    public function update($user)
    {
        $clear_password = $this->generate();

        $user->update([
            'password' => Hash::make($clear_password),
        ]);

        return $clear_password;
    }

    public function generate()
    {
        return substr(md5(uniqid(rand(), true)), 0, 10);
    }

}
