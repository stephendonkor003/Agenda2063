<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function performance()
    {
        return view('pages.performance');
    }

    public function news()
    {
        return view('pages.news');
    }

    public function newsDetail($slug = null)
    {
        return view('pages.news-detail');
    }

    public function knowledgeBase()
    {
        return view('pages.knowledge-base');
    }

    public function flagshipProjects()
    {
        return view('pages.flagship-projects');
    }

    public function continentalFrameworks()
    {
        return view('pages.continental-frameworks');
    }
}
