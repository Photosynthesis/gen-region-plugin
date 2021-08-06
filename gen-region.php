<?php

/**
 * Plugin Name:       GEN Region
 * Description:       Global Ecovillage Network local network plugin
 * Version:           0.1.0-alpha
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

register_activation_hook( __FILE__, 'gen_region_activate' );

$gen_murmagg_settings_overrides = array(
  'schemas' => array(
    'default' => array(
      array('location' => plugin_dir_url( __FILE__ ) . 'schemas/gen_ecovillages_v0.0.1.json')
    ),
    'overwrite' => true, // If set to true, default values set here will overwrite values already set in the DB when the plugin is activated. Once the plugin is activated, this value has no effect. Default: false
  ),
  'field_map_url' => array(
    'value' => plugin_dir_url(__FILE__).'schemas/gen_ecovillages_field_map.json',
    'overwrite' => true,
  ),
  'plugin_name' => array(
    'value' => 'GEN Local Network',
    'overwrite' => true,
  ),
  'node_name' => array(
    'default' => 'Ecovillage Project',
    'overwrite' => true,
  ),
  'node_name_plural' => array(
    'default' => 'Ecovillage Projects',
    'overwrite' => true,
  ),
  'node_slug' => array(
    'value' => 'ecovillages',
    'overwrite' => true,
  ),
  'node_single_url_field' => array(
    'default' => 'gen_project_url',
    'overwrite' => true,
  )
);

add_filter('murmurations-aggregator-load-settings-schema', function( $settings_schema ){

  global $gen_murmagg_settings_overrides;

  foreach ($gen_murmagg_settings_overrides as $field => $attribs) {
    foreach ($attribs as $attrib => $value) {
      $settings_schema['properties'][$field][$attrib] = $value;
    }
  }

  return $settings_schema;
});


add_filter('murmurations-interfaces-settings', function( $settings ){

  /* Uncomment to add custom schema for front-end map and directory filters */
  // $filter_schema_file = plugin_dir_path( __FILE__ ) . "schemas/gen_ecovillages_filter_input_schema.json";
  // $settings['filter_schema'] = json_decode(file_get_contents($filter_schema_file), true);

  $display_schema_file = plugin_dir_path( __FILE__ ) . "schemas/gen_ecovillages_list_display_schema.json";
  $settings['directory_display_schema'] = json_decode(file_get_contents($display_schema_file), true);

  return $settings;

});


function gen_region_activate(){

  if( is_callable( array( "Murmurations\Aggregator\Settings", "set" ) ) ){

    global $gen_murmagg_settings_overrides;

    foreach ($gen_murmagg_settings_overrides as $field => $attribs) {
      if($attribs['overwrite'] == true ){
        if( isset($attribs['value']) || isset($attribs['default']) ){

          $value = $attribs['value'] ? $attribs['value'] : $attribs['default'];

          Murmurations\Aggregator\Settings::set($field, $value);

        }
      }
    }

    Murmurations\Aggregator\Settings::save();

  }
}



?>
