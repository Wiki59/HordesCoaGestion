var user;
$.get("info.php?state=Ok&code=" + code, function (data) {
    user = JSON.parse(data);
    if (user['pseudo'] != undefined) {
        $("#mainLabel").html(user['pseudo']);
    }
});

function addMe(town) {
    $.post("/newCitizen.php", {town: town}, function (data) {
        $("#boxInfo").html(data);
    });
};

var maj = function majMe(town) {
    $.post("/majCitizen.php", {town: town}, function (data) {
        $("#boxInfo").html(data);
    });
};
