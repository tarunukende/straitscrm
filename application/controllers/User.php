<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('data_model');
    }

    public function index() {
        if ($this->session->userdata('logged_in') == 'Admin') {
            redirect(base_url() . 'dashboard');
        } else {
            if ($_POST) {
                if ($this->user_model->Login($_POST)) {
                    redirect(base_url() . 'dashboard');
                } else {
                    $this->session->set_flashdata('msg', 'Invalid Credentials');
                    redirect(base_url());
                }
            } else {
                $data['pagetitle'] = 'Admin Login';
                $this->load->view('login', $data);
            }
        }
    }

    public function dashboard() {
        if ($this->session->userdata('logged_in') == 'Admin') {
            $data['pagetitle'] = 'Dashboard';
            $this->load->view('dashboard', $data);
        } else {
            redirect(base_url());
        }
    }

    /*public function viewlist($page = 1) {
        if ($this->session->userdata('logged_in') == 'Admin') {
            $per_page = 10;
            $data['pagetitle'] = 'All Leads';
            $limit = array('limit' => $per_page, 'start' => ($per_page * $page) - $per_page);
            $data['Records'] = $this->data_model->getAllLeads($limit);
            if ($data['Records']) {
                $total = $this->data_model->allposts_count();
            } else {
                $total = 0;
            }

            if ($total % $per_page == 0) {
                $data['pages'] = floor(($total / $per_page));
            } else {
                $data['pages'] = floor(($total / $per_page)) + 1;
            }
            if ($total == 0) {
                $data['start'] = 0;
            } else {
                $data['start'] = $limit['start'] + 1;
            }
            if ($total < $limit['start'] + $per_page) {
                $data['end'] = $total;
            } else {
                $data['end'] = $limit['start'] + $per_page;
            }
            $data['total'] = $total;
            $data['current'] = $page;
            $data['page_name'] = "allleads";
            $this->load->view('leads/viewlist', $data);
        } else {
            redirect(base_url());
        }
    }*/

    public function chngExc($sales_id, $id) {
        if ($this->data_model->edit(array('sales_id' => $sales_id), 'lead_sales', $id)) {
            return true;
        } else {
            return false;
        }
    }

    public function details($id) {
        $Record = $this->data_model->getLeadDetails($id);
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
            if ($key != "category_id" && $key != "called" && $key != "created_at" && $key != "sample_shared" && $key != "recording_file" && $key != "followup_no" && $key != "followup_date" && $key != "publisher_id" && $key != "sales_status_id") {
                echo '<div class="col-md-12 col-sm-12">
									<label class="col-md-3 col-sm-4">' . ucfirst($key) . '</label>
									<label class="col-md-9 col-sm-8">' . $value . '</label>
								</div>';
            }

            if ($key == "category_id") {
                echo '<div class="col-md-12 col-sm-12">
									<label class="col-md-3 col-sm-4">Category</label>
									<label class="col-md-9 col-sm-8">' . $this->data_model->getById('category', $Record['category_id'])['name'] . '</label>
								</div>';
            }

            if ($key == "publisher_id") {
                echo '<div class="col-md-12 col-sm-12">
									<label class="col-md-3 col-sm-4">Publisher</label>
									<label class="col-md-9 col-sm-8">' . $this->data_model->getById('publisher', $Record['publisher_id'])['name'] . '</label>
								</div>';
            }

            if ($key == "sales_status_id") {
                echo '<div class="col-md-12 col-sm-12">
									<label class="col-md-3 col-sm-4">Sales Status</label>
									<label class="col-md-9 col-sm-8">' . $this->data_model->getById('sales_status', $Record['sales_status_id'])['name'] . '</label>
								</div>';
            }

            if ($key == "sample_shared") {
                if ($value) {
                    echo '<div class="col-md-12 col-sm-12">
										<label class="col-md-3 col-sm-4">Sample Shared?</label>
										<label class="col-md-9 col-sm-8">Yes</label>
									</div>';
                } else {
                    echo '<div class="col-md-12 col-sm-12">
										<label class="col-md-3 col-sm-4">Sample Shared?</label>
										<label class="col-md-9 col-sm-8">No</label>
									</div>';
                }
            }

            if ($key == "called") {
                if ($value) {
                    echo '<div class="col-md-12 col-sm-12">
										<label class="col-md-3 col-sm-4">Called?</label>
										<label class="col-md-9 col-sm-8">Yes</label>
									</div>';
                } else {
                    echo '<div class="col-md-12 col-sm-12">
										<label class="col-md-3 col-sm-4">Called?</label>
										<label class="col-md-9 col-sm-8">No</label>
									</div>';
                }
            }

            if ($key == "recording_file") {
                if (isset($value)) {
                    echo '<div class="col-md-12 col-sm-12">
										<label class="col-md-3 col-sm-4">Recording File</label>
										<label class="col-md-9 col-sm-8">
											<audio controls>
												<source src="' . base_url() . 'uploads/recordings/' . $value . '" type="audio/mpeg">
											</audio>
										</label>
									</div>';
                }
            }

            if ($key == "created_at") {
                echo '<div class="col-md-12 col-sm-12">
									<label class="col-md-3 col-sm-4">Lead Date</label>
									<label class="col-md-9 col-sm-8">' . date('d M Y h:i a', strtotime($value)) . '</label>
								</div>';
            }

            if ($key == "followup_no") {
                if ($value > 0) {
                    echo '<div class="col-md-12 col-sm-12">
										<label class="col-md-3 col-sm-4">Followup Count</label>
										<label class="col-md-9 col-sm-8">' . $value . '</label>
									</div>';
                }
            }

            if ($key == "followup_date") {
                if ($value > date("Y-m-d H:i:s")) {
                    echo '<div class="col-md-12 col-sm-12">
										<label class="col-md-3 col-sm-4">Followup Date</label>
										<label class="col-md-9 col-sm-8">' . date('d M Y h:i a', strtotime($value)) . '</label>
									</div>';
                }
            }
        }
        echo'</div>
					</p>
				</div>
		  		<div class="modal-footer">';
        echo '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>';
    }

    public function logout($path = '') {
        $this->session->sess_destroy();
        if ($path == 'Admin') {
            redirect(base_url());
        } else {
            redirect(base_url() . '' . $path);
        }
    }

}
