<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sales_leads extends CI_Model {

    public function __construct() {

        parent::__construct();
    }

    function allposts_count($status) {
        $query = $this
                ->db
                ->from('leads')
                ->join('lead_sales', 'leads.id = lead_sales.lead_id')
                ->where('lead_sales.sales_id', $this->session->userdata('userid'))
                ->where('lead_sales.status', $status)
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

    public function getAllLeads($limit, $start, $col, $dir, $status) {

        $this->db->select('leads.id, leads.name, leads.country, leads.message, leads.report,leads.mail,  lead_sales.status,leads.website, leads.created_at,lead_sales.sales_id, lead_sales.id as sid');
        $this->db->from('leads');
        $this->db->join('lead_sales', 'leads.id = lead_sales.lead_id');
        $this->db->where('lead_sales.sales_id', $this->session->userdata('userid'));
        $this->db->where('lead_sales.status', $status);
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

    function posts_search($limit, $start, $search, $col, $dir, $status) {
        $this->db->select('leads.id, leads.name, leads.country, leads.message, leads.report,leads.mail,  lead_sales.status,leads.website, leads.created_at,lead_sales.sales_id, lead_sales.id as sid');
        $this->db->from('leads');
        $this->db->join('lead_sales', 'leads.id = lead_sales.lead_id');
        $this->db->where('lead_sales.sales_id', $this->session->userdata('userid'));
        $this->db->where('lead_sales.status', $status);
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

    function posts_search_count($search = "", $status) {

        $query = $this
                ->db
                ->from('leads')
                ->join('lead_sales', 'leads.id = lead_sales.lead_id')
                ->where('lead_sales.sales_id', $this->session->userdata('userid'))
                ->where('lead_sales.status', $status)
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

}
