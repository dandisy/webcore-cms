<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasRole(['administrator','superadministrator','user'])) {
            return view('admin.home');
        } else {
            return redirect(url('beranda'));
        }

        /*$theme = \Theme::uses('glamor')->layout('default');

        $view = array(
            'name' => 'Teepluss'
        );

        // home.index will look up the path 'resources/views/home/index.php'
        return $theme->of('home.index', $view)->render();*/
    }
}
