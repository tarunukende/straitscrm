<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marketing_exc extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('data_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') == 'Marketing')
		{
			redirect(base_url().'marketing_exc/dashboard');
		}
		else
		{
			if ($_POST)
			{
				// print_r($_POST);
				if ($this->user_model->marketingExeLogin($_POST))
				{
					redirect(base_url().'marketing_exc/dashboard');
				}
				else
				{
					$this->session->set_flashdata('msg', 'Invalid Credentials');
					redirect(base_url().'marketing_exc');
				}
			}
			else
			{
				$data['pagetitle'] = 'Marketing Login';
				$this->load->view('login', $data);
			}
		}
	}

	public function dashboard()
	{
		if ($this->session->userdata('logged_in') == 'Marketing')
		{
			// $new = $this->data_model->getNewLeadsUser();
			// $closed = $this->data_model->getClosedLeadsUser();
			// $current = $this->data_model->getSceduledLeadsUser();
			$data['NewLeads'] = ($this->data_model->getNewLeadsTeam()) ? count($this->data_model->getNewLeadsTeam()) : 0 ;
			$data['MyLeads'] = ($this->data_model->getMyLeads()) ? count($this->data_model->getMyLeads()) : 0 ;
			$data['pagetitle'] = 'Marketing Executive Dashboard';
			
			$this->load->view('Marketing_exc/dashboard', $data);
		}
		else
		{
			redirect(base_url().'marketing_exc');
		}
	}

	public function changePassword()
	{
		if ($this->session->userdata('logged_in') == 'Marketing')
		{
			if ($_POST)
			{
				// print_r($_POST);
				if ($this->user_model->changePassword($_POST, 'marketing') == "Success")
				{

					$this->session->set_flashdata('msg', 'Password Changed Successfully');
					redirect(base_url().'marketing_exc/changePassword');
				}
				elseif($this->user_model->changePassword($_POST, 'marketing') == "NotFound")
				{
					$this->session->set_flashdata('msg', 'Invalid Old Password');
					redirect(base_url().'marketing_exc/changePassword');
				}
				else
				{
					$this->session->set_flashdata('msg', 'Something went wrong Please try again');
					redirect(base_url().'marketing_exc/changePassword');
				}
				
			}
			else
			{
				$data['NewLeads'] = $this->data_model->getByCondition(array('field' =>'seen', 'value'=>'0'), 'leads');
				$data['pagetitle'] = "Change Password";
				$this->load->view('Marketing_exc/changePassword', $data);
			}
		}
		else
		{
			redirect(base_url().'marketing_exc');
		}
		
	}
	
	public function viewlist()
	{
		if ($this->session->userdata('logged_in') == 'Marketing')
		{
			$data['Records'] = $this->data_model->getNewLeadsTeam();
			$data['Teams'] = $this->data_model->getByCondition(array('field' =>'team_lead_id', 'value'=>$this->session->userdata('userid')), 'marketing_agent');
			$data['pagetitle'] = "Current Leads";
			$this->load->view('Marketing_exc/viewlist', $data);
			// print_r($data);
		}
		else
		{
			redirect(base_url().'marketing_exc');
		}
	}

	public function myList()
	{
		if ($this->session->userdata('logged_in') == 'Marketing')
		{
			$data['Records'] = $this->data_model->getMyLeads();
			// $data['Teams'] = $this->data_model->getByCondition(array('field' =>'team_lead_id', 'value'=>$this->session->userdata('userid')), 'marketing_agent');
			$data['pagetitle'] = "My Leads";
			$this->load->view('Marketing_exc/list', $data);
			// print_r($data);
		}
		else
		{
			redirect(base_url().'marketing_exc');
		}
	}

	
	public function edit($leadid, $id, $teamid)
	{
		if ($this->session->userdata('logged_in') == 'Marketing')
		{
			$leaderid = $this->session->userdata('userid');
			if ($teamid == 'Self')
			{
				if ($this->data_model->add(array('lead_id'=> $leadid,'marketing_id' => $id), 'lead_marketing'))
				{
					if ($this->data_model->editLead(array('marketing_status' => 1), 'lead_details', $leadid))
					{
						echo "Record Edited";
					}
					else
					{
						echo "Failed";
					}
				}
				else
				{
					echo "Failed";
				}
			}
			else
			{
				if ($this->data_model->add(array('lead_id'=> $leadid,'marketing_id' => $this->session->userdata('userid'), 'agent_id' => $id), 'lead_marketing'))
				{
					if ($this->data_model->edit(array('marketing_status' => 1), 'lead_details', $leadid))
					{
						echo "Record Edited";
					}
					else
					{
						echo "Failed";
					}
				}
				else
				{
					echo "Failed";
				}
			}
		}
		else
		{
			redirect(base_url().'marketing_exc');
		}
	}	
}