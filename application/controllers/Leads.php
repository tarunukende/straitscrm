<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Leads extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Lead_model');
    }

    public function add($Array, $table) {
        if ($this->db->insert($table, $Array)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    /* Lead Listing */

    public function viewlist() {
        if ($this->session->userdata('logged_in') == 'Admin') {
            $data['pagetitle'] = 'All Leads';
            $data['status'] = '0';
            $this->load->view("Leads/leadlist", $data);
        } else {
            redirect(base_url());
        }
    }

    public function ajaxList() {
        $columns = array(
            0 => 'id',
            1 => 'name',
            2 => 'country',
            3 => 'message',
            4 => 'report',
            5 => 'website',
            6 => 'created_at',
//            7 => 'status',
            7 => 'executive_list',
            8 => 'action'
        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];



        $statusVal = $this->input->post('statusVal') != "" ? $this->input->post('statusVal') : "0";
        $totalData = $this->Lead_model->allposts_count();
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = $this->Lead_model->getAllLeads($limit, $start, $order, $dir);
        } else {

            $search = $this->input->post('search')['value'];

            $posts = $this->Lead_model->posts_search($limit, $start, $search, $order, $dir);

            $totalFiltered = $this->Lead_model->posts_search_count($search);
        }
        $data = array();
        $executive_list = "data";
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $status = "";
                $action = '<a class="details" href="javascript:void(0);" data-status="' . $post->id . '" data-id="' . $post->id . '" data-toggle="tooltip" data-placement="bottom" title="View"> <i class="fa fa-eye"></i></a>';
                if ($post->status == 0) {
                    $status = "Pending";
                    $action .= " ";
                } elseif ($post->status == 1) {
                    $status = "Rescheduled";
                } elseif ($post->status == 2) {
                    $status = "Closed";
                    $action .= ' <a class="edit" href="javascript:void(0);" data-id="' . $post->id . '" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i>';
                } elseif ($post->status == 3) {
                    $status = "Reopened";
                }
                $nestedData['id'] = $post->id;
                $nestedData['name'] = $post->name;
                $nestedData['country'] = $post->country;
                $nestedData['message'] = $post->message;
                $nestedData['report'] = substr($post->report, 0, 50);
                $nestedData['website'] = $post->website;
                $nestedData['created_at'] = date('d M Y h:i a', strtotime($post->created_at));
//                $nestedData['status'] = $status;
                $nestedData['action'] = $action;
                $nestedData['executive_list'] = $post->executive_name . "<br/> assign to :<select lead-id='" . $post->id . "' sale-id='" . $post->sales_id . "'  data-id='" . $post->sid . "' class='target executive-for-drp'></select>";
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($this->input->post('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data
        );

        echo json_encode($json_data);
    }

}
