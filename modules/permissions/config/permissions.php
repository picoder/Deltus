<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

# Perspective.Name of perspective.Kind.Functionality
$config['MODULE.LAB.LAB.INDEX'] = array('check_full_access' => TRUE);
$config['MODULE.LAB.CONTENT.INDEX'] = array('check_full_access' => TRUE);

$config['SITE.ALL.ALL.ALL'] = array('check_full_access' => TRUE);

$config['CONTENT.START.START.SDO'] = array('check_full_access' => TRUE);

$config['CONTENT.ROLE.CONTENT.ALL'] = array('check_full_access' => TRUE);
$config['CONTENT.ROLE.CONTENT.LIST'] = array('check_full_access' => TRUE);
$config['CONTENT.ROLE.CONTENT.EDIT'] = array('check_full_access' => TRUE);

$config['CONTENT.ROLE.SETTINGS.ALL'] = array('check_role' => array('editor'));

$config['CONTENT.ROLE.ROLE.ALL'] = array('check_full_access' => TRUE);

$config['DIVISION.ALL.ALL.ALL'] = array('check_full_access' => TRUE);

$config['CONTENT.FILES_UPLOAD.FILES_UPLOAD.PLUPLOAD'] = array('check_full_access' => TRUE);

/* End of file permissions.php */
/* Location: ./modules/permissions/config/permissions.php */