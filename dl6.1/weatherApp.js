let map;
let geoJSON;
let request;
let gettingData = false;
let openWeatherMapKey = "9edb73d5d23103305e740943d3262926"
function initialize() {
  let mapOptions = {
    zoom: 4,
    center: new google.maps.LatLng(50,-50)
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);
  // Add interaction listeners to make weather requests
  google.maps.event.addListener(map, 'idle', checkIfDataRequested);
  // Sets up and populates the info window with details
  map.data.addListener('click', function(event) {
    infowindow.setContent(
     "<img src=" + event.feature.getProperty("icon") + ">"
     + "<br /><strong>" + event.feature.getProperty("city") + "</strong>"
     + "<br />" + event.feature.getProperty("temperature") + "&deg;C"
     + "<br />" + event.feature.getProperty("weather")
     + "<br />" + 'Pressure: ' + event.feature.getProperty("pressure") + 'hPa'
     + "<br />" + 'Humidity: ' + event.feature.getProperty("humidity")
     + "<br />" + 'Wind Speed ' + event.feature.getProperty("windSpeed")
     // + "<br />" + 'Wind Direction ' + event.feature.getProperty("windDirection")
     // + "<br />" + 'Clouds ' + event.feature.getProperty("clouds")
     // + "<br />" + 'Country ' + event.feature.getProperty("country")
     );
    infowindow.setOptions({
        position:{
          lat: event.latLng.lat(),
          lng: event.latLng.lng()
        },
        pixelOffset: {
          width: 0,
          height: -15
        }
      });
    infowindow.open(map);
  });
}
let checkIfDataRequested = function() {
  // Stop extra requests being sent
  while (gettingData === true) {
    request.abort();
    gettingData = false;
  }
  getCoords();
};
// Get the coordinates from the Map bounds
let getCoords = function() {
  let bounds = map.getBounds();
  let NE = bounds.getNorthEast();
  let SW = bounds.getSouthWest();
  getWeather(NE.lat(), NE.lng(), SW.lat(), SW.lng());
};
// Make the weather request
let getWeather = function(northLat, eastLng, southLat, westLng) {
  gettingData = true;
  let requestString = "http://api.openweathermap.org/data/2.5/box/city?bbox="
                      + westLng + "," + northLat + "," //left top
                      + eastLng + "," + southLat + "," //right bottom
                      + map.getZoom()
                      + "&cluster=yes&format=json"
                      + "&APPID=" + openWeatherMapKey;
  request = new XMLHttpRequest();
  request.onload = proccessResults;
  request.open("get", requestString, true);
  request.send();
};
// Take the JSON results and proccess them
let proccessResults = function() {
  console.log(this);
  let results = JSON.parse(this.responseText);
  if (results.list.length > 0) {
      resetData();
      for (let i = 0; i < results.list.length; i++) {
        geoJSON.features.push(jsonToGeoJson(results.list[i]));
      }
      drawIcons(geoJSON);
  }
};
let infowindow = new google.maps.InfoWindow();
// For each result that comes back, convert the data to geoJSON
let jsonToGeoJson = function (weatherItem) {
  let feature = {
    type: "Feature",
    properties: {
      city: weatherItem.name,
      weather: weatherItem.weather[0].main,
      // cloud: weatherItem.clouds[0].main,
      // country: weatherItem.sys.country,
      temperature: weatherItem.main.temp,
      min: weatherItem.main.temp_min,
      max: weatherItem.main.temp_max,
      humidity: weatherItem.main.humidity,
      pressure: weatherItem.main.pressure,
      windSpeed: weatherItem.wind.speed,
      windDegrees: weatherItem.wind.deg,
      windGust: weatherItem.wind.gust,
      icon: "http://openweathermap.org/img/w/"
            + weatherItem.weather[0].icon  + ".png",
      coordinates: [weatherItem.coord.Lon, weatherItem.coord.Lat]
    },
    geometry: {
      type: "Point",
      coordinates: [weatherItem.coord.Lon, weatherItem.coord.Lat]
    }
  };
  // Set the custom marker icon
  map.data.setStyle(function(feature) {
    return {
      icon: {
        url: feature.getProperty('icon'),
        anchor: new google.maps.Point(25, 25)
      }
    };
  });
  // returns object
  return feature;
};
// Add the markers to the map
let drawIcons = function (weather) {
   map.data.addGeoJson(geoJSON);
   // Set the flag to finished
   gettingData = false;
};
// Clear data layer and geoJSON
let resetData = function () {
  geoJSON = {
    type: "FeatureCollection",
    features: []
  };
  map.data.forEach(function(feature) {
    map.data.remove(feature);
  });
};
google.maps.event.addDomListener(window, 'load', initialize);
