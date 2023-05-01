

var map = L.map('map').setView([51.505, -0.09], 12);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

// var marker = L.marker([0, 0]).addTo(map);
// marker.setLatLng([33.7013667,-7.3874631]);
// map.panTo([33.7013667,-7.3874631]);

// marker.bindPopup("<b>Location</b><br>Dr BENAMOUR ZAHRA");


/******************************************** test */
// var markerCoords = [
//     [33.7013667, -7.3874631],
//     [33.689633, -7.389406],
//     [33.675662, -7.404136]
// ];

// Loop through the array and create a marker for each set of coordinates




//la methode fetsh 

// var m =  L.marker(lat,longi).addTo(map);

// fetsh api method 1
// let api = "http://127.0.0.1:8000/api/ads";

// let latitude = []; // An empty array
// let longitude = []; // An empty array


// fetch(api)
//   .then(response => response.json())
//   .then(data => {
//     latitude.push(data.lat);
//     longitude.push(data.longi);
//     // Use the latitude and longitude arrays in your code here
//     console.log(`Latitude: ${latitude}, Longitude: ${longitude}`);
    
//   })
//   .catch(error => console.error(error));

//     var marker = L.marker(latitude[1],longitude[1]).addTo(map);
// var circle = L.circle([51.508, -0.11], {
//     color: 'red',
//     fillColor: '#f03',
//     fillOpacity: 0.5,
//     radius: 500
//      }).addTo(map);
// marker.bindPopup("<b>Location</b><br>Dr BENAMOUR ZAHRA").openPopup();
// circle.bindPopup("I am a circle.");
// polygon.bindPopup("I am a polygon.");   

// change the latitude variable to a number


/******************************************** test */
var latitude = []; // An empty array
var longitude = []; // An empty array
var Slug = [];
var Adresse = [];


$.ajax({
        url: '/ajax-ads',
        type: 'GET',
        dataType: 'json',
        async: true,
            success: function (data) {
                for(i = 0; i < data.length; i++) {
                latitude.push(data[i].lat);
                longitude.push(data[i].longi);
                Slug.push(data[i].slug);
                Adresse.push(data[i].adresse);
                }
                console.log(data);
                // Use the latitude and longitude arrays in your code here
                for (var i = 0; i < latitude.length; i++) {
                    console.log("latitude " +latitude[i] , "latitude" +longitude[i]);
                    var marker = L.marker([0, 0]).addTo(map);
                        marker.setLatLng([latitude[i],longitude[i]]);
                        marker.bindPopup(Slug[i] +'<br>' +'<img src="../images/avatar/avatar-bg.png" width="100" height="100" >'+Adresse[i] + (i + 1));
                        map.panTo([latitude[i],longitude[i]]);
                  }
                },
            error: function (xhr, textStatus, errorThrown) {
                alert('Ajax request failed.');
            }
            
          });





                 



// for (var i = 0; i < latitude.length; i++) {
//     console.log(latitude[i]);
//     var marker_1 = L.marker([parseFloat(Latitude[i]), parseFloat(Longitude[i])]).addTo(map);
//   }


// function onMapClick(e) {

//     if (e.latlng.lat.toFixed(2) === 33.59 && e.latlng.lng.toFixed(2) === -7.61){
//     alert("You clicked the map at " + e.latlng);
//     }  
// }

// map.on('click', onMapClick);

// var popup = L.popup();

// function onMapClick(e) {

//     console.log("pop" , e.latlng.lat.toFixed(6) , e.latlng.lng.toFixed(6));

    
//     // if ( e.latlng.lat.toFixed(2) === 33.53 && e.latlng.lng.toFixed(2) ===  -7.62  )
//     // {
//     for ( var i = 0; i < latitude.length; i++)  {  
//     popup
//         .setLatLng(e.latlng)
//         .setContent( Slug[i] + '<img src="../images/avatar/avatar-bg.png" width="100" height="100" >'+Adresse[i])
//         .openOn(map)
    
//     } 

    
// }

// map.on('click', onMapClick);


// var marker = L.marker([0, 0]).addTo(map);
// marker.setLatLng([33.7013667,-7.3874631]);
// map.panTo([33.7013667,-7.3874631]);

// marker.bindPopup(Slug[0]).openPopup();




 
  


