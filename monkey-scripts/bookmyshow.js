// ==UserScript==
// @name         book my show
// @namespace    http://tampermonkey.net/
// @version      0.3
// @description  play music when tickets are available
// @author       preetam
// @match        https://in.bookmyshow.com/buytickets/*
// @grant        none
// ==/UserScript==

//date = simply the day,
//interval = number of min b/w each check (in sec, default = 5min),
//theatres = names of the theatre (should be exact and the numbers can be anything.)
//date and interval are required fields, theatres is optional and can be left empty so that sound will be played even if one theatre is present for that movie.
var date = "19", interval = 5*60;
var theatres = {};
theatres['1, Newfangled Miniplex: Mondeal Retail Park'] = 1;
var audioLink = 'https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3';
// window.onload = readDocument;

(function() {
    'use strict';
    readDocument();
  	
})();


function readDocument() {
  	var today = new Date();
  	console.log("checked on:" + today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds());
    var x = document.getElementsByClassName("dates-wrapper");
    var curDate = today.getDate();
    if (curDate > date) {
        window.alert("Sorry to break this to you but we cant go back in time\n. Your ship has already sailed");
        return;
    }
  	
	var datesAvailable = x[0].getElementsByClassName("date-numeric");
	var found = false;
	for (let i = 0; i < datesAvailable.length; i++) {
		var currDate = datesAvailable[i].innerHTML.trim();
		if (currDate === date) {
			found = true;
		}
	}

	if (found){
    if (Object.keys(theatres).length === 0) {
    	playSound();
      	return;
    }
		var availableTheatresList = document.getElementsByClassName("__venue-name");
		searchForTheatre(availableTheatresList);
	} else {
		console.log("Either bookings for your movie is't open yet or this movie is not gonna be there till then.");
        stateChange(-1);
	}
}

function playSound() {
  	console.log("playing the song");
    var audio = new Audio(audioLink);
    audio.play();
}

function searchForTheatre(availableTheatresList) {
    console.log("what we have: " + availableTheatresList.length);
    console.log("what we want: " + theatres);
  	for (let i = 0; i < availableTheatresList.length; i++) {
    		if (theatres.hasOwnProperty(availableTheatresList[i].text.trim())) {
            console.log("we found it! " + availableTheatresList[i]);
            playSound();
        }
    }
  	stateChange(-1);
}

function stateChange(newState) {
    setTimeout(function () {
        if (newState == -1) {
            location.reload(true);
        }
    }, 1000 * interval);
}
