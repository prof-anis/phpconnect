<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShortenUrlController
{
    public function index()
    {
        return view('welcome', [
            'urls' => ShortUrl::latest()->paginate(30),
        ]);
    }

    public function store(Request $request)
    {
        dd('jkl');

        ShortUrl::create([
            'url' => $request->get('url'),
            'short_url' => Str::random(7),
        ]);

        return redirect()->route('url.index')->with(['status' => 'Url created successfully']);
    }

    public function show(ShortUrl $url)
    {
        return redirect()->away($url->url);
    }

    public function destroy(ShortUrl $url)
    {
        $url->delete();

        return redirect()->route('url.index');
    }
}
