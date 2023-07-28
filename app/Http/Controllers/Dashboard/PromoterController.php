<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PromoterRequest;
use App\Services\PasswordService;
use App\Models\Promoter;
use App\Notifications\RegisterNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PromoterController extends Controller
{
    public function index()
    {
        return inertia('Dashboard/Promoters/Index', [
            'promoters' => Promoter::all()
        ]);
    }

    public function store(PromoterRequest $request)
    {
        $password = (new PasswordService)->generate();

        $promoter = Promoter::create($request->validated() + [
            'password' => Hash::make($password),
            'is_active' => true,
        ]);

        $promoter->notify(new RegisterNotification($password));

        return back();
    }

    public function update(PromoterRequest $request, $promoter)
    {
        Promoter::where('id', $promoter)->update($request->validated());

        return back();
    }
}
