@push('styles')
<style>
  .dropdown-menu .dropdown-item {
    border-radius: .5rem;
    padding: .5rem .75rem;
  }

  .dropdown-menu .dropdown-item:hover {
    background: rgba(0, 0, 0, .04);
  }

  .dropdown-menu .dropdown-item.text-danger:hover {
    background: rgba(220, 53, 69, .08);
  }
</style>
@endpush

<header id="header" class="header sticky-top">
  <div class="topbar d-flex align-items-center dark-background">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <img src="assets/img/seree_store.png" alt="Logo" style="height:80px; width:auto;" class="mt-2">
      <div class="social-links d-none d-md-flex align-items-center">
        <nav class="navbar navbar-expand-md">
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
              <!-- Authentication Links -->
              @guest
                <li class="nav-item">
                  <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
                </li>
                @if (Route::has('register'))
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                  </li>
                @endif
              @else
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                    href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="fw-semibold">{{ Auth::user()->name }}</span>
                    <span class="rounded-circle bg-primary text-white d-inline-flex justify-content-center align-items-center"
                      style="width:28px;height:28px;font-size:.85rem;">
                       <i class="fa-solid fa-cart-shopping"></i> 
                    </span>
                  </a>

                  <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 py-2" aria-labelledby="userMenu">
                    {{-- โปรไฟล์ / ตั้งค่า (ถ้ามี) --}}
                    {{-- 
                      <li>
                        <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('profile.show') }}">
                           <i class="bi bi-person"></i><span>Profile</span>
                        </a>
                      </li>
                      <li>
                        <hr class="dropdown-divider">
                      </li> 
                      --}}
                    <li>
                      <a class="dropdown-item d-flex align-items-center gap-2 text-danger"
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i><span>Logout</span>
                      </a>
                    </li>
                  </ul>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                </li>
                @if (Auth::user()->user_type == 'saler')
                  <li class="nav-item d-flex align-items-center">
                    <a class="nav-link" href="{{ route('admin_store') }}">Goto Store</a>
                  </li>
                @endif
            @endguest
                
            </ul>
          </div>
        </nav>
      </div>
    </div>
  </div><!-- End Top Bar -->

  <div class="branding d-flex align-items-cente m-0 p-0 bg-light">
    <div class="container position-relative d-flex justify-content-end align-items-center ">
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">Shirt</a></li>
          <li><a href="#services">Pants</a></li>
          <li><a href="#portfolio">Bag</a></li>
          <li><a href="#team">Hat</a></li>
          <li class="dropdown"><a href="#"><span>Accessories</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Dropdown 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                <ul>
                  <li><a href="#">Deep Dropdown 1</a></li>
                  <li><a href="#">Deep Dropdown 2</a></li>
                  <li><a href="#">Deep Dropdown 3</a></li>
                  <li><a href="#">Deep Dropdown 4</a></li>
                  <li><a href="#">Deep Dropdown 5</a></li>
                </ul>
              </li>
              <li><a href="#">Dropdown 2</a></li>
              <li><a href="#">Dropdown 3</a></li>
              <li><a href="#">Dropdown 4</a></li>
            </ul>
          </li>
          <li>
            <form action="" method="GET" class="position-relative" style="min-width:260px;">
              <i class="fa-solid fa-magnifying-glass position-absolute" 
                 style="left:12px; top:50%; transform:translateY(-50%); opacity:.6;"></i>
              <input type="text" name="q" class="form-control ps-5" placeholder="Search products…" aria-label="Search">
            </form>
          </li>
          <li>
            <a href="#Facebook">
              <i class="fa-brands fa-facebook"></i>
              &nbsp;Facebook
            </a>
          </li>
          <li>
            <a href="#instagram">
              <i class="fa-brands fa-instagram"></i>
              &nbsp;instagram
            </a>
          </li>
          <li>
            <a href="#Tiktok">
              <i class="fa-brands fa-tiktok"></i>
              &nbsp;Tiktok
            </a>
          </li>
          
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>

  </div>
</header>