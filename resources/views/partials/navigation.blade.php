<nav role="navigation">

    <div class="logo">
        <a href="{{ url('/') }}">
            <img src="{{ asset('/svg/home.svg.png') }}" alt="Home" width="43">    
        </a>
    </div>

    <div class="nav-profile">
        <!-- Authentication Links -->
        @guest
            
            <button class="btn btn-blue">
                <a href="{{ route('login') }}">{{ __('Login') }}</a>
            </button>
            
       
            <button class="btn btn-blue">
                <a href="{{ route('register') }}">{{ __('Register') }}</a>
            </button>
           
         
        @else

            <div class="profile-name">
                <a href="{{ route('profile.info', Auth::user()->username) }}">
                    {{ Auth::user()->name }}
                </a>
            </div>
            

            <div class="profile-image">
                <img width="26" src="{{ asset('/images/uploads/profile') . '/' . Auth::user()->image }}" alt="">
            </div>
            
            <span class="menu-arrow">
                <img width="12" src="{{ asset('/svg/arrow.svg') }}" alt="arrow">
            </span>

            <ul class="dropdown">
        
                <li><a href="{{ route('profile.info', Auth::user()->username) }}">Your profile</a></li>
                <li><a href="{{ route('password.request') }}">{{ __('Change password') }}</a></li>
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>
                </li>

            </ul>

        @endguest

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

    </div>
     
</nav>

