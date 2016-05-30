/**
 Transforme un .searcher en un puissant searcher
 Tiré d'un autre projet professionel
 */
$(".searcher").on("focus", function () {
    console.log("ok");
    var resultTab = [];
    var target = $(this);
    target.val("");
    $.ajax({
        type: "POST",
        url: "allTown.php",
        success: function (data) {
            $.each(data, function (k, v) {
		console.log(k, v);
                var maper = v.map(function (value) {
                    return {
                        value: value
                    };
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
                    target.attr("placeholder", maper[parseInt(target.attr("plcHoldI"))].value);
                    // Le keydown
                    target.on("keydown.holdering", function (e) {
                        actual = parseInt(target.attr("plcHoldI"));
                        if (e.keyCode === 38 && actual - 1 >= 0) {
                            target.attr("plcHoldI", parseInt(actual) - 1);
                            target.attr("placeholder", maper[parseInt(target.attr("plcHoldI"))].value);
                        } else if (e.keyCode === 40 && actual + 1 < maper.length) {
                            target.attr("plcHoldI", actual + 1);
                            target.attr("placeholder", maper[parseInt(target.attr("plcHoldI"))].value);
                        } else if (e.keyCode === 39 || e.type === "dblclick") {
                            target.val(target.attr("placeHolder"));
                        }
                    });
                } else {
                    target.attr("placeholder", "...");
                }
                // Affichage liste, dans une div#result
                target.on("keydown.resulter", resultShow = function () {
                    // TODO : Show all data if empty target.val
                    $("#result").html("<h3>Resultat :</h3>");
                    $.each(resultTab, function (key, val) {
                        $("#result").append(val.id + " - " + val.value);
                        try {
                            $("#result").append(" - " + val.type);
                        } catch (e) {
                            console.log("No result found");
                        }
                        $("#result").append("<br/>");
                    });
                });
                target.one("focus", resultShow());
                /*
                 * On retire les keydown, si non il se cumule
                 */
                target.on("blur", function () {
                    target.attr("plcHoldI", "0");
                    target.off("keydown.holdering keydown.resulter");
                });
            });
        }
    });
});
