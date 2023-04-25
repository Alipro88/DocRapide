var map = L.map('map').setView([51.505, -0.09], 13);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
maxZoom: 19,
attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

var marker = L.marker([0, 0]).addTo(map);
marker.setLatLng([33.7013667,-7.3874631]);
map.panTo([33.7013667,-7.3874631]);


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

$.ajax({
        url: '/ajax/apiAds',
        type: 'GET',
        dataType: 'json',
        async: true,
            success: function (data) {
                for(i = 0; i < data.length; i++) {
                latitude.push(data[i].lat);
                longitude.push(data[i].longi);
                }
                // Use the latitude and longitude arrays in your code here
                console.log("Latitude:", latitude, "Longitude:", longitude);
                
                },
            error: function (xhr, textStatus, errorThrown) {
                alert('Ajax request failed.');
            }
            
          });



for (var i = 0; i < latitude.length; i++) {
    console.log(latitude[i]);
    var marker_1 = L.marker([parseFloat(Latitude[i]), parseFloat(Longitude[i])]).addTo(map);
  }


  


