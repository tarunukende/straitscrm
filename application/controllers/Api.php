<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data_model');
        $this->load->model('notification_model');
    }

    public function addLead() {
        $insertData = array();
        if ($_POST) {
            $insertData['name'] = $_POST['name'];
            $insertData['mail'] = $_POST['mail'];
            $insertData['job_title'] = $_POST['job_title'];
            $insertData['company'] = $_POST['company'];
            $insertData['phone'] = $_POST['phone'];
            $insertData['country'] = $_POST['country'];
            $insertData['report'] = $_POST['report'];
            $insertData['region'] = $_POST['region'];
            $insertData['message'] = $_POST['message'];
            $insertData['ip'] = $_POST['ip'];
            //$insertData['status'] = $_POST['status'];
            $insertData['website'] = $_POST['website'];
            $insertData['source'] = $_POST['source'];
            $insertData['status'] = "1";


            $add = $this->notification_model->addNotification($insertData, 'leads');

            $Record = $this->data_model->getSimilarData(array('field' => 'name', 'value' => $_POST['region']), 'regions')[0];
            /*$exc_count = $this->data_model->getByCondition(array('field' => 'region_id', 'value' => $Record['id']), 'lead_exec');*/
            $AllExc = $this->data_model->getByRegionid(array('field' => 'region_id', 'value' => $Record['id']), 'sales');
            $Excs = $this->data_model->getAllByRegion($Record['id']);
            $Count = count($Excs);

            if ($Excs[0]['id']) {
                $assign = $this->data_model->add(array('lead_id' => $add, 'sales_id' => $Excs[0]['id']), 'lead_sales');
            } else {
                $assign = $this->data_model->add(array('lead_id' => $add, 'sales_id' => 7), 'lead_sales');
            }
            $this->data_model->edit(array('flag' => 1), 'sales', $Excs[0]['id']);
            if ($Count == 1) {
                foreach ($AllExc as $Exc) {
                    $this->data_model->edit(array('flag' => 0), 'sales', $Exc['id']);
                }
            }

            if ($add && $assign) {
                return true;
            } else {
                return false;
            }
        } else {
            /*return false;*/

            $AllExc = $this->data_model->getByRegionid(array('field' => 'region_id', 'value' => 1), 'sales');
            
            $Excs = $this->data_model->getAllByRegion(1);
            $Count = count($Excs);

            print_r($Excs);die;
            $data['pagetitle'] = 'Add Leads';
            $this->load->view("Leads/addlead", $data);
        }
    }

}
