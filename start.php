<?php

/**
 * Registry Controller
 *
 * @author Jose Alemany Bordera <jalemany1@dsic.upv.es>
 * @author Agustín Espinosa Minguet <aespinos@upvnet.upv.es>
 * @copyright Copyright (c) 2017, GTI-IA
 */

elgg_register_event_handler('init', 'system', function() {

	/* Allow multiple emails in the registry */
	elgg_unregister_action('register');
	elgg_register_action('register', __DIR__ . '/actions/register.php', 'public');
	elgg_register_plugin_hook_handler('action', 'register', function(){ set_input('multi_emails', true); });

	/* Extend register view to include registration code */
	elgg_extend_view('register/extend', 'forms/registration_code', 999);
	elgg_extend_view('register/extend', 'simple/sname', 999);

	/* Extension of user registration */
	elgg_register_event_handler('create', 'user', function($event, $object_type, $object){
		/* Avoid 'registration_code' duplicity */
		$regcode = get_input('registration_code');
		$code_used = elgg_get_entities_from_metadata(array(
			'type' => 'user',
			'count' => true,
			'metadata_name' => 'registration_code',
			'metadata_value' => $regcode,
		));

		if ($code_used) {
			register_error(elgg_echo('RegistrationException:pesedia:registration_code:already_used'));
			return false;
		}

		$object->registration_code = $regcode;

		/* Duplicate data of duplicated fields */
		$object->email2 = get_input('email');
		$object->age2 = get_input('custom_profile_fields_age');
		$object->gender2 = get_input('custom_profile_fields_gender');
		$object->userclass2 = get_input('custom_profile_fields_userclass');
		$object->usergroup2 = get_input('custom_profile_fields_usergroup');
	});

	/* Validate 'registration_code' value */
	//elgg_register_plugin_hook_handler('action', 'register', 'registrationcode_register_hook');
});

/*function registrationcode_register_hook() {
	$resumen = get_input('custom_profile_fields_clase') . get_input('custom_profile_fields_grupo') . get_input('custom_profile_fields_id');
	if (get_input('custom_profile_fields_registrationcode') != hash('crc32', $resumen , false) ) {
		register_error(elgg_echo('pesedia:invitationcode'));
		forward(REFERER);
	}
	set_input('custom_profile_fields_registrationcode','');
}*/