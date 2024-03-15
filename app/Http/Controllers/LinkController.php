<?php

namespace App\Http\Controllers;

use App\Exceptions\RedirectException;
use App\Http\Resources\LinkResource;
use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class LinkController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'link' => 'url:http,https|required|unique:links,link',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $link= Link::create([
            'link' => $request->link,
            'short_link' => Str::random(8)
        ]);

        return new LinkResource($link);
    }
    public function redirect_short_link(string $short_link){
        if($link = Link::where('short_link',$short_link)->first()){
            return redirect($link->link);
        }

        throw new RedirectException();
    }
}
