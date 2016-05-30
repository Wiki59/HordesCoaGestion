var user;
$.get("info.php?state=Ok&code=" + code, function (data) {
    user = JSON.parse(data);
    if (user['pseudo'] != undefined) {
	$("#mainLabel").html(user['pseudo']);
	}
});
