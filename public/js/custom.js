
// A $( document ).ready() block.
$( document ).ready(function() {
     $(".postTextAreas").hide();
});
function addNewAlbum()
{
	$.ajax({
		url : "album/add",
		success : function(result) {
			$("#formDiv").html(result);
		}
	});
}

function convertToEditable(id){
    $("#para"+id).hide();
    $("#paraTextArea"+id).show();
    
}