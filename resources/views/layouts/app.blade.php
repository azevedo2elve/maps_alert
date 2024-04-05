<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maps Alert</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
     
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
</head>
<body>

    <div class="container mx-auto">
        <div class="flex flex-col items-center">

            @yield('content')
            <div class="flex text-center text-lg">
                
                <form method="get" action="{{ route('map.alert') }}" class="flex flex-wrap justify-center p-2">
                    @csrf
                    <div class="basis-2/4">
                        <label for="lat">Latitude:</label><br>
                        <input name="lat" id="lat" type="text" class="border-solid border-2 border-blue-950 shadow-md bg-slate-200 rounded-lg w-[80%] h-[40px]">
                    </div>

                    <div class="basis-2/4">
                        <label for="lng">Longitude:</label><br>
                        <input name="lng" id="lng" type="text" class="border-solid border-2 border-blue-950 shadow-md bg-slate-200 rounded-lg w-[80%] h-[40px]">
                    </div>

                    <div class="basis-auto mt-2">
                        <button type="submit" class="border-2 border-blue-950 h-10 w-60 bg-blue-800 text-white rounded-lg hover:bg-blue-600">Alerta</button>
                    </div>
                </form>
            </div>

            @yield('alert')
            
        </div>
    </div>

    @yield('scripts')
</body>
</html>