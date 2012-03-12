<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/* 
 * 
 * We must extend normal CI_Form_validation class to adjust it for HMVC (especially calbacks)
 */
class MY_Form_validation extends CI_Form_validation{
    
    public $CI;
    
}