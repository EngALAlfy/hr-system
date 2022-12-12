<div class="logo">
    <a href="#">
        <img width="55" src="{{ asset('assets/common/img/human-resources.png') }}" alt="{{ env('APP_NAME') }}" />
    </a>
</div>
<div class="menu-sidebar2__content js-scrollbar1">
    <div class="account2">
        <div class="image img-cir img-120">
            <img src="{{ asset('storage/photos/users')."/" . Auth::user()->photo }}"
                onerror="this.src='{{ asset('assets/common/img/user.png') }}'" alt="{{ Auth::user()->name }}" />
        </div>
        <h4 class="name">{{ Auth::user()->name }}</h4>
        <p>{{ Auth::user()->job_title }}</p>
        <a href="{{ route('logout') }}">@lang('buttons.sign_out')</a>
    </div>
    <nav class="navbar-sidebar2">
        <ul class="list-unstyled navbar__list">

            <li @class(['active' => 'home' == Route::currentRouteName()])>
                <a href="{{route('home')}}">
                    <i class="fa fa-home"></i>@lang('routes.home')</a>
                {{-- <span class="inbox-num">3</span> --}}
            </li>

            {{-- resources routes --}}
            @foreach (Route::getRoutes() as $route)
                @if (strpos($route->getName(), '.index'))
                    @php
                        $view_role = 'view_' . explode('.', $route->getName())[count(explode('.', $route->getName())) - 2];
                        $create_role = 'create_' . explode('.', $route->getName())[count(explode('.', $route->getName())) - 2];
                    @endphp
                    @if (Auth()->user()->checkRole($view_role))
                        <li class="{{ $route->getName() == Route::currentRouteName() ? 'active' : '' }} has-sub">
                            <a class="js-arrow {{ $route->getName() == Route::currentRouteName() ? 'open' : '' }}"
                                href="#">
                                <i class="fa fa-square"></i>@lang('routes.' . $route->getName())
                                <span class="arrow {{ $route->getName() == Route::currentRouteName() ? 'up' : '' }}">
                                    <i class="fa fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list "
                                style="display: {{ $route->getName() == Route::currentRouteName() || str_replace('index', 'create', $route->getName()) == Route::currentRouteName() || ('users.projects' == Route::currentRouteName() || 'users.ratings-monthly' == Route::currentRouteName() || 'users.attendance' == Route::currentRouteName()) && $route->getName() == "users.index"  ? 'block' : 'none' }}">
                                <li
                                    class=" p-l-20 {{ $route->getName() == Route::currentRouteName() ? 'active' : '' }}">
                                    <a href="{{ route($route->getName()) }}">
                                        <i class="fa fa-circle"></i>@lang('routes.' . $route->getName())</a>
                                </li>

                                @if (Auth()->user()->checkRole($create_role))
                                    @if (Route::has(str_replace('index', 'create', $route->getName())))
                                        <li
                                            class="p-l-20 {{ str_replace('index', 'create', $route->getName()) == Route::currentRouteName() ? 'active' : '' }}">
                                            <a href="{{ route(str_replace('index', 'create', $route->getName())) }}">
                                                <i class="fa fa-plus"></i>@lang('routes.' . str_replace('index', 'create', $route->getName()))</a>
                                        </li>
                                    @endif
                                @endif

                                {{-- add users routes --}}
                                @if ($route->getName() == 'users.index')
                                    @if (Auth()->user()->checkRole("view_ratings"))
                                        <li
                                            class="p-l-20 {{ 'users.ratings-monthly' == Route::currentRouteName() ? 'active' : '' }}">
                                            <a href="{{ route('users.ratings-monthly') }}">
                                                <i class="fa fa-star"></i>@lang('routes.users.ratings-monthly')</a>
                                        </li>
                                    @endif

                                    @if (Auth()->user()->checkRole("view_attendance"))
                                        <li
                                            class="p-l-20 {{ 'users.attendance' == Route::currentRouteName() ? 'active' : '' }}">
                                            <a href="{{ route('users.attendance') }}">
                                                <i class="fa fa-circle"></i>@lang('routes.users.attendance')</a>
                                        </li>
                                    @endif

                                    @if (Auth()->user()->checkRole("view_users_projects"))
                                        <li
                                            class="p-l-20 {{ 'users.projects' == Route::currentRouteName() ? 'active' : '' }}">
                                            <a href="{{ route('users.projects') }}">
                                                <i class="fa fa-rocket"></i>@lang('routes.users.projects')</a>
                                        </li>
                                    @endif

                                @endif

                            </ul>
                        </li>
                    @endif
                    {{-- @else

                <li>
                    <a href="inbox.html">
                        <i class="fa fa-chart-bar"></i>{{$route->getName()}}</a>
                    <span class="inbox-num">3</span>
                </li> --}}
                @endif
            @endforeach
        </ul>
    </nav>
</div>
