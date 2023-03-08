<nav class="navbar navbar-expand-md shadow-sm bg-dark" id="bg-nav">
    <div class="container">
        @if (Auth::check() && Auth::user()->role === 'admin')
            <a class="navbar-brand  text-light" href="{{ route('admin.home') }}">
                <h3 class="navbar-item color-3" style="font-weight: 900 ">Gollvander</h3>
            </a>
        @elseif (Auth::check() && Auth::user()->role === 'customer')
            <a class="navbar-brand text-light" href="{{ route('home') }}">
                <h3 class="navbar-item color-3" style="font-weight: 900 ">Gollvander</h3>
            </a>
        @else
            <a class="navbar-brand text-light" href="{{ route('welcome') }}">
                <h3 class="navbar-item color-3" style="font-weight: 900 ">Gollvander</h3>
            </a>
        @endif
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">

            </ul>

            <ul class="navbar-nav justify-content-center">
                @if (Auth::check() && Auth::user()->role === 'admin')
                <li class="nav-item">
                    <a style="text-decoration: none; font-weight: 300" class="color-4 m-1 justify-content-center" href="#">
                        Home
                    </a>
                    <a style="text-decoration: none; font-weight: 300" class="color-4 m-1 justify-content-center" href="{{ route('admin.home')}}">
                        Product
                     </a>
                        <span style="text-decoration: none; font-weight: 700" class="color-4 justify-content-center" ><span>- Dashboard Admin -</span>
                    <a style="text-decoration: none; font-weight: 300" class="color-4 m-1 justify-content-center" href="{{ route('orderAdmin.show') }}">
                        Order
                    </a>
                    <a style="text-decoration: none; font-weight: 300" class="color-4 m-1 justify-content-center" href="{{ route('transaction.show') }}">
                        Transaksi
                    </a>
                </li>
                @elseif (Auth::check() && Auth::user()->role === 'customer')
                <li class="nav-item">
                    <a style="text-decoration: none; font-weight: 300" class="color-4 m-1 justify-content-center" href="{{ url('/home') }}">
                        Home
                    </a>
                     <span style="text-decoration: none; font-weight: 700" class="color-4 justify-content-center" ><span>- Dashboard User -</span>
                     <a style="text-decoration: none; font-weight: 300" class="color-4 m-1 justify-content-center" href="{{ route('order.waitConfirm') }}">
                        Order
                    </a>
                </li>
                @endif
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                        <hr clas="solid">
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    @if (Auth::user()->role === 'admin')
                    <li class="nav-item">
                        <a href="{{ route('orderAdmin.show') }}" class="nav-link position-relative me-2 text-light">
                            <i class="bi bi-box-seam-fill"></i>
                            <span class="position-absolute top-4 start-90 translate-middle badge rounded-pill"
                                id="button-sec">
                                {{ App\Models\Order::all()->count() }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('transaction.show') }}" class="nav-link position-relative me-2 text-light">
                            <i class="bi bi-check-circle"></i>
                            <span class="position-absolute top-4 start-90 translate-middle badge rounded-pill"
                                id="button-sec">
                                {{ App\Models\Transaction::all()->count() }}
                            </span>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('whistlist.show') }}" class="nav-link position-relative me-2 text-light">
                            <i class="bi bi-bag"></i>
                            @php
                                $whislist = App\Models\Whistlist::where('user_id', '=', Auth::user()->id)->count();
                            @endphp
                            <span class="position-absolute top-4 start-90 translate-middle badge rounded-pill"
                                id="button-sec">
                                {{ $whislist }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('order.waitConfirm') }}" class="nav-link position-relative me-2 text-light">
                            <i class="bi bi-cart-check"></i>
                            @php
                                $orderCount = \App\Models\Order::where('user_id', '=', Auth::user()->id)->count();
                            @endphp
                            <span class="position-absolute top-4 start-90 translate-middle badge rounded-pill"
                                id="button-sec">
                                {{ $orderCount }}
                            </span>
                        </a>
                    </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-light text-capitalize" href="#"
                            role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
