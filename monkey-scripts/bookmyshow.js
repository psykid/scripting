// ==UserScript==
// @name         book my show
// @namespace    http://tampermonkey.net/
// @version      0.2
// @description  play music when tickets are available
// @author       preetam
// @match        https://in.bookmyshow.com/buytickets/*
// @grant        none
// ==/UserScript==

//date = simply the day,
//interval = number of min b/w each check (in sec, default = 5min),
//theatre = name of the theatre (should be exact)
//date and interval are required fields, theatre is optional
var date = 29, interval = 5*60, theatre="INOX: Maheshwari Parmeshwari Mall, Kachiguda";
var audioLink = 'http://m63.telugu1.download/tere63xrc4wzse/Antasthulu%20-%20%281965%29/%5BiSongs.info%5D%20Ninu%20Veedani%20Needanu%20Nene.mp3';
window.onload = readDocument;

(function() {
    'use strict';
    // Your code here...
})();


function readDocument() {
    var x = document.getElementsByClassName("date-container");
    var today = new Date();
    console.log(today);
    var curDate = today.getDate();
    if (curDate > date) {
        window.alert("Sorry to break this to you but we cant go back in time\n. Your ship has already sailed");
        return;
    }
    var dateSearchString = "<div>"+date+"<br>";
    if (x[0].innerHTML.search(dateSearchString)!=-1) {
        console.log("found date " + date);
        aVN_details.forEach(searchForTheatre);
    } else {
        var pos = -1;
        if (curDate == date)
            pos = x[0].innerHTML.search("TODAY");
        else if (curDate == date-1)
            pos = x[0].innerHTML.search("TOM");
        if (pos != -1) {
            console.log("we found either today or tomorrow, checking for theatre");
            aVN_details.forEach(searchForTheatre);
        } else {
            console.log("Either bookings for your movie is't open yet or this movie is not gonna be there till then.");
            stateChange(-1);
        }
    }
}

function playSound() {
    var audio = new Audio(audioLink);
    audio.play();
}
function searchForTheatre(item) {
    console.log("looking for theatre " + item.VenueName);
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