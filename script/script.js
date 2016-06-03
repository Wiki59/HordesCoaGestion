var user;
$.get("../requete/info.php?state=Ok&code=" + code, function (data) {
    user = JSON.parse(data);
    if (user['pseudo'] != undefined) {
        $("#mainLabel").html(user['pseudo']);
    }
    if (user['pseudo'] === "antonii" || user['pseudo'] === "WiKi59") {
        $("html, body").css("background-image", "url(../ressource/vodka.gif)");
        $("html, body").css("background-repeat", "repeat");
	console.log("ok");
    }
});

var town = $("#town").val();

$("#addC").on("click", function() {
    $.post("requete/newCitizen.php", {town: town}, function (data) {
        $("#boxInfo").html(data);
    });
});

$("#lvC").on("click", function() {
    $.post("requete/removeCitizen.php", {town: town}, function (data) {
        $("#boxInfo").html(data);
    });
});

$("#majC").on("click", function() {
    $.post("requete/majCitizen.php", {town: town}, function (data) {
        $("#boxInfo").html(data);
    });
});

$("#jhCumulDiv").on("click",function() {
	console.log("ok");
   $("#jhCumulDivString").toggle();
   $("#jhCumulDivNumber").toggle();
});

if ($("#playerPresent").val() === "true") {
    $(".playerControler").attr("value", "Se retirer");
    $(".playerControler").attr("id", "mvC");
}
