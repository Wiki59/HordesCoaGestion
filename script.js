$.get("info.php?state=Ok&code=" + code, function(data) {
 	$("#content").html(data);
	console.log(data);
});
