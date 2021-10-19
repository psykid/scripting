## Book My Show Parser
### what will this do
Based on the inputs, this script keeps on reloading the webpage until all the conditions specified were met and then plays an audio.<br />
The script's url is given such that it is available for any movie that is listed in the site. Better enable this script only when required.<br />
Else it will try to reload the page/play the music according to the inputs.<br />

### How to use it?
In the very first lines, the date, theatre, interval and the audio link should be updated according to the use case.
1) Date: a required field, indicates the date for which the movie tickets should be checked for.
2) Theatre: an optional field (i.e. can be simple quotes) indicating the theatre to be checked for.
3) Interval: a required field, indicates the time period (in sec) between consecutive page reloads.
4) Audio link: also required field, indicates the audio file to be played when the tickets are available for the given date and theatre.

### known issues:
- The device shouldnt go to sleep/locked state while running the script.
- Autoplay should be enabled in the bookmyshow website before using this.
- The browser tab should be left open for this extension to work.

#### Note: This script was tested on Firefox 91.1.0esr (64-bit) (grease monkey 4.11 Release)
