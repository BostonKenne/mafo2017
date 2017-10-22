var canvas  = document.querySelector('#canvas');
var context = canvas.getContext('2d');

var longueur = 200; // cote du triangle
var coords = [];
coords[0] = {x:40, y:240};
coords[1] = {x:coords[0].x+longueur, y:coords[0].y};
coords[2] = {x:(coords[0].x+coords[1].x)/2, y:coords[0].y-(longueur/2)*Math.sqrt(3)};

/* Triangle */
context.beginPath();
context.moveTo(coords[0].x, coords[0].y);
context.lineTo(coords[1].x, coords[1].y);
context.lineTo(coords[2].x, coords[2].y);
context.closePath();
context.stroke();
/* Composants */
var comps = ["Alumine", "Mauvais", "Oxyde"];
console.log(comps[0].length);
context.fillText(comps[0], coords[0].x-(comps[0].length*3), coords[0].y+10);/* decalage du texte en fonction du point */
context.fillText(comps[1], coords[1].x-(comps[1].length*3), coords[1].y+10)
context.fillText(comps[2], coords[2].x-(comps[2].length*3), coords[2].y-5)
/* et les echantillons */
var f = 100*Math.random();
var g = 50*Math.random();
var h = 100-f-g;

alert(f+" "+g+" "+h+" ");

var echans = [
	{a:50,b:20,c:30},
	{a:50,b:40,c:10},
	{a:20,b:50,c:30},
	{a:90,b:06,c:04},
	{a:10,b:60,c:30}
];

for (var i = echans.length - 1; i >= 0; i--) {
	tracerEchan(coords[0], coords[1], coords[2], echans[i]);
};




































function tracer(coord1, coord2){
	context.beginPath();
	context.moveTo(coord1.x, coord1.y);
	context.lineTo(coord2.x, coord2.y);
	context.closePath();
	context.stroke();
}
function distance(coord1, coord2){
	return Math.sqrt((coord2.x-coord1.x)*(coord2.x-coord1.x)+(coord2.y-coord1.y)*(coord2.y-coord1.y));
}
function tracerEchan(coord0, coord1, coord2, echan){
	var echan_pos = intersec(coord0, coord1, coord2, echan);
	context.save();
	context.beginPath();
	var coul = "rgb("+(echan.a*255/100)+", "+(echan.b*255/100)+", "+(echan.c*255/100)+")";
	context.fillStyle = coul;
	context.translate(echan_pos.x, echan_pos.y);
	context.arc(-1.5, 1.5, 3, -Math.PI, Math.PI);
	context.closePath();
	context.fill();
	context.restore();
}
function intersec(coord0, coord1, coord2, echan){
	/*
	vecteur alumine->mauvais
	*/
	var xv1 = coord1.x - coord0.x;
	var yv1 = coord1.y - coord0.y;
	xv1 *= (1-(echan.a/100));
	yv1 *= (1-(echan.a/100));
	xv1 += coord0.x;
	yv1 += coord0.y;
	/*
	vecteur alumine->oxyde
	*/
	var xv2 = coord2.x - coord0.x;
	var yv2 = coord2.y - coord0.y;
	xv2 *= (1-(echan.a/100));
	yv2 *= (1-(echan.a/100));
	xv2 += coord0.x;
	yv2 += coord0.y;
	/*
	vecteur oxyde->alumine
	*/
	var xv3 = coord0.x - coord2.x;
	var yv3 = coord0.y - coord2.y;
	xv3 *= (1-(echan.b/100));
	yv3 *= (1-(echan.b/100));
	xv3 += coord2.x;
	yv3 += coord2.y;
	/*
	vecteur oxyde->mauvais
	*/
	var xv4 = coord1.x - coord2.x;
	var yv4 = coord1.y - coord2.y;
	xv4 *= (1-(echan.b/100));
	yv4 *= (1-(echan.b/100));
	xv4 += coord2.x;
	yv4 += coord2.y;

	var a1 = (yv2 - yv1)/(xv2 - xv1);
	var a2 = (yv4 - yv3)/(xv4 - xv3);
	var b1 = yv1 - a1*xv1;
	var b2 = yv3 - a2*xv3;

	var x_fin = (b2 - b1)/(a1 - a2);
	var y_fin = (b2*a1 - b1*a2)/(a1 - a2);

	return {x:x_fin, y:y_fin};
}