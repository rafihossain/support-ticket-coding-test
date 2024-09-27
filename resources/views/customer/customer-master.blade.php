<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>Admin Panel</title>
  </head>
  @yield('style')
  <body>
    <header>
        <div class="container-fluid header_full">
            
        </div>
    </header>
    <section>
      
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-2 sidebar_part">
                  <div class="user_part">
                    <img src="{{ asset('images/avatar.png') }}" alt="avatar">
                    <h4>Hello
                      @auth
                      {{ auth()->user()->name }}
                      @endauth
                    </h4>
                    <p><i class="fa fa-circle"></i> Online</p>
                  </div>
                  <div class="menu">
                      <ul>
                        <li><a href="{{ route('admin.support.ticket.all') }}"><i class="fa fa-bandcamp"></i> Support Tickets</a></li>
                        <li>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault();
                            document.getElementById('logout_submit_btn').dispatchEvent(new MouseEvent('click'));">
                            <i class="fa fa-power-off"></i> Logout</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf                         
                                <button class="d-none" type="submit" id="logout_submit_btn"></button>
                            </form>
                        </li>
                      </ul>
                  </div>
                </div>

                @yield('content')
                
            </div>
        </div>
    </section>
    <footer>
        <div class="container-fluid footer_full mt-5">
            
        </div>
    </footer>
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  </body>
</html>