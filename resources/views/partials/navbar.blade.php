<nav class="navbar navbar-expand-md shadow-sm bg-light" id="bg-primarys">
    <div class="container">
        @if (Auth::check() && Auth::user()->role === 'admin')
            <a class="navbar-brand text-light" href="{{ route('admin.home') }}">
                laH?shop
            </a>
        @elseif (Auth::check() && Auth::user()->role === 'custom')
            <a class="navbar-brand text-light" href="{{ route('home') }}">
                laH?shop
            </a>
        @else
            <a class="navbar-brand text-light" href="{{ route('welcome') }}">
                laH?shop
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

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

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
                                    {{ App\Models\Order::all()->count() }}+
                                </span>
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('whistlist.show') }}" class="nav-link position-relative me-2 text-light">
                                <i class="bi bi-bag"></i>
                                {{-- @php
                                    $whislist = App\Models\Whistlist::where('user_id', '=', Auth::user()->id)
                                        ->where('product_id', App\Models\Whistlist::where('user_id', '=', Auth::user()->id))
                                        ->count();
                                    
                                @endphp --}}
                                <span class="position-absolute top-4 start-90 translate-middle badge rounded-pill"
                                    id="button-sec">
                                    {{-- {{ $whistlist }} --}}
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('order.waitConfirm') }}" class="nav-link position-relative me-2 text-light">
                                <i class="bi bi-cart-check"></i>

                                {{-- @php
                                    $whistlist = \App\Models\Whistlist::where('user_id', '=', Auth::user()->id)
                                        ->get()
                                        ->count();
                                @endphp --}}
                                <span class="position-absolute top-4 start-90 translate-middle badge rounded-pill"
                                    id="button-sec">
                                    {{-- {{ $whistlist }} --}}
                                    5
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
