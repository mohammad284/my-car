<?php
  $lang = Session('locale');
  if ($lang != "en") {
      $lang = "ar";
  }
?>
@push('plugin-styles')
  <link href="{{ asset('assets/plugins/@mdi/css/materialdesignicons.min.css') }}" rel="stylesheet" />
@endpush
<nav class="sidebar">
  <div class="sidebar-header">
    <a href="#" class="sidebar-brand">
    <span>C</span>ar<span>C</span>ome
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  @if(Auth::guard('admin')->check())
  @if (Auth::guard('admin')->user()->type == 'admin')
  <div class="sidebar-body">
    <ul class="nav">
    <li class="nav-item nav-category">Main</li>
    <li class="nav-item">
        <a href="{{ url('/admin') }}" class="nav-link">
        <i  data-feather="box"></i>
          <span class="link-title">{{__('الرئيسية')}}</span>
        </a>
      </li>
      <li class="nav-item nav-category">{{__('الإعلانات')}}</li>
      <li class="nav-item" >
        <a class="nav-link" data-bs-toggle="collapse" href="#email" role="button" aria-expanded="" aria-controls="email">
        <i class="mdi mdi-radio"></i>
          <span class="link-title">{{__('الإعلانات')}}</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse " id="email">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="/admin/allAdvirtising" class="nav-link {{ (request()->is('admin/allAdvirtising')) ? 'active' : '' }}"> {{__('جميع الاعلانات')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/addAdvirtising" class="nav-link {{ (request()->is('admin/addAdvirtising')) ? 'active' : '' }}">{{__('إضافة إعلان')}}</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">{{__('السيارات')}}</li>
      <li class="nav-item ">
        <a class="nav-link" data-bs-toggle="collapse" href="#car" role="button" aria-expanded="" aria-controls="email">
        <i class="mdi mdi-car"></i>
          <span class="link-title">{{__('السيارات')}}</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse " id="car">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="/admin/allCarsType" class="nav-link {{ (request()->is('admin/allCarsType')) ? 'active' : '' }}"> {{__('تصنيفات السيارات')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/addCarType" class="nav-link {{ (request()->is('admin/addCarType')) ? 'active' : '' }}">{{__('إضافة تصنيف جديد')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/carmodel" class="nav-link {{ (request()->is('admin/carmodel')) ? 'active' : '' }}">{{__('جميع الماركات')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/addNewCar" class="nav-link {{ (request()->is('admin/addNewCar')) ? 'active' : '' }}">{{__('إضافة سيارة جديدة')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/allCars" class="nav-link {{ (request()->is('admin/allCars')) ? 'active' : '' }}">{{__('جميع السيارات')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/colors" class="nav-link {{ (request()->is('admin/colors')) ? 'active' : '' }}"> {{__('الألوان')}}</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">{{__('العملاء')}}</li>
      <li class="nav-item ">
        <a class="nav-link" data-bs-toggle="collapse" href="#users" role="button" aria-expanded="" aria-controls="email">
        <i class="mdi mdi-account"></i>
          <span class="link-title">{{__('العملاء')}}</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse " id="users">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="/admin/allUser" class="nav-link {{ (request()->is('admin/allUser')) ? 'active' : '' }}">  {{__('كل العملاء')}}</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">{{__('تسجيل الشركات')}}</li>
      <li class="nav-item ">
        <a class="nav-link" data-bs-toggle="collapse" href="#provider" role="button" aria-expanded="" aria-controls="email">
        <i class="mdi mdi-account-star"></i>
          <span class="link-title">{{__('تسجيل الشركات')}}</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse " id="provider">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="/admin/allprovider" class="nav-link {{ (request()->is('admin/allprovider')) ? 'active' : '' }}"> {{__('تسجيل الشركات')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/requestProvider" class="nav-link {{ (request()->is('admin/requestProvider')) ? 'active' : '' }}"> {{__('طلبات انضمام الشركات')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/blockedAccount" class="nav-link {{ (request()->is('admin/blockedAccount')) ? 'active' : '' }}"> {{__('قائمة الحظر')}}</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">{{__('المراجعات')}}</li>
      <li class="nav-item ">
        <a href="/admin/reviews" class="nav-link">
        <i class="mdi mdi-thumbs-up-down"></i> 
          <span class="link-title">{{__('المراجعات')}}</span>
        </a>
      </li>
      <li class="nav-item nav-category">{{__('الاحصائيات والتقارير')}}</li>
      <li class="nav-item ">
        <a class="nav-link" data-bs-toggle="collapse" href="#financialReports" role="button" aria-expanded="" aria-controls="email">
        <i class="mdi mdi-chart-line"></i>
          <span class="link-title">{{__('الاحصائيات والتقارير')}}</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse " id="financialReports">
          <ul class="nav sub-menu">
          <li class="nav-item">
              <a href="/admin/providerPercentage" class="nav-link {{ (request()->is('admin/providerPercentage')) ? 'active' : '' }}"> {{__('الأرباح من مزودي الخدمة')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/autoReports" class="nav-link {{ (request()->is('admin/autoReports')) ? 'active' : '' }}"> {{__('تقارير السيارات')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/financialReports" class="nav-link {{ (request()->is('admin/financialReports')) ? 'active' : '' }}"> {{__('تقارير مالية')}}</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item nav-category">{{__('الاشعارات')}}</li>
      <li class="nav-item ">
        <a class="nav-link" data-bs-toggle="collapse" href="#notification" role="button" aria-expanded="" aria-controls="email">
        <i class="mdi mdi-bell-ring-outline"></i>
          <span class="link-title">{{__('الاشعارات')}}</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse " id="notification">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="/admin/notifications" class="nav-link {{ (request()->is('admin/notifications')) ? 'active' : '' }}"> {{__('الاشعارات')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/sendNotifications" class="nav-link {{ (request()->is('admin/sendNotifications')) ? 'active' : '' }}"> {{__('إرسال اشعار')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/appNotification" class="nav-link {{ (request()->is('admin/appNotification')) ? 'active' : '' }}"> {{__('إشعارات التطبيق')}}</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">{{__('إدارة المواقع')}}</li>
      <li class="nav-item ">
        <a class="nav-link" data-bs-toggle="collapse" href="#location" role="button" aria-expanded="" aria-controls="email">
        <i class="mdi mdi-bell-ring-outline"></i>
          <span class="link-title">{{__('المواقع')}}</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse " id="location">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="/admin/countries" class="nav-link {{ (request()->is('admin/countries')) ? 'active' : '' }}"> {{__('الدول')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/cities" class="nav-link {{ (request()->is('admin/cities')) ? 'active' : '' }}"> {{__('المناطق')}}</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">{{__('الحجوزات')}}</li>
      <li class="nav-item ">
        <a href="/admin/providerBooking" class="nav-link">
        <i class="mdi mdi-calendar-clock"></i>
          <span class="link-title">{{__('الحجوزات')}}</span>
        </a>
      </li>
      <li class="nav-item nav-category">{{__('الاعدادات')}}</li>
      <li class="nav-item ">
        <a class="nav-link" data-bs-toggle="collapse" href="#sitting" role="button" aria-expanded="" aria-controls="email">
        <i data-feather="settings"></i>
          <span class="link-title">{{__('الاعدادات العامة')}}</span>
         
        </a>
        <div class="collapse " id="sitting">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="/admin/aboutUs" class="nav-link {{ (request()->is('admin/aboutUs')) ? 'active' : '' }}"> {{__('من نحن')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/percentage" class="nav-link {{ (request()->is('admin/percentage')) ? 'active' : '' }}"> {{__('نسبة الربح')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/privacy" class="nav-link {{ (request()->is('admin/privacy')) ? 'active' : '' }}"> {{__('سياسة الخصوصية')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/Terms" class="nav-link {{ (request()->is('admin/Terms')) ? 'active' : '' }}"> {{__('الشروط والاحكام')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/socialMedia" class="nav-link {{ (request()->is('admin/socialMedia')) ? 'active' : '' }}">{{__('مواقع التواصل الاجتماعي')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/contactInformation" class="nav-link {{ (request()->is('admin/contactInformation')) ? 'active' : '' }}">{{__('بيانات التواصل')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/contactMessage" class="nav-link {{ (request()->is('admin/contactMessage')) ? 'active' : '' }}">{{__('رسائل اتصل بنا')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/welcomeEmails" class="nav-link {{ (request()->is('admin/welcomeEmails')) ? 'active' : '' }}">{{__('الإيميلات الترحيبية')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/myAdmins" class="nav-link {{ (request()->is('admin/myAdmins')) ? 'active' : '' }}">{{__('قائمة المدراء')}}</a>
            </li>
          </ul>
        </div>
      </li>
      </li>

      <li class="nav-item nav-category">{{__('تسجيل خروج')}}</li>
      <li class="nav-item ">
      <a class="nav-link" href="{{ route('admin.logout') }}"
        onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
        <i class="fas fa-power-off"></i>
        <span class="link">
          {{__('تسجيل خروج')}}
        </span>
      </a>
      <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
      </li>
    </ul>
  </div>
</nav>

  @else
  <div class="sidebar-body">
    <ul class="nav">
    <li class="nav-item nav-category">Main</li>
    <li class="nav-item">
        <a href="{{ url('/admin') }}" class="nav-link">
        <i  data-feather="box"></i>
          <span class="link-title">{{__('الرئيسية')}}</span>
        </a>
      </li>
      <li class="nav-item nav-category">{{__('الإعلانات')}}</li>
      <li class="nav-item" >
        <a class="nav-link" data-bs-toggle="collapse" href="#email" role="button" aria-expanded="" aria-controls="email">
        <i class="mdi mdi-radio"></i>
          <span class="link-title">{{__('الإعلانات')}}</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse " id="email">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="/admin/allAdvirtising" class="nav-link {{ (request()->is('admin/allAdvirtising')) ? 'active' : '' }}"> {{__('جميع الاعلانات')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/addAdvirtising" class="nav-link {{ (request()->is('admin/addAdvirtising')) ? 'active' : '' }}">{{__('إضافة إعلان')}}</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">{{__('السيارات')}}</li>
      <li class="nav-item ">
        <a class="nav-link" data-bs-toggle="collapse" href="#car" role="button" aria-expanded="" aria-controls="email">
        <i class="mdi mdi-car"></i>
          <span class="link-title">{{__('السيارات')}}</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse " id="car">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="/admin/allCarsType" class="nav-link {{ (request()->is('admin/allCarsType')) ? 'active' : '' }}"> {{__('تصنيفات السيارات')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/addCarType" class="nav-link {{ (request()->is('admin/addCarType')) ? 'active' : '' }}">{{__('إضافة تصنيف جديد')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/addNewCar" class="nav-link {{ (request()->is('admin/addNewCar')) ? 'active' : '' }}">{{__('إضافة سيارة جديدة')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/allCars" class="nav-link {{ (request()->is('admin/allCars')) ? 'active' : '' }}">{{__('جميع السيارات')}}</a>
            </li>
          </ul>
        </div>
      </li>


      <li class="nav-item nav-category">{{__('المراجعات')}}</li>
      <li class="nav-item ">
        <a href="/admin/reviews" class="nav-link">
        <i class="mdi mdi-thumbs-up-down"></i> 
          <span class="link-title">{{__('المراجعات')}}</span>
        </a>
      </li>

      <li class="nav-item nav-category">{{__('الاشعارات')}}</li>
      <li class="nav-item ">
        <a class="nav-link" data-bs-toggle="collapse" href="#notification" role="button" aria-expanded="" aria-controls="email">
        <i class="mdi mdi-bell-ring-outline"></i>
          <span class="link-title">{{__('الاشعارات')}}</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse " id="notification">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="/admin/notifications" class="nav-link {{ (request()->is('admin/notifications')) ? 'active' : '' }}"> {{__('الاشعارات')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/sendNotifications" class="nav-link {{ (request()->is('admin/sendNotifications')) ? 'active' : '' }}"> {{__('إرسال اشعار')}}</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">{{__('الاعدادات')}}</li>
      <li class="nav-item ">
        <a class="nav-link" data-bs-toggle="collapse" href="#sitting" role="button" aria-expanded="" aria-controls="email">
        <i data-feather="settings"></i>
          <span class="link-title">{{__('الاعدادات العامة')}}</span>
         
        </a>
        <div class="collapse " id="sitting">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="/admin/aboutUs" class="nav-link {{ (request()->is('admin/aboutUs')) ? 'active' : '' }}"> {{__('من نحن')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/percentage" class="nav-link {{ (request()->is('admin/percentage')) ? 'active' : '' }}"> {{__('نسبة الربح')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/privacy" class="nav-link {{ (request()->is('admin/privacy')) ? 'active' : '' }}"> {{__('سياسة الخصوصية')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/Terms" class="nav-link {{ (request()->is('admin/Terms')) ? 'active' : '' }}"> {{__('الشروط والاحكام')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/locations" class="nav-link {{ (request()->is('admin/locations')) ? 'active' : '' }}">{{__('إدارة المواقع')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/socialMedia" class="nav-link {{ (request()->is('admin/socialMedia')) ? 'active' : '' }}">{{__('مواقع التواصل الاجتماعي')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/contactInformation" class="nav-link {{ (request()->is('admin/contactInformation')) ? 'active' : '' }}">{{__('بيانات التواصل')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/contactMessage" class="nav-link {{ (request()->is('admin/contactMessage')) ? 'active' : '' }}">{{__('رسائل اتصل بنا')}}</a>
            </li>
            <li class="nav-item">
              <a href="/admin/welcomeEmails" class="nav-link {{ (request()->is('admin/welcomeEmails')) ? 'active' : '' }}">{{__('الإيميلات الترحيبية')}}</a>
            </li>
            @if (Auth::guard('admin')->user()->type == 'admin')
            <li class="nav-item">
              <a href="/admin/myAdmins" class="nav-link {{ (request()->is('admin/myAdmins')) ? 'active' : '' }}">{{__('قائمة المدراء')}}</a>
            </li>
            @endif
          </ul>
        </div>
      </li>
      </li>

      <li class="nav-item nav-category">{{__('تسجيل خروج')}}</li>
      <li class="nav-item ">
      <a class="nav-link" href="{{ route('admin.logout') }}"
        onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
        <i class="fas fa-power-off"></i>
        <span class="link">
          {{__('تسجيل خروج')}}
        </span>
      </a>
      <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
      </li>
    </ul>
  </div>
</nav>
  @endif
  @else
  <div class="sidebar-body">
    <ul class="nav">
    <li class="nav-item nav-category">Main</li>
    <li class="nav-item">
        <a href="/provider/index" class="nav-link">
        <i  data-feather="box"></i>
          <span class="link-title">{{__('الرئيسية')}}</span>
        </a>
      </li>
      <li class="nav-item nav-category">{{__('التأجير اليدوي')}}</li>
      <li class="nav-item ">
        <a href="/provider/manualRental" class="nav-link">
        <i class="mdi mdi-calendar-clock"></i> 
          <span class="link-title">{{__('التأجير اليدوي')}}</span>
        </a>
      </li>
      <li class="nav-item nav-category">{{__('المدراء')}}</li>
      <li class="nav-item ">
        <a class="nav-link" data-bs-toggle="collapse" href="#Partner" role="button" aria-expanded="" aria-controls="email">
        <i class="mdi mdi-calendar-clock"></i>
          <span class="link-title">{{__('المدراء')}}</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse " id="Partner">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="/provider/allPartner" class="nav-link {{ (request()->is('provider/allPartner')) ? 'active' : '' }}">{{__('المدراء')}}</a>
            </li>
            <li class="nav-item">
              <a href="/provider/addPartner" class="nav-link {{ (request()->is('provider/addPartner')) ? 'active' : '' }}">{{__('إضافة مدراء')}}</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item nav-category">{{__('الحجوزات')}}</li>
      <li class="nav-item ">
        <a class="nav-link" data-bs-toggle="collapse" href="#rental" role="button" aria-expanded="" aria-controls="email">
        <i class="mdi mdi-calendar-clock"></i>
          <span class="link-title">{{__('الحجوزات')}}</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse " id="rental">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="/provider/providerBooking" class="nav-link {{ (request()->is('provider/providerBooking')) ? 'active' : '' }}">{{__('حجوزات التطبيق')}}</a>
            </li>
            <li class="nav-item">
              <a href="/provider/allRental" class="nav-link {{ (request()->is('provider/allCars')) ? 'active' : '' }}">{{__('الحجوزات اليدوية')}}</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item nav-category">{{__('الإعلانات')}}</li>
      <li class="nav-item" >
        <a class="nav-link" data-bs-toggle="collapse" href="#email" role="button" aria-expanded="" aria-controls="email">
        <i class="mdi mdi-radio"></i>
          <span class="link-title">{{__('الإعلانات')}}</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse " id="email">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="/provider/allAdvirtising" class="nav-link {{ (request()->is('provider/allAdvirtising')) ? 'active' : '' }}"> {{__('جميع الاعلانات')}}</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">{{__('السيارات')}}</li>
      <li class="nav-item ">
        <a class="nav-link" data-bs-toggle="collapse" href="#car" role="button" aria-expanded="" aria-controls="email">
        <i class="mdi mdi-car"></i>
          <span class="link-title">{{__('السيارات')}}</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse " id="car">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="/provider/addNewCar" class="nav-link {{ (request()->is('provider/addNewCar')) ? 'active' : '' }}">{{__('إضافة سيارة جديدة')}}</a>
            </li>
            <li class="nav-item">
              <a href="/provider/allCars" class="nav-link {{ (request()->is('provider/allCars')) ? 'active' : '' }}">{{__('جميع السيارات')}}</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item nav-category">{{__('الاحصائيات والتقارير')}}</li>
      <li class="nav-item ">
        <a class="nav-link" data-bs-toggle="collapse" href="#financialReports" role="button" aria-expanded="" aria-controls="email">
        <i class="mdi mdi-chart-line"></i>
          <span class="link-title">{{__('الاحصائيات والتقارير')}}</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse " id="financialReports">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="/provider/autoReports" class="nav-link {{ (request()->is('provider/autoReports')) ? 'active' : '' }}"> {{__('تقارير السيارات')}}</a>
            </li>
            <li class="nav-item">
              <a href="/provider/financialReports" class="nav-link {{ (request()->is('provider/financialReports')) ? 'active' : '' }}"> {{__('تقارير الأرباح')}}</a>
            </li>
          </ul>
        </div>
      </li>

      <li class="nav-item nav-category">{{__('المراجعات')}}</li>
      <li class="nav-item ">
        <a href="/provider/reviews" class="nav-link">
        <i class="mdi mdi-thumbs-up-down"></i> 
          <span class="link-title">{{__('المراجعات')}}</span>
        </a>
      </li>

      <li class="nav-item nav-category">{{__('الاشعارات')}}</li>
      <li class="nav-item ">
        <a class="nav-link" data-bs-toggle="collapse" href="#notification" role="button" aria-expanded="" aria-controls="email">
        <i class="mdi mdi-bell-ring-outline"></i>
          <span class="link-title">{{__('الاشعارات')}}</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse " id="notification">
          <ul class="nav sub-menu">
            <li class="nav-item">
              <a href="/provider/notifications" class="nav-link {{ (request()->is('provider/notifications')) ? 'active' : '' }}"> {{__('الاشعارات')}}</a>
            </li>
          </ul>
        </div>
      </li>

      </li>

      <li class="nav-item nav-category">{{__('تسجيل خروج')}}</li>
      <li class="nav-item ">
      <a class="nav-link" href="/provider/providerlogout">
        <i class="fas fa-power-off"></i>
        <span class="link">
          {{__('تسجيل خروج')}}
        </span>
      </a>
      <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
      </li>
    </ul>
  </div>
</nav>
  @endif