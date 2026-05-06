<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function services()
    {
        return view('pages.services');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function productsIndex()
    {
        return view('pages.products.index');
    }

    public function productsHis()
    {
        return view('pages.products.his');
    }

    public function productsCms()
    {
        return view('pages.products.cms');
    }

    public function servicesCustomDev()
    {
        return view('pages.services.custom-dev');
    }

    public function blogIndex()
    {
        return view('pages.blog.index');
    }

    public function blogShow($slug)
    {
        return view('pages.blog.show', compact('slug'));
    }
}
