function disabledDisplaySave(id) {
	disableDisplay(id);
	SetCookie(id,'cacher',null,"/")
}

function enableDisplaySave(id) {
	enableDisplay(id);
	SetCookie(id,'voir',null,"/")
}

function inverseDisplaySave(id) {
	element=getElement(id);
	
	if (element.style.display == 'none') {
		enableDisplaySave(id);
	}
	else {
		disabledDisplaySave(id);
	}
}

function affDisplaySave(id) {
	element=getElement(id);
	// si visible
	valCookies=GetCookie(id);
	// alert(id +" : "+valCookies);
	if (valCookies=="cacher") {
		disableDisplay(id);
	}
	else if (valCookies=="voir") {
		enableDisplay(id);
	}
	else {
		disableDisplay(id);
	}
}

function getElement(id) {
	if (document.layers) {
		return document[id]
	}
	else if (document.getElementById){
		return document.getElementById(id);
	}
	else if (document.all) {
		return document.all[id];
	}
	else {
		alert("Impossible de trouver "+id);
	}
}


function inverseDisplay(id) {
		element=getElement(id);
// alert(id);
		if (element.style.display == 'none') {
			enableDisplay(id);
		}
		else {
			disableDisplay(id);
		}
}

function enableDisplay(id) {
	// element.style.position='relative';
	element=getElement(id);
	if (getElement('icone'+id)) {
		getElement('icone'+id).src="Images/iconeMoins.png";
	}
	if (element) {
		element.style.display='';	
	}
}

function disableDisplay(id) {
	element=getElement(id);
	// element.style.position='absolute';
	if (getElement('icone'+id)) {
		getElement('icone'+id).src="Images/iconePlus.png";
	}
	if (element) {
		element.style.display='none';
	}
}


// Fonction normal pour afficher et
// effacer un "layer" DHTML
function Aff_layer(id) {
// window.alert(id);
	if (document.layers)
  	  document[id].visibility = 'show';
    else if (document.all)
  	   document.all[id].style.visibility = 'visible';
     else if (document.getElementById && document.getElementById(id))
    	document.getElementById(id).style.visibility = 'visible';
}

function ChangeSize(id, width, height) {
	element = getElement(id);
	element.width = width != "" ? width : document[id].width;
  	element.height = height != "" ? height : document[id].height;
	
/*
 * if (document.layers) { document[id].width = width != "" ? width :
 * document[id].width; document[id].height = height != "" ? height :
 * document[id].height; } else if (document.all) { document.all[id].width =
 * width != "" ? width : document[id].width; document.all[id].height = height != "" ?
 * height : document[id].height; } else if (document.getElementById) {
 * document.getElementById(id).width = width != "" ? width : document[id].width;
 * document.getElementById(id).height = height != "" ? height :
 * document[id].height; }
 */
}

// cache le layer id
function Cache_layer(id) {
	if (document.layers)
    document[id].visibility = 'hide';
  else if (document.all)
  	document.all[id].style.visibility = 'hidden';
  else if (document.getElementById && document.getElementById(id))
		document.getElementById(id).style.visibility = 'hidden';
}

// cache ou affiche le menu de gauche
function inverseLayer(id) {
    var cache = true;
	if (document.layers) {
        if (document[id].visibility == 'hide') {
            cache = false;
        }
    }
    else if (document.all) {
        if (document.all[id].style.visibility == 'hidden') {
            cache = false;
        }
    }
    else if (document.getElementById) {
        if (document.getElementById(id).style.visibility == 'hidden') {
            cache = false;
        }
    }

    if (cache) {
        Cache_layer(id);
    }
    else {
        Aff_layer(id);    
    }
}

var zoomOK=false;
function zoomImage(image) {
		repr="";
		repr+="<img src="+image+" />";
		getElement("zoomImage").innerHTML = repr;
		Aff_layer("zoomImage");
		zoomOK=true;
}
function unZoomImage() {
		repr+="";
		getElement("zoomImage").innerHTML = repr;
		Cache_layer("zoomImage");
		zoomOK=false;
}

function inverseZoomImage(image) {
	if (zoomOK)  {
		unZoomImage();
	}
	else {
		zoomImage(image);
	}
}

/**
 * @author Patrick Poulain
 * @see http://petitchevalroux.net
 * @licence GPL
 */
