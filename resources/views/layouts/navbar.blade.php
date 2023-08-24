<div class="top-header-area" id="sticker">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 text-center">
                <div class="main-menu-wrap">
                    <!-- logo -->
                    <div class="site-logo">
                        <a href="index.html">
                            <img src="user/img/logo.png" alt="">
                        </a>
                    </div>
                    <!-- logo -->

                    <!-- menu start -->
                    <nav class="main-menu">
                        <ul>
                            <li class="current-list-item"><a href="/">Home</a>
                            </li>
                            <li><a href="{{ route('about') }}">About</a></li>
                            <li><a href="{{ route('news') }}">News</a>
                            </li>
                            <li><a href="{{ route('contact') }}">Contact</a></li>
                            <li><a href="{{ route('shop') }}">Shop</a>
                            </li>
                            <li>
                                <div class="header-icons">
                                    <a class="shopping-cart" href="{{ route('cart') }}"><i
                                            class="fas fa-shopping-cart"></i></a>
                                    <a class="mobile-hide search-bar-icon" href="#"><i
                                            class="fas fa-search"></i></a>
                                    @if (auth()->user())
                                        <a class="mobile-hide user-bar-icon" href="">{{ auth()->user()->name }}
                                        </a>
                                        <a class="mobile-hide user-bar-icon" href=""
                                            onclick="event.preventDefault();document.querySelector('#logout').submit()">logout
                                        </a>
                                        <form action="{{ route('logout') }}" method="POST" id="logout">
                                            @csrf
                                        </form>
                                    @else
                                        <a class="mobile-hide user-bar-icon" href="{{ route('login') }}">Login
                                        </a>
                                        <a class="mobile-hide user-bar-icon" href="{{ route('register') }}">Register
                                        </a>
                                    @endif
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
                    <div class="mobile-menu"></div>
                    <!-- menu end -->
                </div>
            </div>
        </div>
    </div>
</div>
