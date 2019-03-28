<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Notification_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getNotificationUserM() {
        $this->db->select('leads.*');
        $this->db->from('leads');
        $this->db->join('lead_sales', 'leads.id = lead_sales.lead_id');
        $this->db->where('lead_sales.sales_id', $this->session->userdata('userid'));
        $this->db->where_in('leads.status',array('1','2'));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function updatestatus($id, $status) {
        $this->db->where('id', $id);
        if ($this->db->update("leads", array('status' => $status))) {
            return true;
        } else {
            return false;
        }
    }

    public function addNotification($Array, $table) {
        if ($this->db->insert($table, $Array)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

}
