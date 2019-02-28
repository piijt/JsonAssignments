'use strict'
let getJSONFile = function(e) {
    let ajax = Object.create(Ajax);
    ajax.init();
    ajax.getFile('wl.json');
    console.log(ajax);
}
let callBack = function(txt) {
    let myJson = JSON.parse(txt);
    
    }
}
let showStarter = function () {
    getJSONFile();
}
window.addEventListener('load', showStarter);
