var user = "";
$.get("info.php?state=Ok&code=" + code, function(data) {
	$.each(data, function(k, v) {
		console.log(k, v);
	});
});

//console.log(user);

//$(#mainLabel").val(data['pseudo']);
