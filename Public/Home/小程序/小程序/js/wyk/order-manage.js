$("#select").click(function() {
				if ($("#s-n").is(":hidden")) {
					$("#s-n").show();
					$("#select i").addClass("intro");
				} else {
					$("#s-n").hide();
					$("#select i").removeClass("intro");
				}
			});