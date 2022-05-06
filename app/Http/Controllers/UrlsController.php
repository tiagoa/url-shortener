<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller as AppController;
use App\Http\Requests\NewUrl;
use App\Jobs\UrlTitle;
use App\Models\Url;

class UrlsController extends AppController {

    public function new(NewUrl $req)
    {
        $url = new Url();
        $url->url = $req->url;
        $url->save();
        UrlTitle::dispatchAfterResponse($url);
        return $url;
    }

    public function get($uniq)
    {
        $url = Url::where('uniq', $uniq)->first();
        $url->visits++;
        $url->save();
        return redirect()->away($url['url']);
    }

    public function top100()
    {
        $urls = Url::orderBy('visits', 'desc')->limit(100)->get();
        return $urls;
    }
}