function getPosition(element)
{
    var left = 0;
    var top = 0;
    /* On r�cup�re l'�l�ment */
    var e = document.getElementById(element);
    /* Tant que l'on a un �l�ment parent */
    while (e.offsetParent != undefined && e.offsetParent != null)
    {
        /* On ajoute la position de l'�l�ment parent */
        left += e.offsetLeft + (e.clientLeft != null ? e.clientLeft : 0);
        top += e.offsetTop + (e.clientTop != null ? e.clientTop : 0);
        e = e.offsetParent;
    }
    return new Array(left,top);
}
function resizePopUp(monImage, monTitre)
    {
	w = window.open(monImage,'chargement','width=100,height=100,left=100,top=100');
	w.document.write( "<html><head><title>"+monTitre+"</title>\n" );
    w.document.write( "<LINK HREF='style.css' REL='stylesheet' TYPE='text/css'>");
    w.document.write( "<script language='JavaScript'>\n");
	w.document.write( "IE5=NN4=NN6=false;\n");
	w.document.write( "if(document.all)IE5=true;\n");
	w.document.write( "else if(document.getElementById)NN6=true;\n");
	w.document.write( "else if(document.layers)NN4=true;\n");
	w.document.write( "function autoSize() {\n");
	w.document.write( "if(IE5) self.resizeTo(document.images[0].width+10,document.images[0].height+31);\n");
	w.document.write( "else if(NN6) self.sizeToContent();\n");
	w.document.write( "else window.resizeTo(document.images[0].width,document.images[0].height+50);\n");
	w.document.write( "self.focus();\n");
	w.document.write( "}\n</script>\n");
	w.document.write( "</head><body class='popup' onLoad='javascript:autoSize();' >" );
	w.document.write( "<center >" );
    texte = monTitre;
	w.document.write( "<a href='javascript:window.close();'><img src='"+monImage+"' border=0 alt='"+monTitre+"' title='"+texte+"'></a>" );
	w.document.write( "</center >" );
	w.document.write( "</body></html>" );
	w.document.close();
     
	}
	
	/* ----------------------------------------------------- */
/* --Fonctions pour le drag and drop ------------------- */
/* ----------------------------------------------------- */
/*
 * <style> .dragme{position:relative;} </style> mettre le style sur l'objet qeu
 * l'on veut drag-droper
 */

var ie=document.all;
var nn6=document.getElementById&&!document.all;

var isdrag=false;
var x,y;
var xFin,yFin;
var dobj;

function movemouse(e)
{
  if (isdrag)
  {
  	// alert(dobj.toString());
  	dobj.style.left = nn6 ? tx + e.clientX - x : tx + event.clientX - x;
    dobj.style.top  = nn6 ? ty + e.clientY - y : ty + event.clientY - y;
    xFin=dobj.style.left;
    yFin=dobj.style.top;
    return false;
    
  }
}

function selectmouse(e) 
{
  var fobj       = nn6 ? e.target : event.srcElement;
  var topelement = nn6 ? "HTML" : "BODY";
  var elementsNotDrag=new Array("TEXTAREA","INPUT","SELECT");
  var objDrag=false;
  var objDrag1=false;
  
  var reg1=new RegExp("dragme","g");
  var classObj= fobj.className;
  if (classObj.match(reg1)) {
  	objDrag1=true;
  }
  
  // dragmode interdit sur la liste elementsNotDrag
  for (i=0;i<elementsNotDrag.length;i++) {
  	if (fobj.tagName == elementsNotDrag[i]) {
  		return true;
  	} 
  }
  // drag interfit sur les div en overflow auto (risque de scrollbar)
  if (fobj.style.overflow == "auto") {
  		return true;
  }
  /* on prend l'object parent pour le move */
  while (fobj.tagName != topelement && !objDrag1)
  {
  	fobj = nn6 ? fobj.parentNode : fobj.parentElement;
  	classObj= fobj.className;
  	if (classObj.match(reg1)) {
	  	objDrag1=true;
  	}
  }

  classObj= fobj.className;
  if (classObj.match(reg1)) {
  	objDrag=true;
  }
  if (objDrag) {
  	isdrag = true;
    dobj = fobj;
    document.body.style.cursor="move";
    tx = parseInt(dobj.style.left+0);
    ty = parseInt(dobj.style.top+0);
    x = nn6 ? e.clientX : event.clientX;
    y = nn6 ? e.clientY : event.clientY;
    document.onmousemove=movemouse;
	document.onmouseup=unselectmouse;
    return false;
  }
}
function unselectmouse() {
 	if (isdrag)
  	{
 		isdrag=false; 
		dobj='';
		document.body.style.cursor='default';
		document.onmousedown=selectdrag;
		// alert("X:"+xFin+" Y:"+yFin);
	}
}



function selectdrag(e) {
	var fobj = nn6 ? e.target : event.srcElement;
	  var reg1=new RegExp("dragme","g");
	  var classObj= fobj.className;
	    if (classObj.match(reg1)) {
		  document.onmousedown=selectmouse;
		  document.onmouseup=unselectmouse;
	  }
	  reg1=new RegExp("dragVertical","g");
	  if (classObj.match(reg1)) {
		  document.onmousedown=selectmouseV;
		  document.onmouseup=unselectmouseV;
	  }
}

document.onmousedown=selectdrag;


/**
 * 
 * @param tab
 */
function autoCompletion(tab, champ) {
	var repr="<table class=tabAutoComp>";
	repr+="<tr class='trAutoComp'>";
	for (i in tab) {
		repr+="<td onclick='getElement(\"champ\").value=\""+tab[i]+"\">"+tab[i]+"</td>";	
	}
	repr+="</tr>";
	repr+="<table>";
	
}