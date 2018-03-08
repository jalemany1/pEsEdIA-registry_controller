require(['elgg', 'jquery'], function (elgg, $) {
	$('input[name="name"]').on('input propertychange', function (e) {
		$('input[name="username"]').val(this.value);
	});
});