<style>
.nav-end .user-li a.user:hover{
  background: unset;
  border-color: unset;
  color: #65E4A3;
}

.user-li .dropdown-menu {
    padding:5px;
    min-width: max-content;
    width: max-content!important;
}
</style>


<div class='container-fluid p-0'>
<nav class="navbar navbar-expand-lg theme-bg pe-3 ps-3">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only"></span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('category') }}">Category</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Dropdown
          </a>
          <div class="dropdown-menu p-1" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>

      </ul>


      <form class="d-flex align-items-center d-none">
        <input class="form-control me-2 search" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>

   
  <div class="d-flex align-items-center badge-group">
    @guest

    @else
    <a href="{{ url('wishlist') }}">
      <i class="fa fa-heart">
        <p class='d-inline'>
          Wishist <span class="badge badge-light bg-danger wishlist-count">0</span>
        </p>
      </i>
    </a>

    <a href="{{ url('cart') }}">
      <i class="fa fa-bell">
        <p class='d-inline'>
          Notify <span class="badge badge-light bg-warning">0</span>
        </p>
      </i>
    </a>


    <a href="{{ url('cart') }}">
      <i class="fa fa-shopping-cart">
        <p class='d-inline'>
          Cart <span class="badge badge-light bg-info cart-count">0</span>
        </p>
      </i>
    </a>

    <a href="{{ url('my-orders') }}" class='me-3'>
      <i class="fa fa-shopping-bag">
        <p class='d-inline'>
          My Orders 
        </p>
      </i>
    </a>
   
    @endguest

      @if (Route::has('login'))
      <div class="d-flex nav-end">
          @auth
              {{-- <a href="{{ url('/home') }}" class="btn btn-primary ms-2">Home</a> --}}

              <ul class="navbar-nav ms-auto profile-ul">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif


                @else
                    <li class="nav-item dropdown user-li">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle user" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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


          @else
              <a href="{{ route('login') }}" class="btn btn-warning ms-2 me-2">Log in</a>

              @if (Route::has('register'))
                  <a href="{{ route('register') }}" class="btn btn-primary" >Register</a>
              @endif
          @endauth
      </div>
      @endif
    </div>



    </div>
</nav>
</div>






