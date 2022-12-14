var map = L.map('map').setView([23.788212, 90.399971], 14);

    const key = 'kyStKR2HkmDzAQngf5FW';
    var bright = L.tileLayer(`https://api.maptiler.com/maps/bright-v2/{z}/{x}/{y}.png?key=kyStKR2HkmDzAQngf5FW`,{ //style URL
        tileSize: 512,
        zoomOffset: -1,
        minZoom: 1,
        attribution: "\u003ca href=\"https://www.maptiler.com/copyright/\" target=\"_blank\"\u003e\u0026copy; MapTiler\u003c/a\u003e \u003ca href=\"https://www.openstreetmap.org/copyright\" target=\"_blank\"\u003e\u0026copy; OpenStreetMap contributors\u003c/a\u003e",
        crossOrigin: true
    });

    /*L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'}).addTo(map);
    */

    var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {maxNativeZoom: 19, 
    maxZoom: 20 }).addTo(map);
    
    var CyclOSM = L.tileLayer('https://{s}.tile-cyclosm.openstreetmap.fr/cyclosm/{z}/{x}/{y}.png', {
	maxZoom: 20});

    var Esri_WorldImagery = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
	attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
    });


    var popup = L.popup();
    function onMapClick(e) {
        document.getElementById("longitude").value = e.latlng.lng;
        document.getElementById("latitude").value = e.latlng.lat;
    }
     map.on('click', onMapClick);

    navigator.geolocation.watchPosition(success, error);

    var marker, circle;


   

    function success(pos){
        let lat, lng;
        lat = pos.coords.latitude;
        console.log(lat);
        
        lng = pos.coords.longitude;
        console.log(lng);
        const accuracy = pos.coords.accuracy;

        if(marker){
            map.removeLayer(marker);
            map.removeLayer(circle);
        }
        marker = L.marker([lat, lng]).addTo(map);
        //circle = L.circle([lat, lng], {radius : accuracy}).addTo(map);

        //map.fitBounds(circle.getBounds())
    }

    function error(err){
        if(err.code === 1){
            alert("please allow location access");
        }
        else{
            alert("can't get final location");
        }


    }

    

    
    function style(feature) {
        return {
            fillColor: 'green',
            weight: 2,
            opacity: 100,
            color: 'black',
            dashArray: '3',
            fillOpacity: 0
        };
    }
    function style2(feature) {
        return {
            fillColor: 'red',
            weight: 1,
            opacity: 100,
            color: 'black',
            dashArray: '3',
            fillOpacity: 0.9
        };
    }
    
    
    L.geoJSON(dhakaCityCorporation, {style:style}).addTo(map);
            
        
    // function myFunction() {
        
    //     L.geoJSON(crime, myLayerOptions, markers).addTo(map);
                
    // }


    var markers = L.markerClusterGroup();
            
    function createCustomIcon (feature, latlng) {
        let myIcon = L.icon({
        iconUrl: 'images/crime.png',
        shadowUrl: 'images/leaf-shadow.png',
        iconSize:     [35, 40], // width and height of the image in pixels
        shadowSize:   [35, 20], // width, height of optional shadow image
        iconAnchor:   [12, 12], // point of the icon which will correspond to marker's location
        shadowAnchor: [12, 6],  // anchor point of the shadow. should be offset
        popupAnchor:  [0, 0] // point from which the popup should open relative to the iconAnchor
        })
        return markers.addLayer(L.marker(latlng, { icon: myIcon }))
    }

    
    let myLayerOptions = {
        pointToLayer: createCustomIcon
    }
    L.geoJSON(crime, myLayerOptions, markers).addTo(map);

    // create the GeoJSON layer
    //var crimes = L.geoJSON(crime, myLayerOptions, markers);      
    //map.addLayer(markers);

    let crimes;
    function showArea() {
        //L.geoJSON(uttaraSector3, {style:style}).addTo(map);
        L.geoJSON(dhanmondi,{style:style2}).addTo(map);
        L.geoJSON(bashundhara, {style:style2}).addTo(map);
        L.geoJSON(kalabagan, {style:style2}).addTo(map);
        L.geoJSON(purbachal, {style:style2}).addTo(map);
        L.geoJSON(lalmatia, {style:style2}).addTo(map);
        L.geoJSON(shyamoli, {style:style2}).addTo(map);
        L.geoJSON(jigatola, {style:style2}).addTo(map);
        L.geoJSON(sherEbanglaNagar, {style:style2}).addTo(map);
        L.geoJSON(monipuripara, {style:style2}).addTo(map);
        L.geoJSON(motijheel, {style:style2}).addTo(map);
        L.geoJSON(uttara, {style:style2}).addTo(map);
        L.geoJSON(ramna, {style:style2}).addTo(map);
    }

    var baseMaps = {
    "OpenStreetMap": osm,
    "CycleOsm":CyclOSM,
    "satelite": Esri_WorldImagery,
    "Bright":bright
    //"crime": crimes
    
    };

    

    var layerControl = L.control.layers(baseMaps).addTo(map);





    function generateList() {
        const ul = document.querySelector('.list');
        crimeList.forEach((crime) => {
            const li = document.createElement('li');
            const div = document.createElement('div');
            const a = document.createElement('a');
            const p = document.createElement('p');
            a.addEventListener('click', () => {
                flyToStore(crime);
            });
            div.classList.add('crime');
            a.innerText = crime.properties.name;
            a.href = '#';
            p.innerText = crime.properties.address;

            div.appendChild(a);
            div.appendChild(p);
            li.appendChild(div);
            ul.appendChild(li);
        });
    }

    generateList();


    function flyToStore(c) {
        const lat = c.geometry.coordinates[1];
        const lng = c.geometry.coordinates[0];
        map.flyTo([lat, lng], 18, {
            duration: 2
        });
    }