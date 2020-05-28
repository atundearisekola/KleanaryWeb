    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">Start Cleanary</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav text-uppercase ml-auto">
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#services">Aims</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#portfolio">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#about">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#team">Team</a>
            </li>
            <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="#contact">Contact</a>
            </li>
            
               @if (Route::has('login'))
                
                    @auth
                       <li class="nav-item">
              <a class="nav-link" href="{{ url('/home') }}"><b>Dashboard</b></a>
              </li>
                    @else
                       <li class="nav-item">
              <a class="nav-link"href="{{ route('login') }}">Login</a>
              </li>
                       <li class="nav-item">
              <a class="nav-link" href="{{ route('register') }}">Register</a>
              </li>
                    @endauth
                
            @endif
            </li>
          </ul>
        </div>
      </div>
    </nav>
