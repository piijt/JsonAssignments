'use strict'
let getJSONFile = function(e) {
    let ajax = Object.create(Ajax);
    ajax.init();
    ajax.getFile('colors.json');
    console.log(ajax);
}
let callBack = function(txt) {
    let myJson = JSON.parse(txt);
    var cp = $('colors');
    for (var i = 0; i < myJson.colors.length; i++) {
      let sc = document.createElement('div');
      sc.setAttribute('style', 'background-color: ' + myJson.colors[i].code.hex);
      var c = document.createTextNode(myJson.colors[i].code.hex);
      var t = document.createTextNode(myJson.colors[i].color);
      var r = document.createTextNode(myJson.colors[i].rgba);
      sc.appendChild(c);
      sc.appendChild(t);
      cp.appendChild(sc);
    }
}
let showStarter = function () {
    getJSONFile();
}
window.addEventListener('load', showStarter);
