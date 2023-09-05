<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;

class NoticeDetailsController extends Controller
{

    public function __invoke(Request $request)
    {
        try {

            $notice = Notice::published()->find($request->id);

            if(!$notice) abort(404);

            return view('front.pages.notice-details', compact('notice'));

        }catch(\Exception $e){
            dd($e->getMessage());
        }
    }

}
