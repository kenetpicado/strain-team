<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Module;
use App\Notifications\RegisterNotification;
use App\Services\PasswordService;
use Illuminate\Support\Facades\Hash;

class GeneralService
{
    public function storeModel($model, $data): void
    {
        $password = (new PasswordService)->generate();

        $user = $model::create($data + [
            'password' => Hash::make($password),
            'is_active' => true,
        ]);

        $user->notify(new RegisterNotification($password));
    }
}
