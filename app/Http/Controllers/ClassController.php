<?php

namespace App\Http\Controllers;

use App\Models\AcademicSet;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function show(){}
    public function destroy(){}
    public function index(){}
    public function update(){}
    public function store(){}

    public function api_index(Request $request) {
        return AcademicSet::all();
    }

    public function api_fetchClass(Request $request) {
        
        $class = AcademicSet::where('name', '=', $request->get('class_name'))
            ->orWhere('id', '=', $request->get('class_id'));
        return $class->get()->first();
    }
}
