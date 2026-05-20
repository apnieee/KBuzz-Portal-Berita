<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\News;
use App\Models\Author;

class LandingController extends Controller
{
    public function index()
    {
        $banners = Banner::whereHas('news', function($query) {
        $query->whereNotNull('author_id')
            ->whereHas('author');
        })
            ->with('news.newsCategory', 'news.author.user')
            ->get();
        $featured = News::where('is_featured', true)
            ->with('newsCategory')
            ->get();

        $news = News::orderBy('created_at', 'desc')
            ->with('newsCategory')
            ->take(4)
            ->get();

        $authors = Author::with('user', 'news')
            ->take(5)
            ->get();

        return view('pages.landing', compact('banners', 'featured', 'news', 'authors'));
    }
}