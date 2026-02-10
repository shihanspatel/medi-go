<?php

namespace App\Http\Controllers;

use App\Models\AboutHero;
use App\Models\AboutStat;
use App\Models\AboutValue;
use App\Models\Team;
use App\Models\AboutCta;

class AboutController extends Controller
{
    public function index()
    {
        $hero   = AboutHero::where('status', 1)->first();
        $stats  = AboutStat::where('status', 1)->get();
        $values = AboutValue::where('status', 1)->get();
        $teams  = Team::where('status', 1)->get();
        $cta    = AboutCta::where('status', 1)->first();

        return view('about_us', compact(
            'hero',
            'stats',
            'values',
            'teams',
            'cta'
        ));
    }
}
