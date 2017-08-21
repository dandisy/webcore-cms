<div class="menu-hover">
    <div class="btn-menu">
        <span></span>
    </div><!-- //mobile menu button -->
</div>

<div class="header-inner-pages">
    <div class="top">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav class="navbar navbar-right menu-top">
                        <ul class="menu">
                            <li><a href="#">Member</a>
                                @if(Auth::user())
                                    <ul class="submenu submenu-right">
                                        <li>
                                            <a href="profiles/{{ Auth::user()->id }}"><span class="hidden-xs">{!! Auth::user() ? Auth::user()->name : '' !!}</span></a>
                                        </li>
                                        <li>
                                            <a href="{!! url('/logout') !!}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                Sign out
                                            </a>
                                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                @else
                                    <ul class="submenu submenu-right">
                                        <li><a href="login">Masuk</a></li>
                                        <li><a href="register">Daftar</a></li>
                                    </ul><!-- /.submenu -->
                                @endif
                            </li>
                        </ul><!-- /.menu -->
                    </nav><!-- /.mainnav -->

                    <a class="navbar-right search-toggle show-search" href="#">
                        <i class="fa fa-search"></i>
                    </a>

                    <div class="submenu top-search">
                        <form class="search-form">
                            <div class="input-group">
                                <input type="search" class="search-field" placeholder="Search Here">
                                <span class="input-group-btn">
                                    <button type="submit"><i class="fa fa-search fa-4x"></i></button>
                                </span>
                            </div>
                        </form>
                    </div>

                    <div class="navbar-right topnav-sidebar">
                        <ul class="textwidget">
                            <li>
                                <a href="#"><i class="fa fa-phone"></i> 021-12345678</a>
                            </li>
                        </ul>
                    </div>
                </div><!-- col-md-12 -->
            </div><!-- row -->
        </div><!-- container -->
    </div><!-- Top -->    
</div><!-- header-inner-pages -->

<!-- Header -->
<header id="header" class="header">
    <div class="header-wrap">
        <div class="container">
            <div class="header-wrap clearfix">
                <div id="logo" class="logo">
                    <a href="{{ url('beranda') }}" rel="home">
                        <img src="{{ asset('themes/default/assets/img/logo.png') }}" alt="image">
                    </a>
                </div><!-- /.logo -->


                <div class="nav-wrap">

                    <nav id="mainnav" class="mainnav">
                        <ul class="menu">
                            @foreach($menu as $item)
                            <li>
                                <a href="{{ $item['link'] }}">{{ $item['label'] }} <span class="menu-description"></span></a>
                                @if(count($item['child'] > 0))
                                <ul class="submenu">
                                    @foreach($item['child'] as $child)
                                    <li><a href="{{ $child['link'] }}">{{ $child['label'] }}<span></span></a></li>
                                    @endforeach
                                </ul><!-- /.submenu -->
                                @endif
                            </li>
                            @endforeach
                            {{--<li class="home">
                                <a href="index.html">Beranda <span class="menu-description">WebCORE</span></a>
                            </li>
                            <li>
                                <a href="#">Informasi <span class="menu-description">Publik</span></a>
                                <ul class="submenu">
                                    <li><a href="#">Berkala</a></li>
                                    <li><a href="#">Serta Merta</a></li>
                                    <li><a href="#">Setiap Saat</a></li>
                                </ul><!-- /.submenu -->
                            </li>
                            <li>
                                <a href="#">Layanan <span class="menu-description">Informasi</span></a>
                                <ul class="submenu">
                                    <li><a href="#">Permohonan Informasi</a></li>
                                    <li><a href="#">Pengajuan Keberatan</a></li>
                                    <li><a href="#">Statistik Akses Informasi Publik</a></li>
                                    <li><a href="#">Laporan Layanan Informasi Publik</a></li>
                                </ul><!-- /.submenu -->
                            </li>
                            <li class="has-mega-menu"><a href="#">Standar <span class="menu-description">Layanan</span></a>
                                <ul class="submenu submenu-right">
                                    <li><a href="#">Prosedur Permohonan Informasi</a></li>
                                    <li><a href="#">Prosedur Pengajuan Keberatan</a></li>
                                    <li><a href="#">Jalur dan Waktu Layanan</a></li>
                                    <li><a href="#">Biaya Layanan</a></li>
                                </ul><!-- /.submenu -->
                            </li>--}}                                        
                        </ul><!-- /.menu -->
                    </nav><!-- /.mainnav -->
                </div><!-- /.nav-wrap -->
            </div><!-- /.header-wrap -->
        </div><!-- /.container-->
    </div><!-- /.header-wrap-->
</header><!-- /.header -->