<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


# $config['DIVISION.ALL.ALL.ALL'] = array(0 => array('check_role' => array('editor')));
$config['DIVISION.ALL.ALL.ALL'] = array(0 => array('check_no_check' => TRUE));
$config['MODULE.ROLE.CONTENT.EDIT'] = array(0 => array('check_no_check' => TRUE));
$config['BACKEND.BACKEND.DASHBOARD'] = array(0 => array('backend_access' => array('administrator')));
$config['BACKEND.BACKEND_PM.LOGIN'] = array(0 => array('check_no_check' => TRUE));
$config['BACKEND.BACKEND_PM.LOGOUT'] = array(0 => array('check_no_check' => TRUE));
$config['BACKEND.BACKEND_PM.FORGOT'] = array(0 => array('check_no_check' => TRUE));
$config['BACKEND.BACKEND_PM.RESET'] = array(0 => array('check_no_check' => TRUE));

$config['BACK.BACK.USERS'] = array(0 => array('backend_access' => array('administrator')));
$config['BACK.BACK.ROLES'] = array(0 => array('backend_access' => array('administrator')));
$config['BACK.BACK.ARTICLES'] = array(0 => array('backend_access' => array('administrator')));
$config['BACK.BACK.FILES'] = array(0 => array('backend_access' => array('administrator')));

$config['ARTICLE.ARTICLE_CRUD.EDIT'] = array(0 => array('backend_access' => array('administrator')));
$config['ARTICLE.ARTICLE_CRUD.CATEGORY_EDIT'] = array(0 => array('backend_access' => array('administrator')));

$config['FILE.FILE_CRUD.EDIT'] = array(0 => array('backend_access' => array('administrator')));

