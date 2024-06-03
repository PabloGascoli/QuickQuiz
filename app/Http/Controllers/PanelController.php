<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encuesta;

class PanelController extends Controller
{
    public function index()
    {
        $encuestas = Encuesta::all();
        return view('panel', ['encuestas' => $encuestas]);
    }
}
