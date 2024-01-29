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
        <section>
            <div style="display: flex; ">
                <img src="{{asset('img/logo.png')}}" alt="logo">
                <h1 class="display-6">Crear usuario</h1>
            </div>
        </section>
        <section>
            <div class="container">
                <!-- Comprobar si hay mensaje en la variable de sessión -->
                @if (session('mensaje'))
                <h5 class="text-danger">{{session('mensaje')}}</h5> 
                @endif
                
            </div>
        </section>
        <section>
            <div class="container">
                <form action="{{route('registrar')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="nombre" class="form-control" name="nombre" id="nombre" 
                        value="{{old('nombre')}}" placeholder="Introduce tu nombre"/>
                        @error('nombre')            
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" 
                        value="{{old('email')}}" placeholder="email@email.com"/>
                        @error('email')            
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="ps1" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" name="ps1" id="ps1"/>
                        @error('ps1')            
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="ps2" class="form-label">Repite Contraseña</label>
                        <input type="password" class="form-control" name="ps2" id="ps2"/>
                        @error('ps2')            
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="telf" class="form-label">Teléfono</label>
                        <input type="text" class="form-control" name="telf" id="telf" 
                        value="{{old('telf')}}" placeholder="678233222"/>
                        @error('telf')            
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="dir" class="form-label">Dirección</label>
                        <input type="text" class="form-control" name="dir" id="dir" 
                        value="{{old('dir')}}" placeholder="C\ del Sol, 46, Plasencia, Cáceres"/>
                        @error('dir')            
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-outline-success">Crear</button>
                        <button type="reset" class="btn btn-outline-success">Cancelar</button>
                    </div>
                </form>
            </div>
        </section>
    </body>
</html>

    
