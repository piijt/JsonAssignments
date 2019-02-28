
function dc(latitude1, longitude1, latitude2, longitude2) {
    var R = 6371; // radius of earth in km
    var dLat = deg2rad(latitude2-latitude1);
    var dLon = deg2rad(longitude2-longitude1);
    var q =
      Math.sin(dLat/2) * Math.sin(dLat/2) +
      Math.cos(deg2rad(latitude1)) * Math.cos(deg2rad(latitude2)) *
      Math.sin(dLon/2) * Math.sin(dLon/2);
    var c = 2 * Math.atan2(Math.sqrt(q), Math.sqrt(1-q));
    var d = R * 2 * c //distance in km
    return d;
}

function deg2rad(deg) {
  return deg * (Math.PI/180)
}
console.log('there is ' + dc(61.6487504,30.5926449,49.936089,17.9738035).toFixed(1) + ' km from Sortavala to Velké Hoštice"' ); // toFixed specifies decimals only 1 decimal
console.log('there is ' + dc(13.45529,43.94704,-10.7540132,122.9104995).toFixed(1) + ' km from Yufrus to Oelaba"' ); // toFixed specifies decimals only 1 decimal


var xhttp = new XMLHttpRequest(); // XMLHttpRequest object into variable
xhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) { // readystate = 4 response has been captured - status 200 everything is good
    var response = JSON.parse(xhttp.responseText);
    console.log(response.data);
    var data = response.data;
    var out = '';
    for(var i = 0; i < data.length; i++) {


      out += '<li>'+ '#  '  +data[i].id + '</li>';

      out += '<li>'+ 'City  '  +data[i].city + '</li>';

      out += '<li>' + 'latitude ' + data[i].lat + '</li>';

      out += '<li>' + 'Longitude '  + data[i].lon + '</li>';

      out += '<li>'+ 'Country '  +data[i].country + '</li>' + '</br>';
    }
    document.getElementById('geo').innerHTML = out;
  }
};
xhttp.open("GET", "geo.json", true);
xhttp.send();
