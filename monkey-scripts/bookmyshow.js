// ==UserScript==
// @name         book my show
// @namespace    http://tampermonkey.net/
// @version      0.1
// @description  play music when tickets are available
// @author       preetam
// @match        https://in.bookmyshow.com/buytickets/*
// @grant        none
// ==/UserScript==

//date simply the day, interval = number of min b/w each check (in sec, default = 5min), theatre = name of the theatre
//date and interval should definitely be mentioned. theatre is optional
var date = 22, interval = 5*60, theatre="";
var audioLink = 'http://m63.telugu1.download/tere63xrc4wzse/Antasthulu%20-%20%281965%29/%5BiSongs.info%5D%20Ninu%20Veedani%20Needanu%20Nene.mp3';
window.onload = readDocument;

(function() {
    'use strict';
    // Your code here...
})();

function readDocument() {
    var x = document.getElementsByClassName("date-container");
    var dateSearchString = "<div>"+date+"<br>";
    if (x[0].innerHTML.search(dateSearchString)!=-1) {
        aVN_details.forEach(searchForTheatre);
    } else {
        var pos = x[0].innerHTML.search("TODAY");
        if (pos == -1) {
            pos = x[0].innerHTML.search("TOM");
        }
        if (pos != -1) {
            var txt = x[0].textContent;
            //window.alert(typeof txt);
            var result = splice(txt, pos, 0, "at "+ new Date());
            x[0].innerHTML = result;
        }
       stateChange(-1);
    }
}

function playSound() {
    var audio = new Audio(audioLink);
    audio.play();
}
function searchForTheatre(item) {
    if(item.VenueName.search(theatre) !=-1 || theatre==="") {
        playSound();
    } else {
        stateChange(-1);
    }
}

function splice(txt, idx, rem, str) {
    return txt.slice(0, idx) + str + txt.slice(idx + Math.abs(rem));
}

function stateChange(newState) {
    setTimeout(function () {
        if (newState == -1) {
            location.reload(true);
        }
    }, 1000 * interval);
}