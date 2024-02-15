<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" 
              rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" 
              crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" 
        crossorigin="anonymous"></script>
    </head>
    <body>
        <header>
          <div class="container">
            <div style="display: flex; justify-content:space-beetween;">  
              <div>
                <img src="{{asset('img/logo.png')}}" alt="logo">
                <h1 class="display-6">@yield('titulo')</h1>
              </div>
              <div style="display: flex; justify-content:flex-end; align-items:center; flex-grow:1;">
                <h3 style="margin:10px;" class="justify-self-end">{{Auth::user()->name}}</h3>
                {{-- Mostrar nº de productos en carrito --}}
                @if (session('carrito')!=null)
                  <h5 style="margin:10px;display: flex; flex-direction:column; align-items:center">
                    <a style="text-decoration:none;color:red;" href="{{route('verCarrito')}}">{{sizeof(session('carrito'))}}</a>       
                    <a href="{{route('verCarrito')}}"><img style="width: 40px;" src="{{asset('img/carrito.png')}}" alt=""></a>           
                  </h5>
                @endif
                <a  style="margin:10px;" class="btn btn-outline-success" 
              href="{{route('salir')}}">Salir</a>
              </div>
              
            </div>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                  <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('productos')}}">Productos</a>
                      </li>
                      @if (Auth::user()->tipo=='A')                     
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="{{route('clientes')}}">Clientes</a>
                          </li>                  
                      @endif
                      <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('pedidos')}}">Pedidos</a>
                      </li> 
                      
                    </ul>
                  </div>
                </div>
              </nav>
          </div>
        </header>
        <section>
            <div class="container">
                <!-- Comprobar si hay mensaje en la variable de sessión -->
                @if (session('mensaje'))
                <h5 class="text-danger">{{session('mensaje')}}</h5> 
                @endif
                <!-- Mostrar todas las validaciones juntas -->
                {{-- 
                @if ($errors->any())
                  <ul>
                    @foreach ($errors->all() as $e)
                        <li class="text-danger">{{$e}}</li>
                    @endforeach
                  </ul>                    
                @endif
                 --}}
                
            </div>
        </section>
        <section>
            <div class="container">
                @yield('contenido')
            </div>
        </section>
    </body>
</html>
