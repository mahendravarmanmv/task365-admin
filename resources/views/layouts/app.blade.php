<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
  <!-- Twitter meta-->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:site" content="@pratikborsadiya">
  <meta property="twitter:creator" content="@pratikborsadiya">
  <!-- Open Graph Meta-->
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="Vali Admin">
  <meta property="og:title" content="Vali - Free Bootstrap 4 admin theme">
  <meta property="og:url" content="http://pratikborsadiya.in/blog/vali-admin">
  <meta property="og:image" content="http://pratikborsadiya.in/blog/vali-admin/hero-social.png">
  <meta property="og:description" content="Vali is a responsive and free admin theme built with Bootstrap 4, SASS and PUG.js. It's fully customizable and modular.">
  <title>Admin Panel Task-365</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon/Task-365-Logo.png') }}" />
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/main.css') }}">
  <!-- Font-icon css-->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body class="app sidebar-mini">
  <!-- Navbar-->
  <header class="app-header"><a class="app-header__logo" href="{{ route('dashboard') }}">Task-365</a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">
      <li class="app-search">
        <input class="app-search__input" type="search" placeholder="Search">
        <button class="app-search__button"><i class="fa fa-search"></i></button>
      </li>
      <!--Notification Menu-->
      <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Show notifications"><i class="fa fa-bell-o fa-lg"></i></a>
        <ul class="app-notification dropdown-menu dropdown-menu-right">
          <li class="app-notification__title">You have 4 new notifications.</li>
          <div class="app-notification__content">
            <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                <div>
                  <p class="app-notification__message">Lisa sent you a mail</p>
                  <p class="app-notification__meta">2 min ago</p>
                </div>
              </a></li>
            <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-danger"></i><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span>
                <div>
                  <p class="app-notification__message">Mail server not working</p>
                  <p class="app-notification__meta">5 min ago</p>
                </div>
              </a></li>
            <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-success"></i><i class="fa fa-money fa-stack-1x fa-inverse"></i></span></span>
                <div>
                  <p class="app-notification__message">Transaction complete</p>
                  <p class="app-notification__meta">2 days ago</p>
                </div>
              </a></li>
            <div class="app-notification__content">
              <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-primary"></i><i class="fa fa-envelope fa-stack-1x fa-inverse"></i></span></span>
                  <div>
                    <p class="app-notification__message">Lisa sent you a mail</p>
                    <p class="app-notification__meta">2 min ago</p>
                  </div>
                </a></li>
              <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-danger"></i><i class="fa fa-hdd-o fa-stack-1x fa-inverse"></i></span></span>
                  <div>
                    <p class="app-notification__message">Mail server not working</p>
                    <p class="app-notification__meta">5 min ago</p>
                  </div>
                </a></li>
              <li><a class="app-notification__item" href="javascript:;"><span class="app-notification__icon"><span class="fa-stack fa-lg"><i class="fa fa-circle fa-stack-2x text-success"></i><i class="fa fa-money fa-stack-1x fa-inverse"></i></span></span>
                  <div>
                    <p class="app-notification__message">Transaction complete</p>
                    <p class="app-notification__meta">2 days ago</p>
                  </div>
                </a></li>
            </div>
          </div>
          <li class="app-notification__footer"><a href="#">See all notifications.</a></li>
        </ul>
      </li>
      <!-- User Menu-->
      <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
        <ul class="dropdown-menu settings-menu dropdown-menu-right">
          <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="fa fa-user fa-lg"></i> Profile</a></li>
          <li>
            <form action="{{ route('logout') }}" method="POST">
              @csrf
              <button type="submit" class="dropdown-item">
                <i class="fa fa-sign-out fa-lg"></i> Logout
              </button>
            </form>
          </li>
        </ul>
      </li>
    </ul>
  </header>
  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" style="height:45px;" src="{{ asset('assets/images/avatar.png') }}" alt="User Image">
      <div>
        <p class="app-sidebar__user-name">{{ Auth::user()->name }}</p>
        <p class="app-sidebar__user-designation">{{ Auth::user()->user_type }}</p>
      </div>
    </div>
    <?php
    $firstParam = request()->segment(1);
    ?>
    <ul class="app-menu">
  <li><a class="app-menu__item <?= ($firstParam == "dashboard") ? "active" : "" ?>" href="{{ route('dashboard') }}">
    <i class="app-menu__icon fa fa-dashboard"></i>
    <span class="app-menu__label">Dashboard</span></a></li>

  <li><a class="app-menu__item <?= ($firstParam == "categories") ? "active" : "" ?>" href="{{ route('categories.index') }}">
    <i class="app-menu__icon fa fa-folder-open"></i>
    <span class="app-menu__label">Categories</span></a></li>

  <li><a class="app-menu__item <?= ($firstParam == "website-types") ? "active" : "" ?>" href="{{ route('website-types.index') }}">
    <i class="app-menu__icon fa fa-sitemap"></i>
    <span class="app-menu__label">Website Types</span></a></li>

  <li><a class="app-menu__item <?= ($firstParam == "vendors") ? "active" : "" ?>" href="{{ route('vendors.index') }}">
    <i class="app-menu__icon fa fa-users"></i>
    <span class="app-menu__label">Vendors</span></a></li>

  <li><a class="app-menu__item <?= ($firstParam == "leads") ? "active" : "" ?>" href="{{ route('leads.index') }}">
    <i class="app-menu__icon fa fa-address-card"></i>
    <span class="app-menu__label">Leads</span></a></li>

  <li><a class="app-menu__item <?= ($firstParam == "banner") ? "active" : "" ?>" href="{{ route('banner.edit') }}">
    <i class="app-menu__icon fa fa-image"></i>
    <span class="app-menu__label">Banner</span></a></li>

  <li><a class="app-menu__item <?= ($firstParam == "payments") ? "active" : "" ?>" href="{{ route('payments.index') }}">
    <i class="app-menu__icon fa fa-credit-card"></i>
    <span class="app-menu__label">Payments</span></a></li>

  <li><a class="app-menu__item <?= ($firstParam == "contacts") ? "active" : "" ?>" href="{{ route('contacts.index') }}">
    <i class="app-menu__icon fa fa-envelope"></i>
    <span class="app-menu__label">Contact Us Submissions</span></a></li>
</ul>

  </aside>
  <main class="app-content">
    @yield('content')
  </main>
  <!-- Essential javascripts for application to work-->
  <script src="{{ asset('assets/js/jquery-3.3.1.min.js') }}"></script>
  <script src="{{ asset('assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/main.js') }}"></script>
  <!-- The javascript plugin to display page loading on top-->
  <script src="{{ asset('assets/js/plugins/pace.min.js') }}"></script>
  <!-- Page specific javascripts-->
  @yield('page-specific-javascripts')
  <!-- Google analytics script-->
  <script type="text/javascript">
    if (document.location.hostname == 'pratikborsadiya.in') {
      (function(i, s, o, g, r, a, m) {
        i['GoogleAnalyticsObject'] = r;
        i[r] = i[r] || function() {
          (i[r].q = i[r].q || []).push(arguments)
        }, i[r].l = 1 * new Date();
        a = s.createElement(o),
          m = s.getElementsByTagName(o)[0];
        a.async = 1;
        a.src = g;
        m.parentNode.insertBefore(a, m)
      })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
      ga('create', 'UA-72504830-1', 'auto');
      ga('send', 'pageview');
    }
  </script>
</body>

</html>