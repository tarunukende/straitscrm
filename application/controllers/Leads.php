<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Leads extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Lead_model');
//        $this->load->library('excel');
    }

//    public function index() {
//        if ($this->session->userdata('logged_in') == 'Admin') {
//            if ($_POST) {
//                $configUpload['upload_path'] = FCPATH . 'uploads/excel/';
//                $configUpload['allowed_types'] = 'xls|xlsx|csv';
//                $configUpload['max_size'] = '5000';
//
//                $this->load->library('upload', $configUpload);
//                $this->upload->do_upload('excelFile');
//                $upload_data = $this->upload->data();
//                $file_name = $upload_data['file_name']; //uploded file name
//                $extension = $upload_data['file_ext'];    // uploded file extension
//
//                $objReader = PHPExcel_IOFactory::createReader('Excel2007'); // For excel 2007
//                //Set to read only
//                $objReader->setReadDataOnly(true);
//
//                //Load excel file
//                $objPHPExcel = $objReader->load(FCPATH . 'uploads/excel/' . $file_name);
//                $totalrows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel
//                $totalcol = $objPHPExcel->setActiveSheetIndex(0)->getHighestColumn();   //Count Numbe of rows avalable in excel
//                $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
//
//                //loop from first data untill last data
//                $count = 0;
//                for ($i = 2; $i <= $totalrows; $i++) {
//                    $Array['name'] = $objWorksheet->getCellByColumnAndRow(0, $i)->getValue();
//                    $Array['mail'] = $objWorksheet->getCellByColumnAndRow(1, $i)->getValue();
//                    $Array['job_title'] = $objWorksheet->getCellByColumnAndRow(2, $i)->getValue();
//                    $Array['company'] = $objWorksheet->getCellByColumnAndRow(3, $i)->getValue();
//                    $Array['phone'] = $objWorksheet->getCellByColumnAndRow(4, $i)->getValue();
//                    $Array['country'] = $objWorksheet->getCellByColumnAndRow(5, $i)->getValue();
//                    $Array['message'] = $objWorksheet->getCellByColumnAndRow(6, $i)->getValue();
//                    $Array['report'] = $objWorksheet->getCellByColumnAndRow(7, $i)->getValue();
//                    $Array['region'] = $objWorksheet->getCellByColumnAndRow(8, $i)->getValue();
//                    $Array['ip'] = $objWorksheet->getCellByColumnAndRow(9, $i)->getValue();
//                    $Array['website'] = $objWorksheet->getCellByColumnAndRow(10, $i)->getValue();
//                    $Array['source'] = $objWorksheet->getCellByColumnAndRow(11, $i)->getValue();
//                    if ($this->Lead_model->add($Array, "leads")) {
//                        $count++;
//                    }
//                }
//                unlink('././uploads/excel/' . $file_name); //File Deleted After uploading in database .
//                if ($count == ($totalrows - 1)) {
//                    $this->session->set_flashdata('msg', $count . ' Leads Uploaded Successfully');
//                    redirect(base_url() . 'leads');
//                } else {
//                    $this->session->set_flashdata('msg', $count . ' Leads Uploaded Successfully');
//                    redirect(base_url() . 'leads');
//                }
//            } else {
//                $data['pagetitle'] = "Upload Leads";
//                $this->load->view('leads/excel_import', $data);
//            }
//        } else {
//            redirect(base_url());
//        }
//    }

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
