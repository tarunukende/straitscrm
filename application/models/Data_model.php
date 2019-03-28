<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getAll($tbl) {
        $sql = $this->db->get($tbl);
        if ($sql->num_rows() > 0) {
            return $sql->result_array();
        } else {
            return false;
        }
    }

    public function getAllActive($tbl) {
        $sql = $this->db->get($tbl);
        $this->db->where("status", "1");
        if ($sql->num_rows() > 0) {
            return $sql->result_array();
        } else {
            return false;
        }
    }

    public function getAllLeads($limit) {
        $this->db->select('leads.id, leads.name, leads.report, leads.region, leads.created_at , leads.website, leads.mail, lead_sales.sales_id, lead_sales.id as sid');
        $this->db->from('leads');
        $this->db->join('lead_sales', 'leads.id = lead_sales.lead_id');
        $this->db->order_by('leads.id', 'DESC');
        //$this->db->limit(200);
        if ($limit != '') {
            $this->db->limit($limit['limit'], $limit['start']);
        }
        $sql = $this->db->get();
        if ($sql->num_rows() > 0) {
            return $sql->result_array();
        } else {
            return false;
        }
    }

    public function allposts_count() {
        $query = $this
                ->db
                ->get('leads');

        return $query->num_rows();
    }

    public function getByCondition($Array, $table) {
        $this->db->where($Array['field'], $Array['value']);

        $sql = $this->db->get($table);
        if ($sql->num_rows() > 0) {
            return $sql->result_array();
        } else {
            return false;
        }
    }

    public function getLeadDetails($id) {
        $this->db->select('name, mail, country, report, website, created_at, category_id, comment, called, recording_file, sample_shared, publisher_id, sales_status_id, followup_no, followup_date');
        $this->db->from('leads');
        $this->db->join('lead_details', 'leads.id = lead_details.lead_id');
        $this->db->where('leads.id', $id);
        $this->db->order_by("lead_details.id", "desc");
        $sql = $this->db->get();
        if ($sql->num_rows() > 0) {
            return $sql->result_array()[0];
        } else {
            return false;
        }
    }

    public function getlead_details($id) {
        $this->db->select('lead_id,name, mail, country, report, website, created_at, category_id, comment, called, recording_file, sample_shared, publisher_id, sales_status_id, followup_no, followup_date');
        $this->db->from('leads');
        $this->db->join('lead_details', 'leads.id = lead_details.lead_id');
        $this->db->where('leads.id', $id);
        $this->db->order_by("lead_details.id", "desc");
        $sql = $this->db->get();
        if ($sql->num_rows() > 0) {
            return $sql->result_array();
        } else {
            return false;
        }
    }

    public function getById($table, $id) {
        $this->db->where('id', $id);
        $sql = $this->db->get($table);
        if ($sql->num_rows() == 1) {
            return $sql->result_array()[0];
        } else {
            return false;
        }
    }

    public function getRegionById($table, $id) {
        $this->db->where_in('id',$id,FALSE);
        $sql = $this->db->get($table);
        if ($sql->num_rows() >= 1) {
            return $sql->result_array();
        } else {
            return false;
        }
    }

    public function getsaleslead_id($id) {
        $this->db->select('id');
        $this->db->where('lead_id', $id);
        $sql = $this->db->get('lead_sales');
        if ($sql->num_rows() == 1) {
            return $sql->result_array()[0];
        } else {
            return false;
        }
    }

    public function getNewLeadsUser() {
        $this->db->select('leads.id, leads.name, leads.country, leads.message, leads.report, lead_sales.status,leads.website, leads.created_at');
        $this->db->from('leads');
        $this->db->join('lead_sales', 'leads.id = lead_sales.lead_id');
        $this->db->where('lead_sales.sales_id', $this->session->userdata('userid'));
        $this->db->where('lead_sales.status', 0);
        $this->db->order_by('created_at', 'DESC');

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getNotificationUser() {
        $this->db->select('leads.*');
        $this->db->from('leads');
        $this->db->join('lead_sales', 'leads.id = lead_sales.lead_id');
        $this->db->where('lead_sales.sales_id', $this->session->userdata('userid'));
        $this->db->where('leads.seen', 0);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getClosedLeadsUser() {
        $this->db->select('leads.id, leads.name, leads.country, leads.message, leads.report, lead_sales.status,leads.website, leads.created_at');
        $this->db->from('leads');
        $this->db->join('lead_sales', 'leads.id = lead_sales.lead_id');
        $this->db->where('lead_sales.sales_id', $this->session->userdata('userid'));
        $this->db->where('lead_sales.status', 2);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getSceduledLeadsUser() {
        $this->db->select('leads.id, leads.name, leads.country, leads.message, leads.report, lead_sales.status,leads.website, leads.created_at');
        $this->db->from('leads');
        $this->db->join('lead_sales', 'leads.id = lead_sales.lead_id');
        $this->db->where('lead_sales.sales_id', $this->session->userdata('userid'));
        $this->db->where('lead_sales.status', 1);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getLeads_followup() {
        $this->db->select('leads.id, leads.name, leads.country, leads.message, leads.report, lead_sales.status, leads.created_at , lead_details.followup_date');
        $this->db->from('leads');
        $this->db->join('lead_sales', 'leads.id = lead_sales.lead_id');
        $this->db->join('lead_details', 'leads.id = lead_details.lead_id');
        $this->db->where('lead_sales.sales_id', $this->session->userdata('userid'));
        $this->db->where('lead_sales.status', 1);
        $this->db->where(array('lead_details.followup_date !=' => NULL));
        $this->db->order_by('lead_details.followup_date', 'asc');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getAllClosed() {
        $this->db->select('leads.id, leads.name, leads.country, leads.message, leads.report, lead_sales.status,leads.website, leads.created_at');
        $this->db->from('leads');
        $this->db->join('lead_sales', 'leads.id = lead_sales.lead_id');
        $where = "lead_sales.status = 2 OR lead_sales.status = 1";
        // $this->db->where('lead_sales.status', 2);
        $this->db->where($where);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getNewLeadsTeam() {
        $this->db->select('lead_details.id, company, country, report, source, category_id, publisher_id, website');
        $this->db->from('leads');
        $this->db->join('lead_details', 'leads.id = lead_details.lead_id');
        // $this->db->join('lead_marketing', 'leads.id <> lead_marketing.lead_id');
        $this->db->where('lead_details.marketing_status', 0);
        $where = "lead_details.status = 2 OR lead_details.status = 1";
        $this->db->where($where);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getMyLeads() {
        $this->db->select('*');
        $this->db->from('leads');
        $this->db->join('lead_details', 'leads.id = lead_details.lead_id');
        $this->db->join('lead_marketing', 'leads.id = lead_marketing.lead_id');
        $this->db->where('lead_details.marketing_status', 1);
        // $where = "lead_details.status = 2 OR lead_details.status = 1";
        // $this->db->where($where);
        $this->db->where('lead_marketing.marketing_id', $this->session->userdata('userid'));

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getLeadsAgent() {
        $this->db->select('*');
        $this->db->from('leads');
        $this->db->join('lead_details', 'leads.id = lead_details.lead_id');
        $this->db->join('lead_marketing', 'leads.id = lead_marketing.lead_id');
        $this->db->where('lead_details.marketing_status', 1);
        // $where = "lead_details.status = 2 OR lead_details.status = 1";
        // $this->db->where($where);
        $this->db->where('lead_marketing.agent_id', $this->session->userdata('userid'));

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function getAllByRegion($Region_id) {
        $this->db->where('region_id', $Region_id);
        $this->db->where('flag', 0);
        $this->db->where('status', 1);
        $sql = $this->db->get('sales');
        if ($sql->num_rows() > 0) {
            return $sql->result_array();
        } else {
            return false;
        }
    }

    public function getSimilarData($Array, $table) {
        $this->db->like($Array['field'], $Array['value']);

        $sql = $this->db->get($table);
        if ($sql->num_rows() > 0) {
            return $sql->result_array();
        } else {
            return false;
        }
    }

    public function add($Array, $table) {
        if ($this->db->insert($table, $Array)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function edit($Array, $table, $id) {
        $this->db->where('id', $id);
        if ($this->db->update($table, $Array)) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($table, $id) {
        if ($this->db->delete($table, array('id' => $id))) {
            return true;
        } else {
            return false;
        }
    }

    public function enable($table, $id) {
        $this->db->where('id', $id);
        if ($this->db->update($table, array('status' => 1))) {
            return true;
        } else {
            return false;
        }
    }

    public function disable($table, $id) {
        $this->db->where('id', $id);
        if ($this->db->update($table, array('status' => 0))) {
            return true;
        } else {
            return false;
        }
    }

}
