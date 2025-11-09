<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title', 'My Store')</title>
  <meta name="keywords" content="">
  <meta name="description" content="@yield('meta_desc','')">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicons -->
  <link href="assets/img/seree_store.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  
  <!-- dataTables -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">


  <!-- =======================================================
  * Template Name: CoreBiz
  * Template URL: https://bootstrapmade.com/corebiz-bootstrap-business-template/
  * Updated: Aug 30 2025 with Bootstrap v5.3.8
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    /* ====== Sidebar base ====== */
    #sidebar {
      position: fixed; inset: 0 auto 0 0;
      width: 250px; height: 100vh;
      background: #F0FFF0; color:#14532d;
      overflow-y:auto; transition: width .25s ease, margin-left .25s ease;
      z-index: 1050;
      box-shadow: 0 0 0 1px rgba(0,0,0,.04) inset;
    }
    /* mini mode (desktop) */
    #sidebar.mini { width: 72px; }
    #sidebar .brand { height:56px }
    #sidebar .brand .brand-text { transition: opacity .2s ease }
    #sidebar.mini .brand .brand-text { opacity:0; pointer-events:none; width:0 }
    #sidebar .nav-link { display:flex; align-items:center; gap:.75rem; padding:.6rem .9rem; border-radius:.5rem; }
    #sidebar.mini .nav-link { justify-content:center; gap:0; }
    #sidebar .nav-link .label { transition:opacity .2s ease, width .2s }
    #sidebar.mini .nav-link .label { opacity:0; width:0; overflow:hidden }

    /* content margin depends on sidebar width */
    #content { margin-left:250px; transition: margin-left .25s ease; }
    #content.mini { margin-left:72px; }

    /* ====== Overlay (mobile) ====== */
    #sidebarOverlay {
      position: fixed; inset:0;
      background: rgba(0,0,0,.45);
      z-index:1049; display:none;
    }
    #sidebarOverlay.show { display:block; }

    /* mobile: sidebar ซ่อนเป็น off-canvas */
    @media (max-width: 768px) {
      #sidebar { margin-left:-250px; }
      #sidebar.show { margin-left:0; }
      #content, #content.mini { margin-left:0; }
    }
  </style>
   @stack('styles')
</head>

<body class="index-page">
  
  {{-- Overlay --}}
  <div id="sidebarOverlay"></div>

  {{-- Sidebar --}}
  @include('partials.admin_sidebar')


  {{-- Content --}}
  <div id="content">
    
    @include('partials.admin_topbar')
    <main class="p-4">
      @yield('content')
    </main>
  </div>
 {{-- Login Modal --}}
  @guest
  <div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0 shadow">
        <div class="modal-header">
          <h5 class="modal-title">Sign in</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form id="loginForm">
          <div class="modal-body">
            <div class="mb-3">
              <label for="login_user_name" class="form-label">Username</label>
              <input type="text" class="form-control" id="login_user_name" name="user_name" required autofocus>
              <div class="invalid-feedback" id="err_user_name"></div>
            </div>

            <div class="mb-2">
              <label for="login_password" class="form-label">Password</label>
              <input type="password" class="form-control" id="login_password" name="password" required>
              <div class="invalid-feedback" id="err_password"></div>
            </div>

            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="remember" name="remember">
              <label class="form-check-label" for="remember">Remember me</label>
            </div>

            <div class="text-danger small mt-2" id="login_general_error" style="display:none;"></div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" id="loginSubmitBtn">
              <span class="spinner-border spinner-border-sm me-2 d-none" id="loginSpinner"></span>
              Login
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  @endguest
  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- dataTables -->
    <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script>
    // --- helper: CSRF token ---
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // --- modal login submit ---
    const form = document.getElementById('loginForm');
    if (form) {
      form.addEventListener('submit', async (e) => {
        e.preventDefault();
        // reset errors
        ['login_user_name','login_password'].forEach(id => {
          document.getElementById(id).classList.remove('is-invalid');
        });
        document.getElementById('login_general_error').style.display = 'none';
        document.getElementById('login_general_error').textContent = '';

        // UI lock
        const btn = document.getElementById('loginSubmitBtn');
        const spn = document.getElementById('loginSpinner');
        btn.disabled = true; spn.classList.remove('d-none');

        try {
          const res = await fetch(@json(route('login')), {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': csrfToken,
              'X-Requested-With': 'XMLHttpRequest',   // บอก Laravel ว่านี่คือ AJAX
              'Accept': 'application/json'            // ให้ตอบเป็น JSON เวลา validation fail
            },
            body: JSON.stringify({
              user_name: document.getElementById('login_user_name').value,
              password: document.getElementById('login_password').value,
              remember: document.getElementById('remember').checked ? 'on' : ''
            })
          });

          if (res.ok) {
            // login สำเร็จ: Laravel จะตอบ 204/redirect—บน AJAX เราให้รีเฟรชหน้า
            window.location.reload();
            return;
          }

          // error (422 validation หรือ 401/419)
          const data = await res.json().catch(() => ({}));

          if (res.status === 422 && data.errors) {
            if (data.errors.user_name) {
              document.getElementById('login_user_name').classList.add('is-invalid');
              document.getElementById('err_user_name').textContent = data.errors.user_name[0];
            }
            if (data.errors.password) {
              document.getElementById('login_password').classList.add('is-invalid');
              document.getElementById('err_password').textContent = data.errors.password[0];
            }
          } else {
            // กรณี credential ผิด จะได้ข้อความ generic
            const msg = data.message || 'Invalid credentials.';
            const gen = document.getElementById('login_general_error');
            gen.textContent = msg;
            gen.style.display = 'block';
          }

        } catch (err) {
          const gen = document.getElementById('login_general_error');
          gen.textContent = 'Network error, please try again.';
          gen.style.display = 'block';
        } finally {
          btn.disabled = false; spn.classList.add('d-none');
        }
      });
    }
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const sidebar   = document.getElementById('sidebar');
      const overlay   = document.getElementById('sidebarOverlay');
      const content   = document.getElementById('content');
      const btnInside = document.getElementById('btnSidebarMini'); // ปุ่มใน sidebar

      function isMobile(){ return window.innerWidth <= 768; }

      // ปุ่มแฮมเบอร์เกอร์ "ภายใน sidebar"
      btnInside.addEventListener('click', () => {
        if (isMobile()) {            // mobile => ใช้ overlay / slide
          sidebar.classList.toggle('show');
          overlay.classList.toggle('show');
        } else {                     // desktop => ย่อเหลือไอคอน
          sidebar.classList.toggle('mini');
          content.classList.toggle('mini');
        }
      });

      // คลิ๊ก overlay เพื่อปิด (mobile)
      overlay.addEventListener('click', () => {
        sidebar.classList.remove('show');
        overlay.classList.remove('show');
      });

      // ถ้าจอหด/ขยาย: เคลียร์ state ให้เหมาะ
      window.addEventListener('resize', () => {
        if (!isMobile()) {
          overlay.classList.remove('show');
          sidebar.classList.remove('show');
        }
      });
    });
  </script>
  @stack('scripts')

</body>

</html>