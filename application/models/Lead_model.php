<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Lead_model extends CI_Model {

    public function __construct() {

        parent::__construct();
    }

    function allposts_count() {
        $query = $this
                ->db
                ->from('leads')
//                ->join('lead_sales', 'lead_sales.lead_id = leads.id')
//                ->where('lead_sales.sales_id', $this->session->userdata('userid'))
                ->get();

        return $query->num_rows();
    }

    public function getAll($tbl) {
        $sql = $this->db->get($tbl);
        if ($sql->num_rows() > 0) {
            return $sql->result_array();
        } else {
            return false;
        }
    }

    public function getAllLeads($limit, $start, $col, $dir) {

        $this->db->select('leads.id, leads.name, leads.country, leads.message, leads.report,leads.mail,  lead_sales.status as status,leads.website, leads.created_at,lead_sales.sales_id, lead_sales.id as sid,sales.name as executive_name');
        $this->db->from('leads');
        $this->db->join('lead_sales', 'lead_sales.lead_id = leads.id', "left");
        $this->db->join('sales', 'sales.id = lead_sales.sales_id');
//        $this->db->where('lead_sales.sales_id', $this->session->userdata('userid'));
        if ($col) {
            if ($col == "id") {
                $this->db->order_by($col, 'DESC');
            } else {
                $this->db->order_by($col, $dir);
            }
        } else {
            $this->db->order_by('created_at', 'DESC');
        }

        $this->db->limit($limit, $start);
        $sql = $this->db->get();
//        echo $this->db->last_query();
        if ($sql->num_rows() > 0) {
            return $sql->result();
        } else {
            return null;
        }
    }

    function allposts($limit, $start, $col, $dir) {
        $query = $this
                ->db
                ->limit($limit, $start)
                ->order_by($col, 'DESC')
                ->get('leads');

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function posts_search($limit, $start, $search, $col, $dir) {
        $this->db->select('leads.id, leads.name, leads.country, leads.message, leads.report,leads.mail,  lead_sales.status status,leads.website, leads.created_at,lead_sales.sales_id, lead_sales.id as sid,sales.name as executive_name');
        $this->db->from('leads');
        $this->db->join('lead_sales', 'lead_sales.lead_id = leads.id');
        $this->db->join('sales', 'sales.id = lead_sales.sales_id');
//        $this->db->where('lead_sales.sales_id', $this->session->userdata('userid'));
//        $this->db->like('leads.id', $search);
        $this->db->like('leads.name', $search);
        $this->db->or_like('leads.country', $search);
        if ($col) {
            if ($col == "id") {
                $this->db->order_by($col, 'DESC');
            } else {
                $this->db->order_by($col, $dir);
            }
        } else {
            $this->db->order_by('created_at', 'DESC');
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function posts_search_count($search = "") {

        $query = $this
                ->db
                ->from('leads')
//                ->join('lead_sales', 'lead_sales.lead_id = leads.id')
//                ->where('lead_sales.sales_id', $this->session->userdata('userid'))
                ->like('leads.name', $search)
                ->or_like('leads.country', $search)
                ->get();
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

    public function getById($table, $id) {
        $this->db->where('id', $id);

        $sql = $this->db->get($table);
        if ($sql->num_rows() == 1) {
            return $sql->result_array()[0];
        } else {
            return false;
        }
    }

}
