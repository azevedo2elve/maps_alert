@extends('layouts.app')

@section('content')
    <div id="map" class="border-8 border-blue-950 rounded-lg shadow-lg"></div>
@endsection

@section('alert')
    <?php
        if(isset($data)){
            var_dump($data);
        } else {
            echo 'sem dados';
        }
    ?>
@endsection

@section('scripts')
    <script>

        var map = L.map('map').setView([-29.88048099596486, -51.17881447076798], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

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

        var marker = L.marker([-29.88098798716813, -51.17667675018311]).addTo(map);

        // norte
        var marker = L.marker([-29.836, -51.176]).addTo(map);
        // sul
        var marker = L.marker([-29.925, -51.176]).addTo(map);
        // leste
        var marker = L.marker([-29.88, -51.124]).addTo(map);
        // oeste
        var marker = L.marker([-29.88, -51.228]).addTo(map);

        var circle = L.circle([-29.88098798716813, -51.17667675018311], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 5000
        }).addTo(map);

        map.on('click', onMapClick);
    </script>
@endsection
