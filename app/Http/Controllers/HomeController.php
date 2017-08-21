<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Menu;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menu = Menu::nested()->get();

        //dd($menu);

        return view('index')->with('menu', $menu);

        /*$theme = \Theme::uses('glamor')->layout('default');

        $view = array(
            'name' => 'Teepluss'
        );

        // home.index will look up the path 'resources/views/home/index.php'
        return $theme->of('home.index', $view)->render();*/
    }
}
