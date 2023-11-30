<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <link
      rel="apple-touch-icon"
      sizes="76x76"
      href="<?= base_url() ?>assets/soft_ui/img/apple-icon.png"
    />
    <link rel="icon" type="image/png" href="<?= base_url() ?>assets/soft_ui/img/favicon.png" />
    <title>Booble QA</title>
    <!--     Fonts and icons     -->
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"
      rel="stylesheet"
    />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- date picker -->
     
    <!-- Nucleo Icons -->
    <link href="<?= base_url() ?>assets/soft_ui/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/soft_ui/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script
      src="https://kit.fontawesome.com/42d5adcbca.js"
      crossorigin="anonymous"
    ></script>
    <script
      src="<?= base_url().'assets/js/jquery/jquery-3.1.0.js'; ?>"
      crossorigin="anonymous"
    ></script>
    
    <link href="<?= base_url() ?>assets/soft_ui/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link
      id="pagestyle"
      href="<?= base_url() ?>assets/soft_ui/css/soft-ui-dashboard.css?v=1.0.7"
      rel="stylesheet"
    />
    <link
      id="pagestyle"
      href="<?= base_url() ?>assets/select2/css/select2.min.css"
      rel="stylesheet"
    />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script
      defer
      data-site="YOUR_DOMAIN_HERE"
      src="https://api.nepcha.com/js/nepcha-analytics.js"
    ></script>
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>
    <script src="<?= base_url() ?>assets/select2/js/select2.min.js"></script>
  </head>

  <body class="g-sidenav-show bg-gray-100">
    <aside
      class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3"
      id="sidenav-main"
    >
      <div class="sidenav-header">
        <i
          class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
          aria-hidden="true"
          id="iconSidenav"
        ></i>
        <a
          class="navbar-brand m-0"
          href=" https://demos.creative-tim.com/soft-ui-dashboard/pages/dashboard.html "
          target="_blank"
        >
          <img
            src="<?= base_url() ?>assets/soft_ui/img/logo-ct-dark.png"
            class="navbar-brand-img h-100"
            alt="main_logo"
          />
          <span class="ms-1 font-weight-bold">Booble QA</span>
        </a>
      </div>
      <hr class="horizontal dark mt-0" />
      <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main" style="height:100% !important;">
        <ul class="navbar-nav"  >
        <?php 
            $url = uri_string();  
            foreach($menu as $mn){ 
              $active = "";
              if($url == $mn->url){
                $active = "active";
              }
              ?>
              <li class="nav-item">
                    <a class="nav-link <?= $active ?>" href="<?= base_url($mn->url) ?>">
                    <div
                        class="icon icon-shape icon-sm shadow border-radius-md bg-dark text-center me-2 d-flex align-items-center justify-content-center"
                    >
                    <i class="<?= $mn->logo ?>" aria-hidden="true" ></i>                  
                        
                         
                    </div>
                    <span class="nav-link-text ms-1"><?= $mn->nm_menu; ?></span>
                    </a>
            </li>
        <?php }
        ?>
         
        </ul>
      </div>
    </aside>
    <main
      class="main-content position-relative max-height-vh-100 h-100 border-radius-lg"
    >
      <!-- Navbar -->
      <nav
        class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl"
        id="navbarBlur"
        navbar-scroll="true"
      >
        <div class="container-fluid py-1 px-3">
          <nav aria-label="breadcrumb">
            <ol
              class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5"
            >
              <li class="breadcrumb-item text-sm">
                <a class="opacity-5 text-dark" href="javascript:;">Pages</a>
              </li>
              <li
                class="breadcrumb-item text-sm text-dark active"
                aria-current="page"
              >
                <?= $title; ?>
              </li>
            </ol>
          </nav>
                <div
            class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4"
            id="navbar"
          >
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
             
            </div>
            <ul class="navbar-nav justify-content-end">
              <li class="nav-item d-flex align-items-center">
                <a
                  href="logout"
                  class="nav-link text-body font-weight-bold px-0"
                >
                  <i class="fa fa-user me-sm-1"></i>
                  <span class="d-sm-inline d-none">Logout</span>
                </a>
              </li>
              <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                <a
                  href="javascript:;"
                  class="nav-link text-body p-0"
                  id="iconNavbarSidenav"
                >
                  <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                  </div>
                </a>
              </li>
            
            </ul>
          </div>
        </div>
      </nav>