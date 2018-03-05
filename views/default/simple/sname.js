require(['elgg', 'jquery'], function (elgg, $) {
	$('label[for="register-username"]').parent().hide();
	$('label[for="register-name"]').text($('label[for="register-username"]').text());
	$('input#register-name').on('input propertychange', function (e) {
		$('input#register-username').val(this.value);
	});
});