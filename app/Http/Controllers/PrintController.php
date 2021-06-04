<?php

namespace App\Http\Controllers;

class PrintController extends Controller
{
    public function estimate(string $type)
    {
        return view(sprintf('print.estimate.%s', $type), [
            'replacements' => [],
        ]);
    }
}
