Book My Show:<br />
what will this do?<br />
Based on the inputs, this script keeps on reloading the webpage until all the conditions specified were met and then plays an audio.<br />
The script's url is given such that it is available for any movie that is listed in the site. Better enable this script only when required.<br />
Else it will try to reload the page/play the music according to the inputs.<br />
<br />
How to use it?<br />
in the very first lines, the date, theatre, interval and the audio link should be updated according to the use case.<br />
	Date: a required field, indicates the date for which the movie tickets should be checked for.<br />
	Theatre: an optional field (i.e. can be simple quotes) indicating the theatre to be checked for.<br />
	Interval: a required field, indicates the time period (in sec) between consecutive page reloads.<br />
	Audio link: also required field, indicates the audio file to be played when the tickets are available for the given date and theatre.<br />
<br />
known issues:<br />
The device shouldnt go to sleep/locked state while running the script.
<br />
I am working on a way to get notifications to mobile when the tickets are available. But probably the user may need to install an app for it.<br />
<br />
Note: This script was tested on chrome  57.0.2987.133 (tamper monkey 4.2.7) and firefox 45.8.0 (grease monkey 3.1.0)<br />
