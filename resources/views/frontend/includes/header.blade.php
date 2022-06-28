<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-lg-2">
                <div class="header__logo">
                    <a href="/"><img src="/frontend/img/logohome.png" alt=""></a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-7">
                <nav class="header__menu">
                    <ul>
                        @foreach($menus as $menu)
                        <li><a href="{{$menu->url}}">{{$menu->name}}</a></li>
                        @endforeach
                    </ul>
                </nav>
            </div>
            <div class="col-lg-3">
                <div class="header__right">
                    <div class="header__right__auth">
                        <nav class="header__menu">
                            <ul class="header__right__widget">
                                @if (auth('admin')->check())
                                <li class="nav-item nav-link"><a href="#"> {{auth('admin')->user()->name}}</a>
                                    <ul class="dropdown">
                                        <li><a href="{{route('backend.dashboard.index')}}">Trang quản trị</a></li>
                                        <li><a href="{{route('cart')}}">Giỏ hàng</a></li>
                                        <li>
                                            <form action="{{route('auth.logoutAdmin')}}" method="post">
                                                @csrf
                                                <a href="#" class="nav-link" onclick="this.closest('form').submit(); return false;">
                                                    Đăng xuất
                                                </a>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                @elseif (auth()->check())
                                <li class="nav-item nav-link"><a href="#"> {{auth()->user()->name}}</a>
                                    <ul class="dropdown">
                                        <li><a href="{{route('order')}}">Đơn hàng</a></li>
                                        <li><a href="{{route('cart')}}">Giỏ hàng</a></li>
                                        <li>
                                            <form action="{{route('auth.logout')}}" method="post">
                                                @csrf
                                                <a href="#" class="nav-link" onclick="this.closest('form').submit(); return false;">
                                                    Đăng xuất
                                                </a>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                                @else
                                <li><a href="{{route('cart')}}">Đơn hàng</a></li>
                                <li><a href="{{ route('auth.login')}}" class="nav-item nav-link">Đăng nhập</a></li>
                                <li><a href="{{ route('auth.register')}}" class="nav-item nav-link"> Đăng ký </a></li>
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="canvas__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
</header>