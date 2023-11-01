<header id="header" class="header-narrow header-transparent header-semi-transparent header-semi-transparent-light header-bottom-slider" data-plugin-options="{'stickyEnabled': true, 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': false, 'stickyStartAtElement': '#header', 'stickySetTop': '0', 'stickyChangeLogo': false}">
    <div class="header-body header-body-bottom-border">
        <div class="header-container header-container-height-sm container">
            <div class="header-row">
                <div class="header-column">
                    <div class="header-row">
                        <div class="header-logo">
                            <a class="text-decoration-none" href="{{url('/')}}">
                                <img alt="mmbd" width="80" height="80" data-sticky-width="82" data-sticky-height="40" src="{{ route('imagecache', ['template' => 'original', 'filename' => $ws->logo()]) }}">
                                <span class="text-7" style="font-family: lobster;color: #b48c4f;"  class="">Marriage Match BD</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="header-column justify-content-end">
                    <div class="header-row">
                        <div class="header-nav header-nav-links order-2 order-lg-1">
                            <div class="header-nav-main header-nav-main-square header-nav-main-effect-2 header-nav-main-sub-effect-1">
                                    <nav class="collapse">
                                        <ul class="nav nav-pills" id="mainNav">
                                            <li class="dropdown">
                                                <a class="dropdown-item" href="{{ url('/') }}">
                                                    {{__('Home')}}
                                                </a>
                                            </li>

                                            @foreach ($headerMenus as $menu)
                                            @if($menu->link)      
                                            <li class="dropdown">
                                                <a class="dropdown-item" 
                                                href="{{ $menu->link }}">
                                                    {{ $menu->name}}
                                                </a>
                                            </li>
                                            @else
                                                <li class="dropdown">
                                                <a class="dropdown-item dropdown-toggle">
                                                    {{ $menu->name }}
                                                </a>

                                                <ul class="dropdown-menu">
                                                    @if($menu->pages)
                                                    @foreach ($menu->latestPages() as $page)
                                                    @if($page->link)
                                                    <li>
                                                        <a class="dropdown-item" href="{{ $page->link }}">{{ $page->name }}</a>
                                                    </li>

                                                    @else
                                                    <li>
                                                        <a class="dropdown-item" href="{{ route('page', ['id' => $page->id, 'slug' => page_slug($page->name)])}}">{{ $page->name }}</a>
                                                    </li>
                                                    @endif

                                                    @endforeach
                                                    @endif
                                                </ul>

                                            </li>
                                            @endif
                                            @endforeach


                                            @if(Auth::check())
                                            <li class="dropdown">
                                                <a class="dropdown-item dropdown-toggle" href="#">
                                                    {{ auth()->user()->name }}
                                                </a>
                                                

                                                <ul class="dropdown-menu">
                                                     <li><a class="dropdown-item" href="{{ route('userrole.dashboard')}}">My Dashboard</a></li>
                                                     
                                                    @if(Auth::user()->hasRole('admin') or Auth::user()->hasRole('user_manage')or Auth::user()->hasRole('story_&_blog_manage') or Auth::user()->hasRole('menu_&_page_manage'))
                                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard')}}">Admin Dashboard</a></li>
                                                    @endif
                                                    <li>
                                                        <a href="javascript:void" class="dropdown-item" onclick="$('#logout-form').submit();">
                                                            Logout
                                                        </a>
                                                    </li>

                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                </ul>
                                            </li>
                                            @else
                                            <li class="dropdown">
                                                <a class="dropdown-item" href="{{ route('login') }}">
                                                    Login
                                                </a>
                                            </li>
                                            <li class="dropdown">
                                                <a class="dropdown-item" href="{{ route('register') }}">
                                                    Register
                                                </a>
                                            </li>
                                            @endif


                                                {{-- language --}}
                                                @php
                                                    if(Session::has('locale')){
                                                        $locale = Session::get('locale', Config::get('app.locale'));
                                                    }
                                                    else{
                                                        $locale = env('DEFAULT_LANGUAGE');
                                                    }
                                                @endphp

                                            <li class="dropdown">
                                                <a class="dropdown-item dropdown-toggle" href="javascript:void(0)">
                                                    <i class="fa fa-language me-2 text-md" style="color: #b48c4f"></i>
                                                  {{Cp\Admin\Models\Language::where('language_code', $locale)->where('active', 1)->value('title')}}
                                                </a>
                                                

                                                <ul class="dropdown-menu">
                                                    @foreach (Cp\Admin\Models\Language::where('active', 1)->get() as $key => $language)
                                                        <li>
                                                            <form action="{{ route('languageUpdateStatus',$language)}}" method="post">
                                                                @csrf
                                                                <button type="submit" class="dropdown-item @if($locale == $language->language_code) active @endif">
                                                                    <span class="language">{{ $language->title }}</span>
                                                                </button>
                                                            </form>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>

                                        </ul>
                                    </nav>
                                </div>
                                <button class="btn header-btn-collapse-nav" data-bs-toggle="collapse" data-bs-target=".header-nav-main nav">
                                    <i class="fas fa-bars"></i>
                                </button>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>							
    </div>
</header>