<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marketing_agent extends CI_Controller 
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Marketingagent_model');
		$this->load->model('user_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in')=='Admin')
		{
			$data['Records'] = $this->Marketingagent_model->getAll('marketing_agent'); 
			$data['pagetitle'] = 'Marketing Executive List';
			$this->load->view('Marketing_agent/viewlist', $data);
		}
		else
		{
			redirect(base_url());
		}
	}

	public function add()
	{
		if ($this->session->userdata('logged_in')=='Admin')
		{
			if ($_POST)
			{
				$pass = $_POST['password'];
				$_POST['password'] = hash('sha256', $_POST['password']);
				
				if ($this->Marketingagent_model->add($_POST, 'marketing_agent'))
				{
					$this->session->set_flashdata('msg', 'Record Added Successfully');
				}
				else
				{
					$this->session->set_flashdata('msg', 'Error Adding Record');
				}
				
				// $Array['user'] = $_POST['name'];
				// $Array['Email'] = $_POST['email'];
				// $Array['Password'] = $pass;
				// $Array['Link'] = 'http://localhost/CRM/marketing_exc';
				
				// $this->user_model->sendMail($Array);
				
				redirect(base_url().'marketing_agent/add');
			}
			else
			{
				$data['pagetitle'] = 'Add Marketing Executive';
				$data['Leaders'] = $this->Marketingagent_model->getAll('marketing');
				$this->load->view('Marketing_agent/add', $data);
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function edit($id)
	{
		if ($this->session->userdata('logged_in')=='Admin')
		{
			if ($_POST)
			{
				if ($this->Marketingagent_model->edit($_POST, 'marketing_agent', $id))
				{
					$this->session->set_flashdata('msg', 'Record Edited Successfully');
				}
				else
				{
					$this->session->set_flashdata('msg', 'Error Editing Record');
				}
				redirect(base_url().'marketing_agent/edit/'.$id);
			}
			else
			{
				$data['pagetitle'] = 'Edit Marketing Executive';
				$data['Record'] = $this->Marketingagent_model->getById('marketing_agent', $id);
				$this->load->view('Marketing_agent/edit', $data);
			}
		}
		else
		{
			redirect(base_url());
		}
	}

	public function delete($id)
	{
		if ($this->session->userdata('logged_in')=='Admin')
		{
			if ($this->Marketingagent_model->delete('marketing_agent', $id))
			{
				$this->session->set_flashdata('msg', 'Record Deleted Successfully');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Error Deleting Record');
			}
			redirect(base_url().'marketing_agent');
		}
		else
		{
			redirect(base_url());
		}
	}

	public function enable($id)
	{
		if ($this->session->userdata('logged_in')=='Admin')
		{
			if ($this->Marketingagent_model->enable('marketing_agent', $id))
			{
				$this->session->set_flashdata('msg', 'Record Enabled Successfully');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Error Enabling Record');
			}
			redirect(base_url().'marketing_agent');
		}
		else
		{
			redirect(base_url());
		}
	}

	public function disable($id)
	{
		if ($this->session->userdata('logged_in')=='Admin')
		{
			if ($this->Marketingagent_model->disable('marketing_agent', $id))
			{
				$this->session->set_flashdata('msg', 'Record Disabled Successfully');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Error Disabling Record');
			}
			redirect(base_url().'marketing_agent');
		}
		else
		{
			redirect(base_url());
		}
	}
}