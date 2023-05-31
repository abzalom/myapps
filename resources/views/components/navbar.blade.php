<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">Myapps</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @foreach ($navs as $menu)
                    @foreach ($menu['role'] as $role)
                        @role($role)
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ $menu['name'] }}
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @foreach ($menu['drop'] as $drop)
                                        @foreach ($drop['role'] as $dropRole)
                                            @role($dropRole)
                                                <li>
                                                    <a class="dropdown-item" href="{{ $drop['link'] }}">{{ $drop['name'] }}</a>
                                                </li>
                                            @endrole
                                        @endforeach
                                    @endforeach
                                </ul>
                            @endrole
                        </li>
                    @endforeach
                @endforeach
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user"></i> {{ str(auth()->user()->username)->title() }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <form action="{{ route('auth.logout') }}" method="post">
                                @csrf
                                <button class="dropdown-item" href="#">Logout</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
