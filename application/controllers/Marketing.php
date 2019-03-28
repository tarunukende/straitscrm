<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marketing extends CI_Controller 
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Marketing_model');
		$this->load->model('user_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in')=='Admin')
		{
			$data['Records'] = $this->Marketing_model->getAll('marketing'); 
			$data['pagetitle'] = 'Marketing team leader List';
			$this->load->view('Marketing/viewlist', $data);
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
				
				if ($this->Marketing_model->add($_POST, 'marketing'))
				{
					$this->session->set_flashdata('msg', 'Record Added Successfully');
				}
				else
				{
					$this->session->set_flashdata('msg', 'Error Adding Record');
				}
				
				$Array['user'] = $_POST['name'];
				$Array['Email'] = $_POST['email'];
				$Array['Password'] = $pass;
				$Array['Link'] = base_url().'marketing_exc';
				
				$this->user_model->sendMail($Array);
				
				redirect(base_url().'marketing/add');
			}
			else
			{
				$data['pagetitle'] = 'Add Marketing Executive';
				$data['Regions'] =$this->Marketing_model->getAll('regions');
				$this->load->view('Marketing/add', $data);
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
				if ($this->Marketing_model->edit($_POST, 'marketing', $id))
				{
					$this->session->set_flashdata('msg', 'Record Edited Successfully');
				}
				else
				{
					$this->session->set_flashdata('msg', 'Error Editing Record');
				}
				redirect(base_url().'marketing/edit/'.$id);
			}
			else
			{
				$data['pagetitle'] = 'Edit Marketing Executive';
				$data['Record'] = $this->Marketing_model->getById('marketing', $id);
				$data['Regions'] =$this->Marketing_model->getAll('regions');
				$this->load->view('Marketing/edit', $data);
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
			if ($this->Marketing_model->delete('marketing', $id))
			{
				$this->session->set_flashdata('msg', 'Record Deleted Successfully');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Error Deleting Record');
			}
			redirect(base_url().'marketing');
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
			if ($this->Marketing_model->enable('marketing', $id))
			{
				$this->session->set_flashdata('msg', 'Record Enabled Successfully');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Error Enabling Record');
			}
			redirect(base_url().'marketing');
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
			if ($this->Marketing_model->disable('marketing', $id))
			{
				$this->session->set_flashdata('msg', 'Record Disabled Successfully');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Error Disabling Record');
			}
			redirect(base_url().'marketing');
		}
		else
		{
			redirect(base_url());
		}
	}
}