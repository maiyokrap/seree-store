<nav id="sidebar" class="d-flex flex-column p-3">
  {{-- Header / Brand + Hamburger --}}
  <div class="brand d-flex align-items-center justify-content-between px-2 mb-2">
    <a href="{{ url('/store') }}" class="d-flex align-items-center text-success text-decoration-none">
      <span class="brand-text fw-bold fs-5">SereeStore</span>
    </a>
    <button id="btnSidebarMini" class="btn btn-outline-success btn-sm">
      <i class="fa-solid fa-bars"></i>
    </button>
  </div>
  <hr class="my-2">

  <ul class="nav flex-column mb-auto">
    <li>
      <a href=""
         class="nav-link bg-white shadow-sm">
        <i class="fa-solid fa-house"></i>
        <span class="label">Dashboard</span>
      </a>
    </li>
    <li>
      <a href=""
         class="nav-link">
        <i class="fa-solid fa-box"></i>
        <span class="label">Products</span>
      </a>
    </li>
    <li>
      <a href=""
         class="nav-link">
        <i class="fa-solid fa-user-group"></i>
        <span class="label">Customers</span>
      </a>
    </li>
    <li>
      <a href=""
         class="nav-link">
        <i class="fa-solid fa-receipt"></i>
        <span class="label">Orders</span>
      </a>
    </li>
    <li>
      <a href=""
         class="nav-link">
        <i class="fa-solid fa-chart-line"></i>
        <span class="label">Reports</span>
      </a>
    </li>
  </ul>

  <hr class="mt-auto">
</nav>
