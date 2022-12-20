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
            shadowUrl:'images/leaf-shadow.png',
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
    var neg = {
        "type": "Feature",
        "properties": {},
        "geometry": {
            "coordinates": [
            28.620363364135216,
            7.932471534718275
            ],
        "type": "Point"
        }
    }
    var crime = {
        "type": "FeatureCollection",
        "features": []
    }
    for(var i = 0;i<obj.length;i++){
        crime.features.push(
            {
                "type": "Feature",
                "properties": {},
                "geometry": {
                  "coordinates": [
                    obj[i].longitude,
                    obj[i].latitude
                  ],
                  "type": "Point"
                }    
            }
        );
    }
    L.geoJSON(crime, myLayerOptions, markers);

    // create the GeoJSON layer      
    map.addLayer(markers);

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



 // const li = document.createElement('li');
    // const div = document.createElement('div');
    // const a = document.createElement('a');
    // const p = document.createElement('p');
    // a.addEventListener('click', () => {
    //     flyToStore(crime);
    // });
    // div.classList.add('crime');
    // a.innerText = crime.crimeTitle;
    // a.href = '#';
    // p.innerText = crime.crimeDescription;
    // div.appendChild(a);
    // div.appendChild(p);
    // li.appendChild(div);
    // ul.appendChild(li);

    function generateList() {
        const ul = document.querySelector('.list');
        obj.forEach((crime) => {
            const li = document.createElement('li');
            const div = document.createElement('div');
            const a = document.createElement('a');
            const p = document.createElement('p');
            a.addEventListener('click', () => {
                flyToStore(crime);
            });
            const timeofreport = document.createElement('p');
            div.classList.add('crime');
            a.innerText = crime.crimeTitle;
            a.href = '#';
            p.innerText = crime.crimeDescription;
            const myArray = crime.time.split(" ");
            timeofreport.innerHTML = "<strong>Posted at Date</strong>: "+"<i>"+myArray[0]+"</i>"+"</strong>"+",<strong>Time: <i></strong>"+myArray[1]+"</i>";
            div.appendChild(a);
            div.appendChild(timeofreport);
            div.appendChild(p);
            li.appendChild(div);
            ul.appendChild(li);
        });
    }
//header child-> img
//header child-> div1
//div1 child -> h3
//div1 child -> h4
//div2 child-> p
//div2 child span
//div2 child 
//     <header>
//   <img src="https://freecodecamp.s3.amazonaws.com/quincy-twitter-photo.jpg" alt="Quincy Larson's profile picture" class="profile-thumbnail">
//   <div class="profile-name">
//     <h3>Quincy Larson</h3>
//     <h4>@ossia</h4>
//   </div>
//   <div class="follow-btn">
//     <button>Follow</button>
//   </div>
// </header>
// <div id="inner">
//   <p>I meet so many people who are in search of that one trick that will help them work smart. Even if you work smart, you still have to work hard.</p>
//   <span class="date">1:32 PM - 12 Jan 2018</span>
//   <hr>
// </div>
// <footer>
//   <div class="stats">
//     <div class="Retweets">
//       <strong>107</strong> Retweets
//     </div>
//     <div class="likes">
//       <strong>431</strong> Likes
//     </div>
//   </div>
//   <div class="cta">
//     <button class="share-btn">Share</button>
//     <button class="retweet-btn">Retweet</button>
//     <button class="like-btn">Like</button>
//   </div>
// </footer>

    generateList();


    function flyToStore(c) {
        const lat = c.latitude;
        const lng = c.longitude;
        map.flyTo([lat, lng], 18, {
            duration: 2
        });
    }


    //var popup = L.popup();
    
    function onMapClick(e) {
        document.getElementById("longitude").value = e.latlng.lng;
        document.getElementById("latitude").value = e.latlng.lat;
    }
    map.on('click', onMapClick);