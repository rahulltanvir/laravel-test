  <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

  <div class="preloader">
      <div class="preloader-inner">
          <div class="preloader-icon">
              <span></span>
              <span></span>
          </div>
      </div>
  </div>


  <header class="header navbar-area">
      <div class="container">
          <div class="row">
              <div class="col-12">
                  <select>
                      <option></option>
                      <option></option>
                  </select>
              </div>
          </div>
      </div>
      <div class="topbar">
          <div class="container">
              <div class="row align-items-center">
                  <div class="col-lg-4 col-md-4 col-12">
                      <div class="top-left">
                          <ul class="menu-top-link">
                              <li>
                                  <div class="select-position">
                                      <select id="select4">
                                          <option value="0" selected>$ USD</option>
                                          <option value="1">€ EURO</option>
                                          <option value="2">$ CAD</option>
                                          <option value="3">₹ INR</option>
                                          <option value="4">¥ CNY</option>
                                          <option value="5">৳ BDT</option>
                                      </select>
                                  </div>
                              </li>
                              <li>
                                  <div class="select-position">
                                      <select id="select5">
                                          <option value="0" selected>English</option>
                                          <option value="1">Español</option>
                                          <option value="2">Filipino</option>
                                          <option value="3">Français</option>
                                          <option value="4">العربية</option>
                                          <option value="5">हिन्दी</option>
                                          <option value="6">বাংলা</option>
                                      </select>
                                  </div>
                              </li>
                          </ul>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-12">
                      <div class="top-middle">
                          <ul class="useful-links">
                              <li><a href="index.html">Home</a></li>
                              <li><a href="about-us.html">About Us</a></li>
                              <li><a href="contact.html">Contact Us</a></li>
                          </ul>
                      </div>
                  </div>
                  <div class="col-lg-4 col-md-4 col-12">
                      <div class="top-end">

                          @if (Auth::guard('customer')->check())
                              <div class="user">
                                  <i class="lni lni-user"></i>
                                  Hello, {{ Auth::guard('customer')->user()->name }}
                              </div>

                              <ul class="user-login">
                                  <li>
                                      <a href="{{ route('customer.dashboard') }}">
                                          My Dashboard
                                      </a>
                                  </li>
                                  <form action="{{ route('customer.logout') }}" method="POST">
                                      @csrf
                                      <button type="submit" class="btn btn-danger btn-sm rounded-pill px-3">
                                          <i class="lni lni-exit"></i>
                                          Logout
                                      </button>
                                  </form>
                              </ul>
                          @else
                              <div class="user">
                                  <i class="lni lni-user"></i>
                                  Hello
                              </div>

                              <ul class="user-login">

                                  <li>
                                      <a href="{{ route('customer.login') }}">
                                          Sign In
                                      </a>
                                  </li>

                                  <li>
                                      <a href="{{ route('customer.register') }}">
                                          Register
                                      </a>
                                  </li>

                              </ul>
                          @endif

                      </div>
                  </div>
              </div>
          </div>
      </div>


      <<!-- Header Middle -->
          <div class="header-middle">
              <div class="container">
                  <div class="row align-items-center">

                      <!-- Logo -->
                      <div class="col-lg-2 col-md-3 col-6">
                          <a class="navbar-brand" href="{{ route('home') }}">
                              <img src="{{ asset('website/assets/images/logo/logo.svg') }}" alt="Logo">
                          </a>
                      </div>


                      <!-- Search -->
                      <div class="col-lg-6 col-md-5 d-none d-md-block">

                   <form action="{{ route('shop') }}" method="GET">

    <div class="search-box">

        <input type="text"
               name="search"
               placeholder="Search Product">

        <button type="submit">
            <i class="lni lni-search-alt"></i>
        </button>

    </div>

