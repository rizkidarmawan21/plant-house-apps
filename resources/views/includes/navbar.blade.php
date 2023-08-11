    <nav class="navbar navbar-expand-lg bg-nav navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
        <div class="container">
            <a href="{{ route('home') }}" class="navbar-brand text-white">
                <img src="/images/Logo Arga Hidroponik.svg" alt="Logo" />
                <span class="fw-semibold">ARGHA HIDROPONIK</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
                aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item active">
                        <a href="{{ route('home') }}" class="nav-link text-white">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('shop') }}" class="nav-link text-white">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link text-white">Rewards</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('article.index') }}" class="nav-link text-white">Articles</a>
                    </li>
                    @if (!auth()->user())
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link text-white">Sign up</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn btn-success nav-link text-white px-4">Sign in</a>
                        </li>
                    @endif
                </ul>

                @auth


                    <!-- Dekstop Menu -->
                    <ul class="navbar-nav d-none d-lg-flex align-items-center">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown">
                                @if (auth()->user()->photo)
                                <img src="{{ asset(auth()->user()->photo) }}" alt="user"
                                    class="rounded-circle me-2 profile-picture" style="width: 40px; height:40px; background-size: cover" />
                                @else
                                <img src="https://cdn5.vectorstock.com/i/1000x1000/73/54/blank-photo-icon-vector-29557354.jpg" alt="user" class="rounded-circle me-2 profile-picture" style="width: 40px; height:40px; background-size: cover" />
                                @endif
                                Hi, {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('user.transaction.index') }}" class="dropdown-item">My Transactions</a>
                                </li>
                                <li>
                                    <a href="{{ route('user.profile') }}" class="dropdown-item">Settings</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('cart.index') }}" class="nav-link d-inline-block position-relative">
                                @if (auth()->user()->carts->count() > 0)
                                    <span
                                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary">
                                        {{ auth()->user()->carts->count() }}
                                        <span class="visually-hidden">My Cart</span>
                                    </span>
                                @endif
                                <img src="/images/icon-cart-empty.svg" alt="" />
                            </a>
                        </li>
                    </ul>

                    <!-- mobile -->
                    <ul class="navbar-nav d-block d-lg-none">
                        <li class="nav-item">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown">
                            @if (auth()->user()->photo)
                            <img src="{{ asset(auth()->user()->photo) }}" alt="user"
                                class="rounded-circle me-2 profile-picture" style="width: 40px; height:40px; background-size: cover" />
                            @else
                            <img src="https://cdn5.vectorstock.com/i/1000x1000/73/54/blank-photo-icon-vector-29557354.jpg" alt="user" class="rounded-circle me-2 profile-picture" style="width: 40px; height:40px; background-size: cover" />
                            @endif
                            Hi, {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="{{ route('user.transaction.index') }}" class="dropdown-item">My Transactions</a>
                            </li>
                            <li>
                                <a href="{{ route('user.profile') }}" class="dropdown-item">Settings</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                        </li>
                    </ul>

                @endauth
            </div>
        </div>
    </nav>
