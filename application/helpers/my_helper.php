<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter my_helper Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Yuvraj J
 * @link		"null"
 */
// ------------------------------------------------------------------------

if (!function_exists('load_css')) {

    /**
     * Element
     *
     * Lets you determine whether an array index is set and whether it has a value.
     * If the element is empty it returns NULL (or whatever you specify as the default value.)
     *
     * @param	string
     * @param	array
     * @param	mixed
     * @return	mixed	depends on what the array contains
     */
    function load_css($css) {

        $str = "";
        if ($css) {
            foreach ($css as $val) {
                $str .= '<link rel="stylesheet" href=" ' . base_url() . 'assets/css/' . $val . '.css">';
            }
            echo $str;
        }
    }

}



if (!function_exists('load_js')) {

    /**
     * Element
     *
     * Lets you determine whether an array index is set and whether it has a value.
     * If the element is empty it returns NULL (or whatever you specify as the default value.)
     *
     * @param	string
     * @param	array
     * @param	mixed
     * @return	mixed	depends on what the array contains
     */
    function load_js($js) {

        $str = "<br/>";
        if ($js) {
            foreach ($js as $val) {
                $str .= '<script src="' . base_url() . 'assets/js/' . $val . '.js"></script>';
            }
            echo $str;
        }
    }

}


if (!function_exists('pr')) {

    function pr($val) {

        echo "<pre>";
        print_r($val);
    }

}


if (!function_exists('prd')) {

    function prd($val) {

        echo "<pre>";
        print_r($val);
        die();
    }

}

 