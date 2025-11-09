<nav class="navbar navbar-light border-bottom shadow-sm px-3" style="background-color: #F0FFF0;">
  <span id="desciption_page" class="fw-bold text-success"></span>
  <div class="dropdown">
    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle"
       data-bs-toggle="dropdown" aria-expanded="false">
      <img src="https://github.com/mdo.png" width="28" height="28" class="rounded-circle me-2" alt="">
      <strong class="label">{{ Auth::user()->user_name ?? 'Admin' }}</strong>
      &nbsp;
      <i class="fa-solid fa-bell"></i>
    </a>
    <ul class="dropdown-menu shadow">
      <li><a class="dropdown-item" href="#">Profile</a></li>
      <li><a class="dropdown-item" href="#">Settings</a></li>
      <li><hr class="dropdown-divider"></li>
      <li>
        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          Sign out
        </a>
      </li>
    </ul>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
  </div>
</nav>
