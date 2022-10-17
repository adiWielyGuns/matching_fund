   <!-- Preloader -->
   <div class="preloader"></div>

   <!-- main header -->
   <header class="main-header menu-absolute">


       <!--Header-Upper-->
       <div class="header-upper">
           <div class="container-fluid clearfix">

               <div class="header-inner d-flex align-items-center">
                   <div class="logo-outer">
                       <div class="logo"><a href="index.html"><img src="{{ cms('logo') }}" height="50" alt="Logo"
                                   title="Logo"></a></div>
                   </div>

                   <div class="nav-outer clearfix">
                       <!-- Main Menu -->
                       <nav class="main-menu navbar-expand-lg">
                           <div class="navbar-header">
                               <div class="mobile-logo my-15">
                                   <a href="index.html">
                                       <img src="{{ cms('logo') }}" alt="Logo" height="50" title="Logo">
                                   </a>
                               </div>

                               <!-- Toggle Button -->
                               <button type="button" class="navbar-toggle" data-toggle="collapse"
                                   data-target=".navbar-collapse">
                                   <span class="icon-bar"></span>
                                   <span class="icon-bar"></span>
                                   <span class="icon-bar"></span>
                               </button>
                           </div>

                           <div class="navbar-collapse collapse clearfix">
                               <ul class="navigation clearfix">
                                   <li><a href="{{ route('home-front-end') }}">Home</a></li>

                                   <li><a href="{{ route('menu-front-end') }}">Menu</a></li>

                                   <li><a href="{{ route('schedule-front-end') }}">Schedule</a></li>
                                   <li><a href="{{ route('contact-front-end') }}">Contact</a></li>
                                   <li><a href="{{ route('blog-front-end') }}">Blog</a></li>
                                   <li><a href="{{ route('faq-front-end') }}">Faq</a></li>
                               </ul>
                           </div>

                       </nav>
                       <!-- Main Menu End-->
                   </div>
               </div>
           </div>
       </div>
       <!--End Header Upper-->
   </header>


   <!--Form Back Drop-->
   <div class="form-back-drop"></div>
