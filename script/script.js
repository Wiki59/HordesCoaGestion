var user;
$.get("../requete/info.php?state=Ok&code=" + code, function (data) {
    user = JSON.parse(data);
    if (user['pseudo'] != undefined) {
        $("#mainLabel").html(user['pseudo']);
    }
    if (user['pseudo'] === "antonii") {
        $("html, body").css("background-image", "url(../ressource/vodka.gif)");
        $("html, body").css("background-repeat", "repeat");
        console.log("ok");
    }
/*
    if (user['pseudo'] === "WiKi59") {
        $("html, body").css("background-image", "url(../ressource/shovel.gif)");
        $("html, body").css("background-repeat", "repeat");
        console.log("ok");
    }
*/
});

var town = $("#town").val();

$("#addC").on("click", function () {
    $.post("requete/newCitizen.php", {town: town}, function (data) {
        $("#boxInfo").html(data);
    });
});

$("#mvC").on("click", function () {
    $.post("requete/removeCitizen.php", {town: town}, function (data) {
        $("#boxInfo").html(data);
    });
});

$("#majC").on("click", function () {
    $.post("requete/majCitizen.php",
            {
                town: town,
                jhCumul: $("name='jhCumul'"),
                pdc: $("name='pdc'"),
                nvRuin: $("name='nvRuin'"),
                arma: $("name='arma'"),
                apag: $("name='apag'"),
                rescue: $("name='rescue'"),
                rdh: $("name='rdh'"),
                upper: $("name='upper'"),
                solder: $("name='solder'"),
                ss: $("name='ss'"),
                trouvaille: $("name='trouvaille'"),
                deathtrap: $("name='deathtrap'"),
                campPro: $("name='campPro'"),
                veilPro: $("name='veilPro'"),
                forBan: $("name='forBan'"),
                forGoul: $("name='forGoul'"),
                jhLeft: $("name='jhLeft'"),
                role: $("name='role'"),
                com: $("name='com'")
            }, function (data) {
        $("#boxInfo").html(data);
    });
});

$("#jhCumulDiv").on("mousedown.togDN", function (e) {
    if (e.button === 0) {
        clearTimeout(this.downTimer);
        this.downTimer = setTimeout(function () {
            $("#jhCumulDivString").toggle();
            $("#jhCumulDivNumber").toggle();
        }, 2000);
    }
});

if ($("#playerPresent").attr("value") === "true") {
    $(".playerControler").attr("value", "Se retirer");
    $(".playerControler").attr("id", "mvC");
}

console.log($("#playerPresent").attr("value"));
