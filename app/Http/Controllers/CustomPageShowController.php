<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class CustomPageShowController extends Controller
{

    public function __invoke(Request $request)
    {
        try {

            $page = Page::published()->where('slug', $request->page_slug)->first();

            if(!$page) abort(404);

            return view('front.pages.custom-page', compact('page'));

        }catch(\Exception $e){
            abort(403);
        }
    }

}
