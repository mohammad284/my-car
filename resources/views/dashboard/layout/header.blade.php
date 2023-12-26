<?php
  $lang = Session('locale');
  if ($lang != "en") {
      $lang = "ar";
  }
?>
<nav class="navbar">
  <a href="#" class="sidebar-toggler">
    <i data-feather="menu"></i>
  </a>
  <div class="navbar-content">
    <form class="search-form">
      <div class="input-group">
        <div class="input-group-text">
          <i data-feather="search"></i>
        </div>
        <input type="text" class="form-control" id="navbarForm" placeholder="Search here...">
      </div>
    </form>
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         @if($lang == 'en')
        <i class="flag-icon flag-icon-us" title="us"></i> <span class="ms-1 me-1 d-none d-md-inline-block">English</span>
        @else
          <i class="flag-icon flag-icon-om mt-1" title="om"></i> <span class="ms-1 me-1 d-none d-md-inline-block">عربي</span>
        @endif
        </a>
        @if ($lang == 'en')
        <div class="dropdown-menu"  @if($lang == 'en') style="left: -110px;"@endif aria-labelledby="languageDropdown">
          <a href="/change-language/ar" class="dropdown-item py-2"><i class="flag-icon flag-icon-om" title="ad" id="om"></i> <span class="ms-1"> Arabic </span></a>
          <a href="/change-language/en" class="dropdown-item py-2"><i class="flag-icon flag-icon-us" title="us" id="us"></i> <span class="ms-1"> English </span></a>
        </div>
        @else
        <div class="dropdown-menu"  @if($lang == 'en') style="left: -110px;"@endif aria-labelledby="languageDropdown">
          <a href="/change-language/ar" class="dropdown-item py-2"><i class="flag-icon flag-icon-om" title="ad" id="om"></i> <span class="ms-1"> عربي </span></a>
          <a href="/change-language/en" class="dropdown-item py-2"><i class="flag-icon flag-icon-us" title="us" id="us"></i> <span class="ms-1"> إنكليزي </span></a>
        </div>
        @endif
      </li>


      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i data-feather="bell"></i>
          @if($status_notification == 0)
          <div class="indicator">
            <div class="circle"></div>
          </div>
          @endif
        </a>
        <div class="dropdown-menu p-0" aria-labelledby="notificationDropdown">

          <div class="p-1">
            @foreach($notifications as $notification)
              <a href="javascript:;" class="dropdown-item d-flex align-items-center py-2">
                <div class="wd-30 ht-30 d-flex align-items-center justify-content-center bg-primary rounded-circle me-3">
                <i class="mdi mdi-bell-ring-outline"></i>
                </div>
                <div class="flex-grow-1 me-2">
                  <p>{{$notification->notification}}</p>
                  <p class="tx-12 text-muted">{{$notification->created_at->diffForHumans()}}</p>
                </div>	
              </a>
            @endforeach
          </div>
          <div class="px-3 py-2 d-flex align-items-center justify-content-center border-top">
            <a href="/admin/notifications">View all</a>
          </div>
        </div>
      </li>

    </ul>
  </div>
</nav>