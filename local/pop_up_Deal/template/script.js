// $(function () {
// 	var $mainForm = $('[data-container="alcohol"]'),
// 		$changeForm = $('[data-action="alcohol"]'),
// 		$views = $changeForm.find('[name="view"]'),
// 		$active = $views.filter(":checked"),
// 		mainClass = $mainForm.data("class");

// 	$(document).on("change", '[name="view"]', function () {
// 		setForm(this);
// 	});

// 	if (!$active.length) {
// 		$active = $views.eq(0);
// 		$active.trigger("click");
// 	} else {
// 		setForm($active.get(0));
// 	}

// 	function setForm(input) {
// 		$mainForm.removeClass().addClass(mainClass).addClass(input.value);
// 	}
// });
