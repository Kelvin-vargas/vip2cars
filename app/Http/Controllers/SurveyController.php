<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index()
    {
        $surveys = Survey::latest()->get();
        return view('surveys.index', compact('surveys'));
    }

    public function create()
    {
        return view('surveys.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'satisfaction_level' => 'required|in:1,2,3,4,5',
            'feedback' => 'nullable|string|max:500',
            'service_area' => 'required|in:ventas,servicio_tecnico,atencion_cliente',
            'recommendation_level' => 'required|in:si,no,talvez'
        ]);

        Survey::create($validated);

        return response()->json(['message' => '¡Gracias por tu opinión!']);
        
    }
}