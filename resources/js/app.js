import './bootstrap';

if (typeof array_police != 'undefined') {
    // police
    var policeIcon = L.icon({
        iconUrl: '/img/policia.png',
        iconSize:     [30, 30], // size of the icon
    });

    for (var i = 0; i < array_police.length; i++){
        L.marker([array_police[i]['location']['y'], array_police[i]['location']['x']], {icon: policeIcon}).addTo(map);
    }
}

if (typeof array_hazard != 'undefined') {
    // hazard
    var hazardIcon = L.icon({
        iconUrl: '/img/perigo.png',
        iconSize:     [30, 30], // size of the icon
    });

    for (var i = 0; i < array_hazard.length; i++){
        L.marker([array_hazard[i]['location']['y'], array_hazard[i]['location']['x']], {icon: hazardIcon}).addTo(map);
    }
}

if (typeof array_roadClosed != 'undefined') {
    // hazard
    var roadClosedIcon = L.icon({
        iconUrl: '/img/bloqueio.png',
        iconSize:     [30, 30], // size of the icon
    });

    for (var i = 0; i < array_roadClosed.length; i++){
        L.marker([array_roadClosed[i]['location']['y'], array_roadClosed[i]['location']['x']], {icon: roadClosedIcon}).addTo(map);
    }
}

if (typeof array_jam != 'undefined') {
    // hazard
    var jamIcon = L.icon({
        iconUrl: '/img/trafego.png',
        iconSize:     [30, 30], // size of the icon
    });

    for (var i = 0; i < array_jam.length; i++){
        L.marker([array_jam[i]['location']['y'], array_jam[i]['location']['x']], {icon: jamIcon}).addTo(map);
    }
}
