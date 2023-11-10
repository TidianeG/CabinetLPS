<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('assets/img/favicon/logo.png')}}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

      <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/core.css')}}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('assets/vendor/css/theme-default.css')}}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset('assets/css/demo.css')}}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" />
    
    <!-- Helpers -->
    <script src="{{asset('assets/vendor/js/helpers.js')}}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('assets/js/config.js')}}"></script>
    <script src="https://kit.fontawesome.com/3b01b14772.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link
     rel="stylesheet"
     href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css"
   />
</head>
<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <nav class="navbar navbar-light ">
                    <div class="container-fluid pt-3 pb-3">
                        <a class="navbar-brand" href="#">
                            <img src="{{asset('assets/img/favicon/logo_lps_text.png')}}" alt="" width="100%" height="100%" class="d-inline-block align-text-top">
                        </a>
                    </div>
                </nav>
                <div class="menu-inner-shadow"></div>
                <ul class="menu-inner py-1">
                    <!-- Dashboards -->
                    <li class="menu-item active open">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Dashboards">Tableau de bord</div>
                            <div class="badge bg-danger rounded-pill ms-auto"></div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                            <a
                                href="{{route('user_space')}}"
                                class="menu-link">
                                <div data-i18n="CRM">Accueil</div>
                            </a>
                            </li>
                            
                        </ul>
                    </li>
                    @if(Auth::user()->profil=='admin')
                        <!-- Layouts -->
                        <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class=" fa-solid fa-stethoscope menu-icon tf-icons"></i>
                                <div data-i18n="Layouts">Consultations</div>
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                <a href="{{route('list_type_consultation')}}" class="menu-link">
                                    <div data-i18n="Without menu">Types consultations</div>
                                </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Front Pages -->
                        <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons fa-solid fa-cash-register"></i>
                                <div data-i18n="Front Pages">Point de vente</div>
                                
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                <a
                                    href="{{route('list_point_de_ventes')}}"
                                    class="menu-link">
                                    <div data-i18n="Landing">Liste point de vente</div>
                                </a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('get_all_tickets')}}" class="menu-link ">
                                <i class="menu-icon tf-icons fa-solid fa-ticket"></i>
                                <div data-i18n="Front Pages">Tickets</div>
                                
                            </a>
                            <ul class="menu-sub">
                                
                            </ul>
                        </li>
                        <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons fa-solid fa-hand-holding-dollar"></i>
                                <div data-i18n="Front Pages">Facturation</div>
                                
                            </a>
                            <ul class="menu-sub">
                                
                            </ul>
                        </li>
                        <li class="menu-item">
                            <a href="{{route('get_ipms')}}" class="menu-link ">
                                <i class="menu-icon tf-icons fa-solid fa-file-invoice-dollar"></i>
                                <div data-i18n="Front Pages">IPM</div>
                                
                            </a>
                            <ul class="menu-sub">
                                
                            </ul>
                        </li>

                        <li class="menu-item">
                            <a href="{{route('get_all_encaissement')}}" class="menu-link ">
                                <i class="menu-icon tf-icons fa-solid fa-dollar"></i>
                                <div data-i18n="Front Pages">Encaissement</div>
                                
                            </a>
                            <ul class="menu-sub">
                                
                            </ul>
                        </li>

                        <li class="menu-header small text-uppercase">
                            <span class="menu-header-text">Parametres</span>
                        </li>
                        <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons fa-solid fa-person-breastfeeding"></i>
                                <div data-i18n="Front Pages">Gestion clients</div>
                                
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                <a
                                    href="{{route('list_clients')}}"
                                    class="menu-link">
                                    <div data-i18n="Landing">Clients</div>
                                </a>
                                </li>
                                
                            </ul>
                        </li>
                    @endif
                    @if(Auth::user()->profil=='caissier')
                        <li class="menu-item">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons fa-solid fa-cash-register"></i>
                                <div data-i18n="Front Pages">Point de vente</div>
                                
                            </a>
                            <ul class="menu-sub">
                                <li class="menu-item">
                                <a
                                    href="{{route('my_caisse')}}"
                                    class="menu-link">
                                    <div data-i18n="Landing">Caisse</div>
                                </a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    <!-- Apps -->
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons fa-solid fa-gears"></i>
                            <div data-i18n="Front Pages">Parametres</div>
                            
                        </a>
                        <ul class="menu-sub">
                            @if(Auth::user()->profil=='admin')
                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <i class="menu-icon tf-icons fa-solid fa-person-breastfeeding"></i>
                                    <div data-i18n="Front Pages">Gestion clients</div>
                                    
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                    <a
                                        href="{{route('list_clients')}}"
                                        class="menu-link">
                                        <div data-i18n="Landing">Clients</div>
                                    </a>
                                    </li>
                                    
                                </ul>
                            </li>
                                <li class="menu-item">
                                    <a
                                        href="{{route('list_users')}}"
                                        class="menu-link">
                                        <i class="menu-icon tf-icons fa-solid fa-user-group"></i>
                                        <div data-i18n="Landing">Utilisateurs</div>
                                    </a>
                                </li>
                            @endif
                            <li class="menu-item">
                                <a
                                    href="{{route('my_account')}}"
                                    class="menu-link">
                                    <i class="menu-icon tf-icons fa-solid fa-user"></i>
                                    <div data-i18n="Landing">Mon compte</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    
                </ul>
            </aside>
                <!-- / Menu -->
            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                        <i class="bx bx-menu bx-sm"></i>
                    </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                    <!-- Search -->
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                        <i class="bx bx-search fs-4 lh-0"></i>
                        <input
                            type="text"
                            class="form-control border-0 shadow-none ps-1 ps-sm-2"
                            placeholder="Search..."
                            aria-label="Search..." />
                        </div>
                    </div>
                    <!-- /Search -->

                    <ul class="navbar-nav flex-row align-items-center ms-auto">
                        <!-- Place this tag where you want the button to render. -->
                        
                        <!-- User -->
                        <li class="nav-item navbar-dropdown dropdown-user dropdown">
                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                            <div class="avatar avatar-online">
                                <img src="{{asset('assets/img/avatars/user-avatar.png')}}" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                    <img src="{{asset('assets/img/avatars/user-avatar.png')}}" alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="fw-medium d-block">{{Auth::user()->prenom}} {{Auth::user()->nom}}</span>
                                    <small class="text-muted">{{Auth::user()->profil}}</small>
                                </div>
                                </div>
                            </a>
                            </li>
                            <li>
                            <div class="dropdown-divider"></div>
                            </li>
                            <li>
                            <a class="dropdown-item" href="{{route('my_account')}}">
                                <i class="bx bx-user me-2"></i>
                                <span class="align-middle">Mon Profil</span>
                            </a>
                            </li>
                            <li>
                            <a class="dropdown-item" href="#">
                                <i class="bx bx-cog me-2"></i>
                                <span class="align-middle">Parametres</span>
                            </a>
                            </li>
                            
                            <li>
                            <div class="dropdown-divider"></div>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                                    <i class="bx bx-power-off me-2"></i>
                                    <span class="align-middle">Déconnecxion</span>
                                </a>    
                                <form id="frm-logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                        </li>
                        <!--/ User -->
                    </ul>
                    </div>
                </nav>
                <!-- / Navbar -->

                <main class="pt-2">
                    <!-- Content wrapper -->
                    <div class="content-wrapper" style="paddind:0px !important;">
                        <!-- Content -->
                        <div class="container-xxl flex-grow-1 container-p-y" style="paddind:0px !important;">
                            @yield('content')
                        </div>
                    </div>
                </main>
            </div>
                        <!-- / Layout page -->
        </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="{{asset('assets/vendor/libs/jquery/jquery.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/popper/popper.js')}}"></script>
    <script src="{{asset('assets/vendor/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('assets/vendor/js/menu.js')}}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>

    <!-- Main JS -->
    <script src="{{asset('assets/js/main.js')}}"></script>

    <!-- Page JS -->
    <script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  
    <script>
       
        $(document).ready( function () {
                        //$('#myTable').DataTable();
                        new DataTable('#myTable', {
                                language: {
                                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json',
                                },
                            });
                    });
        jQuery(document).ready(function($) {
                $(".clickable-row").click(function() {
                    window.location = $(this).data("href");
                });
           
        } );
    </script>
    <!-- Page JS -->
    <script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>
