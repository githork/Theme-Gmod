<nav class="navbar navbar-expand-md navbar-dark text-uppercase bg-primary">
    <div class="container">
        <a class="navbar-brand mr-4" href="{{ route('home') }}">{{ site_name() }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
            </ul>

            <!-- Right Side Of Navbar -->
            <div class="navbar-nav ml-auto">
                @foreach($navbar as $element)
                    @if(!$element->isDropdown())
                        <div class="nav-item">
                            <a class="nav-link" href="{{ $element->getLink() }}" @if($element->new_tab) target="_blank"
                               rel="noopener" @endif>{{ $element->name }}</a>
                        </div>
                    @else
                        <div class="nav-item dropdown">
                            <a id="navbarDropdown{{ $element->id }}" class="nav-link dropdown-toggle" href="#"
                               role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ $element->name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown{{ $element->id }}">
                                @foreach($element->elements as $childElement)
                                    <a class="dropdown-item" href="{{ $childElement->getLink() }}"
                                       @if($element->new_tab) target="_blank"
                                       rel="noopener noreferrer" @endif>{{ $childElement->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <!-- Notifications -->
            <div class="navbar-nav pl-4">
                @auth
                    @include('elements.notifications')
                @endauth
            </div>

            <!-- Authentication Links -->
            <div class="navbar-nav pl-1">
                @guest
                    <li class="nav-item dropdown nav-item-icon">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i></a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @if(Route::has('register'))
                                <a class="dropdown-item" href="{{ route('register') }}">{{ trans('auth.register') }}</a>
                            @endif
                            <a class="dropdown-item" href="{{ route('login') }}">{{ trans('auth.login') }}</a>
                        </div>
                    </li>
                @else
                    <li class="nav-item dropdown nav-item-icon">
                        <a id="userDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <img src="{{ auth()->user()->getAvatar() }}" alt="{{ auth()->user()->name }}" class="rounded-circle" height="30">
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('profile.index') }}">
                                {{ trans('messages.nav.profile') }}
                            </a>

                            @if(Auth::user()->hasAdminAccess())
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                    {{ trans('messages.nav.admin') }}
                                </a>
                            @endif

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ trans('auth.logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </div>
            @endguest
        </div>
    </div>
</nav>
