

<!-- header-section start  -->
<header class="header">
  <div class="header-top">
    <div class="container">
      <div class="row align-items-center gy-2">
        <div class="col-lg-8 col-md-7">
          <ul class="header-top-info-list">
            <li>
              <a href="tel:{{$gs->site_phone}}"><i class="fas fa-phone"></i> {{translate($gs->site_phone)}}</a>
            </li>
            <li>
              <a href="mailto:{{$gs->site_email}}"><i class="fas fa-envelope"></i> {{translate($gs->site_email)}}</a>
            </li>
          </ul>
        </div>
        <div class="col-lg-4 col-md-5">
          <div class="d-flex flex-wrap align-items-center justify-content-md-end justify-content-center">
              <ul class="social-list me-3">
{{--                @forelse ($footersociallink as $item)--}}
{{--                    <li>--}}
{{--                        <a href="{{ translate(@$item->data->social_link) }}" target="_blank"><i class="{{ @$item->data->social_icon }}"></i></a>--}}
{{--                    </li>--}}
{{--                @empty--}}
{{--                @endforelse--}}
              </ul>
              <select class="changeLang" aria-label="Default select example">
                  @foreach (displayLanguages() as $country => $code)
                      <option value="{{ $code }}"
                          {{ app()->getLocale() == $code ? 'selected' : '' }}>
                          {{ translate(ucwords($country) )}}
                      </option>

                  @endforeach
              </select>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="header-bottom">
    <div class="container">
      <nav class="navbar navbar-expand-xl p-0 align-items-center">
        <a class="site-logo site-title" href="{{ route('home') }}">
            <div style="width: 200px; ">
              <h1>{{$gs->sitename}}</h1>
            </div>


        </a>




        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
          <span class="menu-toggle"></span>
        </button>
        @php

          $route = Route::current()->getName();

        @endphp
        <div class="collapse navbar-collapse mt-lg-0 mt-3" id="mainNavbar">
          <ul class="nav navbar-nav main-menu ms-auto">
            <li class="nav-item"><a href="{{url('/')}}" class="nav-link @php echo ($route == '') ? 'active' : '' @endphp }}">{{translate('HOME')}}</a></li>
            <li class="nav-item"><a href="{{route('about')}}" class="nav-link @php echo ($route == 'about') ? 'active' : '' @endphp }}">{{translate('ABOUT US')}}</a></li>

            <li class="nav-item"><a href="{{route('investmentplan')}}" class="nav-link @php echo ($route == 'plan') ? 'active' : '' @endphp }}">{{translate('PLANS')}}</a></li>
            <li class="nav-item"><a href="{{route('faq')}}" class="nav-link @php echo ($route == 'faq') ? 'active' : '' @endphp }}">{{translate('FAQ')}}</a></li>
            <li class="nav-item"><a href="{{route('terms')}}" class="nav-link @php echo ($route == 'terms') ? 'active' : '' @endphp }}">{{translate('TERMS')}}</a></li>
            <li class="nav-item"><a href="{{route('contact')}}" class="nav-link @php echo ($route == 'contact') ? 'active' : '' @endphp }}">{{translate('CONTACT US')}}</a></li>
            <li class="account-btn">
              @if (Auth::user())
                  <a href="{{ route('home') }}" class="nav-link @php echo ($route == 'home') ? 'active' : '' @endphp }}">{{ translate('Dashboard') }}</a>
              @else
                  <a href="{{ url('login') }}" class="nav-link @php echo ($route == 'home') ? 'active' : '' @endphp }}">{{ translate('Login') }}</a>
              @endif
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div><!-- header bottom end -->
</header>
<!-- header-section end  -->
