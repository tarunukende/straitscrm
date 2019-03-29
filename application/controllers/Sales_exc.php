<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_exc extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('data_model');
        $this->load->model('Sales_leads');
    }

    public function index() {
        if ($this->session->userdata('logged_in') == 'Sales') {
            redirect(base_url() . 'Sales_exc/dashboard');
        } else {
            if ($_POST) {
                // print_r($_POST);
                if ($this->user_model->salesExeLogin($_POST)) {
                    redirect(base_url() . 'sales_exc/dashboard');
                } else {
                    $this->session->set_flashdata('msg', 'Invalid Credentials');
                    redirect(base_url() . 'sales_exc');
                }
            } else {
                $data['pagetitle'] = 'Sales Login';
                $this->load->view('login', $data);
            }
        }
    }

    public function dashboard() {
        if ($this->session->userdata('logged_in') == 'Sales') {
            $new = $this->data_model->getNewLeadsUser();
            $closed = $this->data_model->getClosedLeadsUser();
            $current = $this->data_model->getSceduledLeadsUser();
            $data['NewLeads'] = $this->data_model->getNotificationUser();
            $data['pagetitle'] = 'Sales Executive Dashboard';
            $data['pagesubtitle'] = 'New Leads';
            $data['new'] = ($new) ? count($new) : 0;
            $data['closed'] = ($closed) ? count($closed) : 0;
            $data['current'] = ($current) ? count($current) : 0;
            $data['status'] = "0";
            $this->load->view('Sales_exc/dashboard', $data);
        } else {
            redirect(base_url());
        }
    }

    public function viewlist() {
        if ($this->session->userdata('logged_in') == 'Sales') {
            $new = $this->data_model->getNewLeadsUser();
            $closed = $this->data_model->getClosedLeadsUser();
            $current = $this->data_model->getSceduledLeadsUser();
            $data['NewLeads'] = $this->data_model->getNotificationUser();
            $data['pagetitle'] = 'Sales Executive Dashboard';
            $data['pagesubtitle'] = 'New Leads';
            $data['new'] = ($new) ? count($new) : 0;
            $data['closed'] = ($closed) ? count($closed) : 0;
            $data['current'] = ($current) ? count($current) : 0;
            $data['NewLeads'] = $this->data_model->getNotificationUser();
            $data['status'] = "0";
            $this->load->view('Sales_exc/dashboard', $data);
            // print_r($data);
        } else {
            redirect(base_url());
        }
    }

    public function closedList() {
        if ($this->session->userdata('logged_in') == 'Sales') {
            $new = $this->data_model->getNewLeadsUser();
            $closed = $this->data_model->getClosedLeadsUser();
            $current = $this->data_model->getSceduledLeadsUser();
            $data['NewLeads'] = $this->data_model->getNotificationUser();
            $data['pagetitle'] = 'Sales Executive Dashboard';
            $data['pagesubtitle'] = 'Closed Leads';
            $data['new'] = ($new) ? count($new) : 0;
            $data['closed'] = ($closed) ? count($closed) : 0;
            $data['current'] = ($current) ? count($current) : 0;
            $data['NewLeads'] = $this->data_model->getNotificationUser();
            $data['status'] = "2";
            $this->load->view('Sales_exc/dashboard', $data);
            // print_r($data);
        } else {
            redirect(base_url());
        }
    }

    public function currentList() {
        if ($this->session->userdata('logged_in') == 'Sales') {
            $new = $this->data_model->getNewLeadsUser();
            $closed = $this->data_model->getClosedLeadsUser();
            $current = $this->data_model->getSceduledLeadsUser();
            $data['NewLeads'] = $this->data_model->getNotificationUser();
            $data['pagetitle'] = 'Sales Executive Dashboard';
            $data['pagesubtitle'] = 'Current Leads';
            $data['new'] = ($new) ? count($new) : 0;
            $data['closed'] = ($closed) ? count($closed) : 0;
            $data['current'] = ($current) ? count($current) : 0;
            $data['NewLeads'] = $this->data_model->getNotificationUser();
            $data['status'] = "1";
            $this->load->view('Sales_exc/dashboard', $data);
            // print_r($data);
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
            7 => 'status',
            8 => 'executive_list',
            9 => 'action'
        );

        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];



        $statusVal = $this->input->post('statusVal') != "" ? $this->input->post('statusVal') : "0";
        $totalData = $this->Sales_leads->allposts_count($statusVal);
        $totalFiltered = $totalData;
        if (empty($this->input->post('search')['value'])) {
            $posts = $this->Sales_leads->getAllLeads($limit, $start, $order, $dir, $statusVal);
        } else {

            $search = $this->input->post('search')['value'];

            $posts = $this->Sales_leads->posts_search($limit, $start, $search, $order, $dir, $statusVal);

            $totalFiltered = $this->Sales_leads->posts_search_count($search, $statusVal);
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
                $nestedData['status'] = $status;
                $nestedData['action'] = $action;
                $nestedData['executive_list'] = "<select lead-id='" . $post->id . "' sale-id='" . $post->sales_id . "'  data-id='" . $post->sid . "' class='target executive-for-drp'></select>";
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

    public function getAllexecutive() {
        $json_data = $this->data_model->getAllActive('sales');
//        $json_data = array("data" => $data);
        echo json_encode($json_data);
    }

    public function getAllactiveExecutive() {
        $json_data = $this->data_model->getAllActive('sales');
//        $json_data = array("data" => $data);
        echo json_encode($json_data);
    }

    public function changePassword() {
        if ($this->session->userdata('logged_in') == 'Sales') {
            if ($_POST) {
                // print_r($_POST);
                if ($this->user_model->changePassword($_POST, 'sales') == "Success") {

                    $this->session->set_flashdata('msg', 'Password Changed Successfully');
                    redirect(base_url() . 'sales_exc/changePassword');
                } elseif ($this->user_model->changePassword($_POST, 'sales') == "NotFound") {
                    $this->session->set_flashdata('msg', 'Invalid Old Password');
                    redirect(base_url() . 'sales_exc/changePassword');
                } else {
                    $this->session->set_flashdata('msg', 'Something went wrong Please try again');
                    redirect(base_url() . 'sales_exc/changePassword');
                }
            } else {
                $data['NewLeads'] = $this->data_model->getNotificationUser();
                $data['pagetitle'] = "Change Password";
                $this->load->view('Sales_exc/changePassword', $data);
            }
        } else {
            
        }
    }

    public function details($id, $status) {
        $this->data_model->edit(array('seen' => 1), 'leads', $id);
        if ($status == 2) {
            $Record = $this->data_model->getById('leads', $id);
        } else {
            $Record = $this->data_model->getById('leads', $id);
        }
        echo '<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Lead Detaile</h4>
				</div>
				<div class="modal-body">
					<p>
						<div class="row">';
        foreach ($Record as $key => $value) {
            if ($key != "id" && $key != "seen" && $key != "created_at") {
                echo '<div class="col-md-12 col-sm-12">
									<label class="col-md-3 col-sm-4">' . ucfirst($key) . '</label>
									<label class="col-md-9 col-sm-8">' . $value . '</label>
								</div>';
            }
            if ($key == "created_at") {
                echo '<div class="col-md-12 col-sm-12">
									<label class="col-md-3 col-sm-4">Lead Date</label>
									<label class="col-md-9 col-sm-8">' . date('d M Y h:i a', strtotime($value)) . '</label>
								</div>';
            }
        }
        echo'</div>
					</p>
				</div>
		  		<div class="modal-footer">';
        if ($status != 2) {
            echo'<a href="' . base_url() . 'sales_exc/edit/' . $id . '" type="button" class="btn btn-primary">Edit Lead</a>';
        }
        echo '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>';
    }

    public function followUp() {
        if ($this->session->userdata('logged_in') == 'Sales') {
            $data['Records'] = $this->data_model->getLeads_followup();
            $data['NewLeads'] = $this->data_model->getNotificationUser();
            $data['pagetitle'] = "follow Up Leads";
            $this->load->view('Sales_exc/followup', $data);
            //print_r($data['Records']);
        } else {
            redirect(base_url());
        }
    }

    public function followupDetails($id) {
        if ($this->session->userdata('logged_in') == 'Sales') {
            $data['Records'] = $this->data_model->getlead_details($id);
            $data['NewLeads'] = $this->data_model->getNotificationUser();
            $data['pagetitle'] = "follow Up Leads Details";
            $this->load->view('Sales_exc/followup', $data);
        } else {
            redirect(base_url());
        }
    }

    public function edit($id) {
        if ($this->session->userdata('logged_in') == 'Sales') {
            if ($_POST) {
                $config['upload_path'] = './uploads/recordings';
                $config['allowed_types'] = 'mp3|wav|aif|aiff|ogg';
                $config['max_size'] = 32768;
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('recording_file')) {
                    $_POST['recording_file'] = $this->upload->data()['file_name'];
                } else {
                    $_POST['recording_file'] = NULL;
                }
                $_POST['followup_date'] = date("Y-m-d", strtotime($_POST['followup_date']));
                if ($_POST['followup']) {
                    $_POST['status'] = 1;
                    unset($_POST['followup']);
                } else {
                    $_POST['followup_no'] = NULL;
                    $_POST['followup_date'] = NULL;
                    unset($_POST['followup']);
                    $_POST['status'] = 2;
                }

                $_POST['lead_id'] = $id;
                $saleslead = $this->data_model->getsaleslead_id($id);
                if ($this->data_model->add($_POST, 'lead_details')) {
                    $this->session->set_flashdata('msg', 'Record Edited Successfully');
                    $this->data_model->edit(array('status' => $_POST['status']), 'lead_sales', $saleslead['id']);
                } else {
                    $this->session->set_flashdata('msg', 'Error Editing Record');
                }
                redirect(base_url() . 'sales_exc/dashboard');
            } else {

                $data['Record'] = $this->data_model->getById('leads', $id);
                $data['NewLeads'] = $this->data_model->getNotificationUser();
                $data['pagetitle'] = "Edit Lead";
                $data['categories'] = $this->data_model->getByCondition(array('field' => 'status', 'value' => 1), 'category');
                $data['Publishers'] = $this->data_model->getByCondition(array('field' => 'status', 'value' => 1), 'publisher');
                $data['sales_status'] = $this->data_model->getByCondition(array('field' => 'status', 'value' => 1), 'sales_status');

                $this->load->view('Sales_exc/edit', $data);
            }
        } else {
            redirect(base_url());
        }
    }

}
