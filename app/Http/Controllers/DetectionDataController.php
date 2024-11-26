<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessDetectionData;
use Illuminate\Http\Request;

class DetectionDataController extends Controller
{
    public function storeHttp(Request $request): void
    {
        $request->validate([
            'name' => 'required',
        ]);

        ProcessDetectionData::dispatchSync($request->name, $request->image);

    }
}
