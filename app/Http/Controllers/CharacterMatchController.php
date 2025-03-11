<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CharacterMatchController extends Controller
{
    public function index()
    {
        return view('character_match');
    }

    public function check(Request $request)
    {
        $request->validate([
            'input1' => 'required|string|max:100',
            'input2' => 'required|string|max:100',
        ]);

        $input1 = strtoupper($request->get('input1'));
        $input2 = strtoupper($request->get('input2'));

        $uniqueChars = array_unique(str_split($input1));
        $matchedChars = array_filter($uniqueChars, fn($char) => str_contains($input2, $char));

        $percentage = count($uniqueChars) > 0 ? (count($matchedChars) / count($uniqueChars)) * 100 : 0;

        return view('character_match', [
            'percentage' => round($percentage, 2),
            'matched_chars' => implode(', ', $matchedChars),
            'input1' => $request->get('input1'),
            'input2' => $request->get('input2')
        ]);
    }
}
