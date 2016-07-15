$(document).ready(function() {
 
var selectedboxflag = 0;
var flag = 0;
    $("#col1,#col8").html("<img id = 'imgcol1' src = '/img/rook_white.png'>");
    $("#col2,#col7").html("<img id = 'imgcol1' src = '/img/knight_white.png'>");
    $("#col3,#col6").html("<img id = 'imgcol1' src = '/img/bishop_white.png'>");
    $("#col4").html("<img id = 'imgcol1' src = '/img/king_white.png'>");
    $("#col5").html("<img id = 'imgcol1' src = '/img/queen_white.png'>");
    
    $("#col57,#col64").html("<img id = 'imgcol1' src = '/img/rook_black.png'>");
    $("#col58,#col63").html("<img id = 'imgcol1' src = '/img/knight_black.png'>");
    $("#col59,#col62").html("<img id = 'imgcol1' src = '/img/bishop_black.png'>");
    $("#col61").html("<img id = 'imgcol1' src = '/img/king_black.png'>");
    $("#col60").html("<img id = 'imgcol1' src = '/img/queen_black.png'>");

    $("#col9,#col10,#col11,#col12,#col13,#col14,#col15,#col16").html("<img id = 'imgcol1' src = '/img/pawn_white.png'>");
    $("#col49,#col50,#col51,#col52,#col53,#col54,#col55,#col56").html("<img id = 'imgcol1' src = '/img/pawn_white.png'>");
 
  
	   
	$(".whitebox").click(function(){
		
	     var id = this.id;
	        $("#"+id).toggleClass("selectedWhite");
	});

	$(".blackbox").click(function(){
	   var id = this.id;
	     $("#"+id).toggleClass("selectedBlack");
	}); 

/*var temp = $("#col1").html();
$("#col1").html('');
 $("#col30").html(temp);*/
	$(".whitebox,.blackbox").click(function(){
		var id = this.id;
		var temp = $("#"+id).html();
		$("#"+id).html('');
		$("#col21").html(temp);
	});

 });  

   

