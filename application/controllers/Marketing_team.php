<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marketing_team extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->model('data_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in') == 'Marketing_team')
		{
			redirect(base_url().'marketing_team/dashboard');
		}
		else
		{
			if ($_POST)
			{
				// print_r($_POST);
				if ($this->user_model->marketingAgentLogin($_POST))
				{
					redirect(base_url().'marketing_team/dashboard');
				}
				else
				{
					$this->session->set_flashdata('msg', 'Invalid Credentials');
					redirect(base_url().'marketing_team');
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
		if ($this->session->userdata('logged_in') == 'Marketing_team')
		{
			$data['MyLeads'] = ($this->data_model->getLeadsAgent()) ? count($this->data_model->getLeadsAgent()) : 0 ;
			$data['pagetitle'] = 'Marketing Executive Dashboard';
			$this->load->view('Marketing_team/dashboard', $data);
		}
		else
		{
			redirect(base_url().'marketing_team');
		}
	}

	public function changePassword()
	{
		if ($this->session->userdata('logged_in') == 'Marketing_team')
		{
			if ($_POST)
			{
				// print_r($_POST);
				if ($this->user_model->changePassword($_POST, 'marketing') == "Success")
				{

					$this->session->set_flashdata('msg', 'Password Changed Successfully');
					redirect(base_url().'marketing_team/changePassword');
				}
				elseif($this->user_model->changePassword($_POST, 'marketing') == "NotFound")
				{
					$this->session->set_flashdata('msg', 'Invalid Old Password');
					redirect(base_url().'marketing_team/changePassword');
				}
				else
				{
					$this->session->set_flashdata('msg', 'Something went wrong Please try again');
					redirect(base_url().'marketing_team/changePassword');
				}
				
			}
			else
			{
				$data['NewLeads'] = $this->data_model->getByCondition(array('field' =>'seen', 'value'=>'0'), 'leads');
				$data['pagetitle'] = "Change Password";
				$this->load->view('Marketing_team/changePassword', $data);
			}
		}
		else
		{
			redirect(base_url().'marketing_team');
		}
		
	}
	
	public function myList()
	{
		if ($this->session->userdata('logged_in') == 'Marketing_team')
		{
			$data['Records'] = $this->data_model->getLeadsAgent();
			$data['pagetitle'] = "My Leads";
			$this->load->view('Marketing_team/viewlist', $data);
		}
		else
		{
			redirect(base_url().'marketing_team');
		}
	}
}