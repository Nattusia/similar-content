<?php

/**
 * Implements hook_form().
 */
function custom_similar_content_settings_form($form, $form_state) {
  //$instances = field_info_instances('taxonomy_term', 'vocabulary_5');

  $form = array();
  $form['content_type'] = array(
    '#type' => 'checkboxes',
    '#title' => t('Select content types to which block will be implemented'),
    '#options' => custom_similar_content_get_content_types(),
    '#default_value' => variable_get('custom_similar_content_types', array()),
    '#required' => TRUE,
  );

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Submit'),
  );

  return $form;
}

/**
 * Implements hook_form_submit().
 */
function custom_similar_content_settings_form_submit($form, &$form_state) {

  variable_set('custom_similar_content_types', $form_state['values']['content_type']);

  $fields = array();

  foreach($form_state['values']['content_type'] as $ntype) {

    $get_fields = custom_similar_content_get_fields($ntype);
    if (!empty($get_fields)) {
      $fields[$ntype] = $get_fields;
    }
    if (!empty($ntype)) {
      similar_content_create_node_field($ntype);
    }
  }

  if (!empty($fields)) {
    $_SESSION['fields'] = $fields;
    $form_state['redirect'] = 'admin/config/simc/fields';
  }
  else {
    foreach ($form_state['values']['content_type'] as $ntype) {
      if ($ntype > 0) {
        drupal_set_message('Settings for content type ' . $ntype . ' are saved');
      }
    }
  }
}

/**
 * Implements hook_form().
 */
function custom_similar_content_settings_fields_form($form, $form_state) {
  $form = array();
  $form['#tree'] = TRUE;

  foreach ($_SESSION['fields'] as $type => $fields) {
    if (!empty($fields)) {
      $form[$type] = array(
        '#type' => 'fieldset',
        '#title' => 'Select taxonomy field for node type ' . $type,
      );

      $form[$type]['select'] = array(
        '#type' => 'checkboxes',
        '#default_value' => variable_get('custom_similar_content_fields_' . $type, array()),
        //'#required' => TRUE,
        '#options' => $fields,
      );
    }
  }

  $form['submit'] = array(
    '#type' => 'submit',
    '#value' => t('Submit'),
  );

  return $form;
}

/**
 * Implements hook_form_submit().
 */
function custom_similar_content_settings_fields_form_submit ($form, &$form_state) {

  foreach ($form_state['values'] as $ind => $value) {
    if ((is_array($value)) && (isset($value['select']))) {
      $selects = array();
      foreach ($value['select'] as $select) {
        if ($select != '') {
          custom_similar_content_create_taxonomy_field($ind, $select);
          $selects[] = $select;
        }
        variable_set('custom_similar_content_fields_'.$ind, $selects);
        foreach ($selects as $select) {
          drupal_set_message('Settings for field type ' . $select . ' are saved');
        }
      }
    }
  }
}
