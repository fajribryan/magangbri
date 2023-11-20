<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">
  <head>
    <!-- Your existing head content -->

    <style>
      /* Your existing styles */
      .container-fluid {
        position: fixed;
      }
    </style>

    <!-- Bootstrap CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Custom styles for this template -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ asset('/css/dashboard.css') }}" rel="stylesheet">
  </head>
  <body>
    
    <div class="container-fluid">
      <div class="row">
        <div class="sidebar border-right col-md-3 col-lg-2 p-0" style="background-color: #102C57;">
          <div tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
            <ul class="nav flex-column">
              <a  class="nav-link" style="color: #E8AA42;font-family: Arial, Helvetica, sans-serif; font-weight:bold; font-size: 24px;">BRIVEY</a>
              <a class="nav-link " aria-current="page" href="/dashboard" style="color: white;font-family: Arial, Helvetica, sans-serif; font-weight:bold;margin-top: 50px">
                Dashboard
              </a>
              <a class="nav-link" href="{{ url('inventaris') }}" style="color: white;font-family: Arial, Helvetica, sans-serif; font-weight:bold">
                Premis Non SLM
              </a>
              <a class="nav-link" href="/premisslm" style="color: white;font-family: Arial, Helvetica, sans-serif; font-weight:bold">
                Premis SLM
              </a>
              <a class="nav-link" href="/survey" style="color: white;font-family: Arial, Helvetica, sans-serif; font-weight:bold">
                Survey Kebersihan
              </a>
              <a class="nav-link" href="/akseswebsite" style="color: white;font-family: Arial, Helvetica, sans-serif; font-weight:bold">
                Report Akses Website
              </a>
              @auth
              <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:white;font-family: Arial, Helvetica, sans-serif; font-weight:bold; font-size:14px; margin-left:4px;">
                {{ auth()->user()->nama }}
                </button>
                <ul class="dropdown-menu">
                  <li>
                    <form action="/logout" method="POST">
                      @csrf
                      <button type="submit" class="dropdown-item"  style="color:rgb(0, 0, 0);font-family: Arial, Helvetica, sans-serif; font-weight:bold; font-size:16px;">Logout <i class="fa-solid fa-right-from-bracket"></i></button>
                    </form>
                  </li>
                </ul>
              </div>  
              @endauth
            </ul>
          </div>
        </div>
  
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
          <div class="row">
            @yield('container')
          </div>
        </main>
      </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.bundle.min.js"></script>

    <!-- Your additional scripts -->
    <script src="{{ asset('/css/js/dashboard.js') }}"></script>
  </body>
</html>
