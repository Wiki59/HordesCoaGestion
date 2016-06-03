var user;
$.get("../requete/info.php?state=Ok&code=" + code, function (data) {
    user = JSON.parse(data);
    if (user['pseudo'] != undefined) {
        $("#mainLabel").html(user['pseudo']);
    }
});

var town = $("#town").val();

$("#addC").on("click", function() {
    $.post("requete/newCitizen.php", {town: town}, function (data) {
        $("#boxInfo").html(data);
    });
});

$("#majC").on("click", function() {
    $.post("requete/majCitizen.php", {town: town}, function (data) {
        $("#boxInfo").html(data);
    });
});

$("#jhCumulDiv").on("click",function() {
   $("#jhCumulDivString").toggle();
   $("#jhCumulDivNumber").toggle();
});
