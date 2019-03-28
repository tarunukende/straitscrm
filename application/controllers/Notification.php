<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('notification_model');
    }

    public function getpopupNotification() {
        $notificationLeads = $this->notification_model->getNotificationUserM();
        echo json_encode($notificationLeads);
    }

    public function updatepopupNotification() {
        echo $this->notification_model->updatestatus($this->input->post("data_id"),$this->input->post("status"));
    }

}