</form>

                      </div>



                      <!-- Right Area -->
                      <div class="col-lg-4 col-md-4 col-6">

                          <div class="header-action">


                              <!-- Hotline -->
                              <div class="hotline">

                                  <i class="lni lni-phone"></i>

                                  <div>
                                      <small>Hotline</small>
                                      <h6>09678-555555</h6>
                                  </div>

                              </div>



                              <!-- Account -->

                              @if (Auth::guard('customer')->check())
                                  <div class="account">

                                      <a href="{{ route('customer.dashboard') }}">
                                          <i class="lni lni-user"></i>

                                          <span>
                                              {{ Auth::guard('customer')->user()->name }}
                                          </span>

                                      </a>

                                  </div>
                              @else
                                  <div class="account">

                                      <a href="{{ route('customer.login') }}">
                                          <i class="lni lni-user"></i>

                                          <span>
                                              Login
                                          </span>

                                      </a>

                                  </div>
                              @endif




                              <!-- Cart -->

                              @php

                                  $cart = session('cart', []);

                                  $cartCount = 0;

                                  foreach ($cart as $item) {
                                      $cartCount += $item['quantity'];
                                  }

                              @endphp


                              <a href="{{ route('cart') }}" class="cart-icon">

                                  <i class="lni lni-cart"></i>

                                  <span>
                                      {{ $cartCount }}
                                  </span>

                              </a>


                          </div>


                      </div>


                  </div>
              </div>
          </div>
          </div>
          </div>


          <div class="container">
              <div class="row align-items-center">
                  <div class="col-lg-8 col-md-6 col-12">
                      <div class="nav-inner">

                          <div class="mega-category-menu">


                              <span class="cat-button">

                                  <i class="lni lni-menu"></i>

                                  Categories

                              </span>



                              <ul class="sub-category">


                                  @foreach ($categories as $category)
                                      <li>


                                          <a href="{{ route('product-category', $category->id) }}">

                                              {{ $category->name }}

                                          </a>



                                          @if ($category->subcategories->count())
                                              <ul class="inner-sub-category">


                                                  @foreach ($category->subcategories as $subcategory)
                                                      <li>

                                                          <a
                                                              href="{{ route('product-subcategory', $subcategory->id) }}">

                                                              {{ $subcategory->name }}

                                                          </a>

                                                      </li>
                                                  @endforeach


                                              </ul>
                                          @endif


                                      </li>
                                  @endforeach


                              </ul>


                          </div>


                          <nav class="navbar navbar-expand-lg">
                              <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                                  data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                  aria-expanded="false" aria-label="Toggle navigation">
                                  <span class="toggler-icon"></span>
                                  <span class="toggler-icon"></span>
                                  <span class="toggler-icon"></span>
                              </button>
                              <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                                  <ul id="nav" class="navbar-nav ms-auto">

                                      {{-- Home --}}
                                      <li class="nav-item">
                                          <a href="{{ route('home') }}" aria-label="Toggle navigation">
                                              Home
                                          </a>
                                      </li>


                                      {{-- Shop --}}
                                      <li class="nav-item">
                                          <a href="{{ route('shop') }}">Shop</a>
                                      </li>


                                      {{-- Pages --}}
                                      <li class="nav-item">
                                          <a class="dd-menu collapsed" href="javascript:void(0)"
                                              data-bs-toggle="collapse" data-bs-target="#submenu-pages"
                                              aria-controls="navbarSupportedContent" aria-expanded="false"
                                              aria-label="Toggle navigation">
                                              Pages
                                          </a>

                                          <ul class="sub-menu collapse" id="submenu-pages">

                                              <li class="nav-item">
                                                  <a href="#">
                                                      About Us
                                                  </a>
                                              </li>

                                              <li class="nav-item">
                                                  <a href="#">
                                                      FAQ
                                                  </a>
                                              </li>

                                          </ul>
                                      </li>


                                      {{-- Contact --}}
                                      <li class="nav-item">
                                          <a href="#" aria-label="Toggle navigation">
                                              Contact Us
                                          </a>
                                      </li>


                                      {{-- Customer Account --}}
                                      @if (Auth::guard('customer')->check())
                                          <li class="nav-item">
                                              <a href="{{ route('customer.dashboard') }}">
                                                  My Account
                                              </a>
                                          </li>
                                      @endif

                                  </ul>
                              </div>
                          </nav>

                      </div>
                  </div>
                  <div class="col-lg-4 col-md-6 col-12">

                      <div class="nav-social">
                          <h5 class="title">Follow Us:</h5>
                          <ul>
                              <li>
                                  <a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a>
                              </li>
                              <li>
                                  <a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a>
                              </li>
                              <li>
                                  <a href="javascript:void(0)"><i class="lni lni-instagram"></i></a>
                              </li>
                              <li>
                                  <a href="javascript:void(0)"><i class="lni lni-skype"></i></a>
                              </li>
                          </ul>
                      </div>

                  </div>
              </div>
          </div>

  </header>
