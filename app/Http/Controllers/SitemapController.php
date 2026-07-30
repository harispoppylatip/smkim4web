<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\ProgramKeahlian;
use Illuminate\Support\Facades\URL;

class SitemapController extends Controller
{
    public function index()
    {
        $staticPages = collect([
            ['loc' => URL::to('/'), 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['loc' => URL::to('/berita'), 'priority' => '0.9', 'changefreq' => 'daily'],
            ['loc' => URL::to('/program-keahlian'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => URL::to('/profile'), 'priority' => '0.7', 'changefreq' => 'monthly'],
            ['loc' => URL::to('/contact'), 'priority' => '0.6', 'changefreq' => 'monthly'],
            ['loc' => URL::to('/spmb'), 'priority' => '0.8', 'changefreq' => 'monthly'],
            ['loc' => URL::to('/tentang-pengembang'), 'priority' => '0.3', 'changefreq' => 'yearly'],
        ]);

        $berita = Berita::select('slug', 'updated_at', 'created_at')->get()->map(function ($item) {
            return [
                'loc' => URL::to('/berita/' . $item->slug),
                'priority' => '0.8',
                'changefreq' => 'weekly',
                'lastmod' => $item->updated_at ? $item->updated_at->toAtomString() : ($item->created_at ? $item->created_at->toAtomString() : null),
            ];
        });

        $programKeahlian = ProgramKeahlian::select('slug', 'updated_at', 'created_at')->get()->map(function ($item) {
            return [
                'loc' => URL::to('/program-keahlian/' . $item->slug),
                'priority' => '0.8',
                'changefreq' => 'weekly',
                'lastmod' => $item->updated_at ? $item->updated_at->toAtomString() : ($item->created_at ? $item->created_at->toAtomString() : null),
            ];
        });

        $pages = $staticPages->concat($berita)->concat($programKeahlian);

        return response()
            ->view('sitemap', compact('pages'))
            ->header('Content-Type', 'application/xml');
    }
}
