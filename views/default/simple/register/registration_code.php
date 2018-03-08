<?php
/**
 * Pesedia register form extension to include invite code
 *
 * @package Pesedia
 */

$regcode_field = array(
	'#class' => 'mtm',
	'#type' => 'text',
	'#label' => elgg_echo('pesedia:registry_controller:registration_code'),
	'#help' => elgg_echo('pesedia:registry_controller:registration_code:help'),
	'name' => 'registration_code',
	'required' => true,
);

echo elgg_view_field($regcode_field);