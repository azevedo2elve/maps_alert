@extends('layouts.app')

@section('content')
    <div id="map" class="border-8 border-blue-950 rounded-lg shadow-lg"></div>
@endsection

@section('alert')
    <?php
        if(isset($data) && array_key_exists("alerts", $data)){
            
            //dd($police);
            foreach ($police as $key => $value) {
                $key += 1;
                echo '<div class="border border-red-600 flex justify-center">';
                echo '<img src="/img/policia.png" alt="Ícone" class="icone">' . '<div class="flex items-center pl-4">' . $key . ' - ' . 'POLICIA</div> <br>';
                echo '</div>';
            }
            
            echo '<br>';

            foreach ($hazard as $key => $value) {
                $key += 1;
                echo '<div class="border border-red-600 flex justify-center">';
                echo '<img src="/img/perigo.png" alt="Ícone" class="icone">' . '<div class="flex items-center pl-4">' . $key . ' - ' . 'PERIGO</div> <br>';
                echo '</div>';
            }

            echo '<br>';

            foreach ($roadClosed as $key => $value) {
                $key += 1;
                echo '<div class="border border-red-600 flex justify-center">';
                echo '<img src="/img/bloqueio.png" alt="Ícone" class="icone">' . '<div class="flex items-center pl-4">' . $key . ' - ' . 'ESTRADA BLOQUEADA</div> <br>';
                echo '</div>';
            }

            echo '<br>';

            foreach ($jam as $key => $value) {
                $key += 1;
                echo '<div class="border border-red-600 flex justify-center">';
                echo '<img src="/img/trafego.png" alt="Ícone" class="icone">' . '<div class="flex items-center pl-4">' . $key . ' - ' . 'TRÁFEGO</div> <br>';
                echo '</div>';
            }

            echo '<br>';

            // JSON
            $json_police = json_encode($police);
            $json_hazard = json_encode($hazard);
            $json_roadClosed = json_encode($roadClosed);
            $json_jam = json_encode($jam);
            //dd($json_roadClosed);

        } else {
            echo 'sem dados';

            $json_police = '';
            $json_hazard = '';
            $json_roadClosed = '';
            $json_jam = '';
        }
    ?>
@endsection

@section('scriptsPolice')
    <script>
        let array_police = <?php if(isset($data)){echo $json_police;} ?>
    </script>
@endsection
@section('scriptsHazard')
    <script>
        let array_hazard = <?php if(isset($data)){echo $json_hazard;} ?>
    </script>
@endsection
@section('scriptsRoadClosed')
    <script>
        let array_roadClosed = <?php if(isset($data)){echo $json_roadClosed;} ?>
    </script>
@endsection
@section('scriptsJam')
    <script>
        let array_jam = <?php if(isset($data)){echo $json_jam;} ?>
    </script>
@endsection

@section('scriptsMap')
    <script>

        var map = L.map('map').setView([-29.88048099596486, -51.17881447076798], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var roadClosedIcon = L.icon({
            iconUrl: '/img/bloqueio.png',
            iconSize:     [30, 30], // size of the icon
        });

        var marker = {};

        function onMapClick(e) {
            if(Object.keys(marker).length !== 0){
                marker.removeFrom(map);
                marker = {};
                marker = L.marker(e.latlng).addTo(map);

                console.log('lat:' + e.latlng.lat);
                console.log('lng:' + e.latlng.lat);

                var lat = document.getElementById('lat');
                lat.value = e.latlng.lat;

                var lng = document.getElementById('lng');
                lng.value = e.latlng.lng;
            } else {
                marker = L.marker(e.latlng).addTo(map);

                var lat = document.getElementById('lat');
                lat.value = e.latlng.lat;

                var lng = document.getElementById('lng');
                lng.value = e.latlng.lng;

                console.log('lat:' + e.latlng.lat);
                console.log('lng:' + e.latlng.lat);
            }
        }

        map.on('click', onMapClick);
    </script>
@endsection
