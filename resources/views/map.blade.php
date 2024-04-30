@extends('layouts.app')

@section('content')
    <div id="map" class="border-8 border-blue-950 rounded-lg shadow-lg"></div>
@endsection

@section('alert')
    <?php
        if(isset($data)){
            
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

            // JSON
            $json_police = json_encode($police);
            $json_hazard = json_encode($hazard);
            $json_roadClosed = json_encode($roadClosed);
            //dd($json_roadClosed);

        } else {
            echo 'sem dados';
        }
    ?>
@endsection

@section('scripts')
    <script>

        let array_police = <?php echo $json_police; ?>

        var map = L.map('map').setView([-29.88048099596486, -51.17881447076798], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var roadClosedIcon = L.icon({
            iconUrl: '/img/bloqueio.png',
            iconSize:     [30, 30], // size of the icon
        });

        L.marker([-29.8812856688754, -51.17714881896973], {icon: roadClosedIcon}).addTo(map);


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
