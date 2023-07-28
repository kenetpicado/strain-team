<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PromoterRequest;
use App\Models\Promoter;
use App\Notifications\RegisterNotification;
use App\Services\GeneralService;
use App\Services\PasswordService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PromoterController extends Controller
{
    public function __construct(
        private readonly GeneralService $generalService
    ) {
    }

    public function index()
    {
        return inertia('Dashboard/Promoters/Index', [
            'promoters' => Promoter::all()
        ]);
    }

    public function store(PromoterRequest $request)
    {
        $this->generalService->storeModel(new Promoter(), $request->validated());

        return back();
    }

    public function update(PromoterRequest $request, $promoter)
    {
        Promoter::where('id', $promoter)->update($request->validated());

        return back();
    }
}
