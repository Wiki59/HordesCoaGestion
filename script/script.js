if (pseudo === "antonii") {
    $("html, body").css("background-image", "url(../ressource/vodka.gif)");
    $("html, body").css("background-repeat", "repeat");
    console.log("ok");
}
if (pseudo === "WiKi59") {
    $("html, body").css("background-image", "url(http://image.wissamlefevre.com/root//wImg580c0c5680183.png)");
    $("html, body").css("background-repeat", "no-repeat");
    $("html, body").css("background-size", "cover");
    console.log("ok");
}

var town = $("#town").val();

$("#addC").on("click", function () {
    $.post("requete/newCitizen.php", {town: town}, function (data) {
        $("#boxInfo").html(data);
    }).done(function() {
		refresh();
	});
});

$("#mvC").on("click", function () {
    $.post("requete/removeCitizen.php", {town: town}, function (data) {
        $("#boxInfo").html(data);
    }).done(function() {
	refresh();
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
    }).done(function () {
	refresh();
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

var refresh = function() {
	location.reload();
};
