<?php if (!defined('BASEPATH')) exit('No direct script access allowed');  
 
require_once "././third_party/PHPExcel.php";
require_once "././third_party/PHPExcel/IOFactory.php";
class Excel extends PHPExcel 
{
    public function __construct() 
    {
        parent::__construct();
    }
}