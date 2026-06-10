<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function show()
    {
        return view('form');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3'
        ]);

        // return $request->name;

        // return redirect('/form')->with('success', 'Form submitted successfully!');

        return redirect()
            ->route('form.show')
            ->with('success', 'Form submitted successfully!');

    }
}