/**
 Transforme un .searcher en un puissant searcher
 Tiré d'un autre projet professionel
 */
$(".searcher").on("focus", function () {
    var resultTab = [];
    var target = $(this);
    target.val("");
    $.ajax({
        type: "POST",
        url: "../requete/allTown.php?token=" + $("#token").val(),
        success: function (data) {
            var maper = [];
            JSON.parse(data, function (k, v) {
                maper.push(v);
            });

            // Affichage en autocomplete
            target.autocomplete({
                source: maper,
                autoFocus: true,
                delay: 50,
		response: function (e, map) {
                    resultTab = [];
                    $.each(map, function (k, v) {
                        $.each(v, function (key, val) {
                            resultTab.push(val);
                        });
                    });
                    resultShow();
                }
            });

            // Affichage en placeholder
            if (maper.length > 0) {
                target.attr("placeholder", maper[parseInt(target.attr("plcHoldI"))]);
                // Le keydown
                target.on("keydown.holdering", function (e) {
                    actual = parseInt(target.attr("plcHoldI"));
                    if (e.keyCode === 38 && actual - 1 >= 0) {
                        target.attr("plcHoldI", parseInt(actual) - 1);
                        target.attr("placeholder", maper[parseInt(target.attr("plcHoldI"))]);
                    } else if (e.keyCode === 40 && actual + 2 < maper.length) {
                        target.attr("plcHoldI", actual + 1);
                        target.attr("placeholder", maper[parseInt(target.attr("plcHoldI"))]);
                    } else if (e.keyCode === 39 || e.type === "dblclick") {
                        target.val(target.attr("placeHolder"));
                    }
                });
            } else {
                target.attr("placeholder", "...");
            }

            // Affichage liste, dans une div#result
            target.on("keydown.resulter", resultShow = function (e) {
                if (e == null || e.keyCode != 13) {
                    var toAppend = "<table><tr></tr><th><h2>Resultat :</h2></th></tr>";
                    $.each(resultTab, function (key, val) {
                        toAppend += "<tr class='townResult' town='" + val.value + "' onclick=\"location.replace('/town.php?town=" + val.value + "')\"><td>" + val.value;
                        toAppend += "</td></a></tr>";
                    });
                    toAppend += "</table>";
                    $("#result").html(toAppend);
                } else {
                    if (target.val() != "") {
                        window.open("/town.php?town=" + target.val(), "_self");
                    } else if (target.attr("placeholder") != "...") {
                        window.open("/town.php?town=" + target.attr("placeholder"), "_self");
                    }
                }
            });
            target.one("focus", resultShow());
            // On retire les keydown, si non ils se cumulent
            target.on("blur", function () {
                target.attr("plcHoldI", "0");
                target.off(".holdering .resulter");
            });
        }
    });
});