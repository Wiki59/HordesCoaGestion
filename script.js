var user;
                $.get("info.php?state=Ok&code=" + code, function(data) {
                        user = JSON.parse(data);
			$("#mainLabel").html(user['pseudo']);
                        console.log(user['pseudo']);
                }); 
