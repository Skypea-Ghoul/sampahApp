<?php
// app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use App\Models\Bin;

class HomeController extends Controller
{
    public function index()
{
    $fullCount  = Bin::where('weight', '>=', 15)->count();
    $halfCount  = Bin::whereBetween('weight', [5, 15])->count();
    $emptyCount = Bin::where('weight', '<', 5)->count();

    $labels = ['Penuh','Setengah','Kosong'];
    $data   = [$fullCount,$halfCount,$emptyCount];

    return view('home', [
        'title'     => 'Dashboard Sampah',
        'fullCount' => $fullCount,
        'halfCount' => $halfCount,
        'emptyCount'=> $emptyCount,
        'labels'    => $labels,
        'data'      => $data,
    ]);
}

}
