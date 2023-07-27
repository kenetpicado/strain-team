<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ToggleStatusController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
        	'table' => 'required',
        	'id' => 'required',
        ]);

        $model = DB::table($request->table)->find($request->id);

        DB::table($request->table)
            ->where('id', $request->id)
            ->update([
                'is_active' => !$model->is_active,
            ]);

        return back();
    }
}
