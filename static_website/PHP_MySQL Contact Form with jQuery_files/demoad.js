var filename='http://tympanus.net/codrops/adpacks/demoad.css?' + new Date().getTime();		
var fileref=document.createElement("link");
fileref.setAttribute("rel", "stylesheet");
fileref.setAttribute("type", "text/css");
fileref.setAttribute("href", filename);
document.getElementsByTagName("head")[0].appendChild(fileref);

var demoad = document.createElement('div');
demoad.id = 'cdawrap';
demoad.innerHTML = '<div id="bsap_402" class="bsaPROrocks" data-serve="CKSDE"></div><span id="cda-remove"></span>';
document.getElementsByTagName('body')[0].appendChild(demoad);

document.getElementById('cda-remove').addEventListener('click',function(e){
	demoad.style.display = 'none';
	e.preventDefault();
});

var bsa = document.createElement('script');
bsa.type = 'text/javascript';
bsa.async = true;
bsa.src = 'http://cdn.buysellads.com/ac/pro.js';
document.getElementsByTagName('head')[0].appendChild(bsa);
/*
var bsa_tmp = document.createElement('script');
bsa_tmp.type = 'text/javascript';
bsa_tmp.async = true;
bsa_tmp.id = "_fusionads_js";
bsa_tmp.src = 'http://adn.fusionads.net/api/1.0/ad.js?zoneid=184&rand=682';
document.getElementsByTagName('head')[0].appendChild(bsa_tmp);*/