var popw;
function ngepop(alamak,itop,ileft,iwidth,iheight,usemodal)
{
	var ua = navigator.userAgent;
	if (ua.match(/MSIE/)){
		usemodal=0; //modaldialog disabled, MSIE gak suprot
	} 
	if (!usemodal){
 		if (popw){
 			if (!popw.closed){popw.close();}
 		}
 		popw = window.open(alamak,"_blank","toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbar=no,resizable=no,copyhistory=yes,width="+iwidth+",height="+iheight+",left="+ileft+",top="+itop);
	}else{
 		popw = window.showModalDialog(alamak,"_blank","dialogHeight="+iheight+";dialogWidth="+iwidth+";doalogTop="+itop+";dialogLeft="+ileft);
	}
}
