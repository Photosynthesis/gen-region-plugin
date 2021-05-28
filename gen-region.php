<?php

/**
 * Plugin Name:       GEN Region
 * Description:       Global Ecovillage Network local network plugin
 * Version:           0.1.0-alpha
 */

if ( ! defined( 'WPINC' ) ) {
	die;
}

add_filter('murmurations-aggregator-config', function( $default_config ){

  $config =  array(
    'plugin_name' => 'GEN Local Network',
    'node_name' => 'Ecovillage Project',
    'node_name_plural' => 'Ecovillage Projects',
    'node_slug' => 'ecovillage-project',
    'plugin_slug' => 'gen-region',
    'index_fields' => ['country','gen_region'],
    'list_fields' => ['country','community_types','project_types','languages_spoken'],
    'node_single_url_field' => 'gen_project_url',
    'schema_file' => plugin_dir_path(__FILE__).'schemas/gen_ecovillages_v0.0.1.json',
    'field_map_file' => plugin_dir_path(__FILE__).'schemas/gen_ecovillages_field_map.json',
    'templates_directory' => plugin_dir_path(__FILE__).'templates/',
  );

  return wp_parse_args( $config, $default_config );

});

?>
