<?php

namespace App\Http\Controllers\Clinical;

use App\Http\Controllers\Controller;
use App\Models\Clinical\Staff;
use Illuminate\Http\JsonResponse;

class StaffIndexController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json(
            Staff::with('person')->get()
        );
    }
}
