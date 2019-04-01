<?php
/*
* Form for Configure the Options of the Module
*
*
*/
function form_admin_sla_calculations_main($form, &$form_state) {

  $form['description'] = array(
    '#type' => 'item',
    '#title' => t('Parámetros de Configuración del Módulo SLA Calculations'),
  );
  $form['name'] = array(
    '#type' => 'fieldset',
    '#title' => t('Datos de Configuración'),
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );
  $form['name']['main_view_name'] = array(
    '#type' => 'textfield',
    '#title' => t('Nombre de la Vista Principal asignada a realizar la búsqueda:'),
    '#required' => TRUE,
    '#default_value' => variable_get('improve_search_eluniversal_mainViewName'),
    '#description' => "Nombre de la Vista",
    '#size' => 50,
    '#maxlength' => 5000,
  );
  $form['name']['display_view_name'] = array(
    '#type' => 'textfield',
    '#title' => t('Nombre del Display asignado a la Vista para realizar la búsqueda:'),
    '#required' => TRUE,
    '#default_value' => variable_get('improve_search_eluniversal_displayViewName'),
    '#description' => "Nombre del Display",
    '#size' => 50,
    '#maxlength' => 5000,
  );
  $form['name']['enable_improve_search_results'] = array(
        '#type' =>'checkbox',
        '#title'=>t('Activar Improve Search Results en el Sitio Web'),
        //'#required'=>TRUE,
        '#default_value' =>variable_get('improve_search_eluniversal_enableImproveSearchResults'), // for default checked and false is not checked
  );
  $form['name']['debug_query_search'] = array(
       '#type' =>'checkbox',
       '#title'=>t('Mostrar Query de la Búsqueda'),
       //'#required'=>TRUE,
       '#default_value' =>variable_get('improve_search_eluniversal_debugQuerySearch'), // for default checked and false is not checked
  );
  $form['name']['submit'] = array(
    '#type' => 'submit',
    '#value' => 'Guardar',
  );


  return system_settings_form($form);
  //return $form;
  //system_settings_form($form)
}

function form_admin_sla_calculations_main_validate($form, &$form_state) {

    $mainViewName = $form_state['values']['main_view_name'];
    $displayViewName = $form_state['values']['display_view_name'];
    $enableImproveSearchResults = $form_state['values']['enable_improve_search_results'];
    $debugQuerySearch = $form_state['values']['debug_query_search'];

    form_admin_sla_calculations_main_submit($form, $form_state);
}

function form_admin_sla_calculations_main_submit($form, &$form_state) {

    $mainViewName = $form_state['values']['main_view_name'];
    $displayViewName = $form_state['values']['display_view_name'];
    $enableImproveSearchResults = $form_state['values']['enable_improve_search_results'];
    $debugQuerySearch = $form_state['values']['debug_query_search'];

    variable_set('improve_search_eluniversal_mainViewName', $mainViewName);
    variable_set('improve_search_eluniversal_displayViewName', $displayViewName);
    variable_set('improve_search_eluniversal_enableImproveSearchResults', intval($enableImproveSearchResults));
    variable_set('improve_search_eluniversal_debugQuerySearch', intval($debugQuerySearch));

}
