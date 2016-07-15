function addNewAlbum()
{
	$.ajax({
		url : "album/add",
		success : function(result) {
			$("#formDiv").html(result);
		}
	});
}