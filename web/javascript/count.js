$(document).ready(function (){
	getTime();
});




function getTime() {
	now = new Date();
	fecha = new Date(2018,2,31);
	days = (fecha - now) / 1000 / 60 / 60 / 24;
	daysRound = Math.floor(days);
	hours = (fecha - now) / 1000 / 60 / 60 - (24 * daysRound);
	hoursRound = Math.floor(hours);
	minutes = (fecha - now) / 1000 /60 - (24 * 60 * daysRound) - (60 * hoursRound);
	minutesRound = Math.floor(minutes);
	seconds = (fecha - now) / 1000 - (24 * 60 * 60 * daysRound) - (60 * 60 * hoursRound) - (60 * minutesRound);
	secondsRound = Math.round(seconds);
	if (daysRound <= "-1") {
		//   IMPORTANTE  //
		//Si el conteo regresivo del script el valor de los días es mayor a -1 se para el script, 
		//ya que la fecha esperada se a cumplido, es necesaria este línea de código ya que si no se pone 
		//seguiria el conteo regresívo pero en valores negativos.
	}
	else{
		document.getElementById('dias').innerHTML =  daysRound < 10?  ('0' +daysRound) :daysRound;
		document.getElementById('horas').innerHTML = hoursRound<10? ('0' +hoursRound):hoursRound;
		document.getElementById('min').innerHTML = minutesRound<10? ('0'+minutesRound) : minutesRound;
		document.getElementById('seg').innerHTML = secondsRound<10? ('0'+secondsRound):secondsRound;
	}
	newtime = window.setTimeout("getTime();", 1000);
}