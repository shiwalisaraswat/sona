<!-- Header Section Begin -->
    <header class="header-section @unless(request()->routeIs('home')) header-normal @endunless">
        <div class="top-nav">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="tn-left">
                            <li><i class="fa fa-phone"></i> (12) 345 67890</li>
                            <li><i class="fa fa-envelope"></i> info.colorlib@gmail.com</li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <div class="tn-right">
                            <div class="top-social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-tripadvisor"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                            <a href="#" class="bk-btn">Booking Now</a>
                            <div class="language-option">
                                <img src="{{ asset('public/img/flag.jpg') }}" alt="">
                                <span>EN <i class="fa fa-angle-down"></i></span>
                                <div class="flag-dropdown">
                                    <ul>
                                        <li><a href="#">Zi</a></li>
                                        <li><a href="#">Fr</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-item">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="logo">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('public/img/logo.png') }}" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-10">
                        <div class="nav-menu">
                            <nav class="mainmenu">
                                <ul>
                                    <li class="active"><a href="{{ route('home') }}">Home</a></li>
                                    <li><a href="{{ route('rooms.index') }}">Rooms</a></li>
                                    <li><a href="{{ route('cms.about_us') }}">About Us</a></li>
                                    <li><a href="#">Pages</a>
                                        <ul class="dropdown">
                                            {{--  <li><a href="{{ route('cms.room_detail') }}">Room Details</a></li> --}}
                                            <li><a href="{{ route('cms.blog_detail') }}">Blog Details</a></li>
                                        </ul>
                                    </li>
                                    <li><a href="{{ route('cms.blog') }}">News</a></li>
                                    <li><a href="{{ route('contact.index') }}">Contact</a></li>
                                    <li>
                                        <a href="{{ route('profile.edit') }}">
                                            @auth
                                                {{ auth()->user()->email }}
                                            @else
                                                <i class="fa fa-user"></i>
                                            @endauth
                                        </a>
                                        <ul class="dropdown">
                                            @guest
                                                <li><a href="{{ route('login') }}">Login</a></li>
                                                <li><a href="{{ route('register') }}">Register</a></li>
                                            @endguest

                                            @auth
                                                <li><a href="{{ route('profile.edit') }}">Profile</a></li>
                                                {{-- <li><a href="{{ route('change.password') }}">Change Password</a>
                                                </li> --}}
                                                <li><hr class="dropdown-divider"></li>
                                                <li>
                                                    <form method="POST" action="{{ route('logout') }}">
                                                        @csrf

                                                        <button class="dropdown-item">
                                                            Logout
                                                        </button>
                                                    </form>
                                                </li>
                                            @endauth
                                        </ul>
                                    </li>
                                </ul>
                            </nav>
                            <div class="nav-right search-switch">
                                <i class="icon_search"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->