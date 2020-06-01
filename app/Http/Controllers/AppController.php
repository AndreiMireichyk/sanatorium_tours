<?php

namespace App\Http\Controllers;

use App\Http\Requests\EncodeUrlRequest;
use App\Models\Url;
use http\Env\Response;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        return view('welcome', [
            'last_urls'=>Url::take(10)->orderBy('id', 'desc')->get()
        ]);
    }

    public function encodeUrl(EncodeUrlRequest $request)
    {
        $url = Url::firstOrCreate($request->only('url'));

        $url->setHash();

        $url->save();

        return redirect()->route('home')
            ->withInput($request->only('url'))
            ->with('result', route('decode', $url->getAttribute('hash')));
    }

    public function apiEncodeUrl(EncodeUrlRequest $request)
    {
        $url = Url::firstOrCreate($request->only('url'));

        $url->setHash();

        $url->save();

        return response()->json([
            'full'=>$url->url,
            'short'=>route('decode', $url->getAttribute('hash'))
        ]);
    }


    public function decodeUrl(Request $request, $hash)
    {
        $url = Url::where('hash', $hash)->firstOrFail();

        return redirect($url->url);
    }
}
