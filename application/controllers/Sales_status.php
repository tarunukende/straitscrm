<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_status extends CI_Controller 
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Salesstatus_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in')=='Admin')
		{
			$data['Records'] = $this->Salesstatus_model->getAll('sales_status'); 
			$data['pagetitle'] = 'Sales Status List';
			$this->load->view('Sales_status/viewlist', $data);
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
				if ($this->Salesstatus_model->add($_POST, 'sales_status'))
				{
					$this->session->set_flashdata('msg', 'Record Added Successfully');
				}
				else
				{
					$this->session->set_flashdata('msg', 'Error Adding Record');
				}
				
				redirect(base_url().'sales_status/add');
			}
			else
			{
				$data['pagetitle'] = 'Add Sales Status';
				$this->load->view('Sales_status/add', $data);
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
				if ($this->Salesstatus_model->edit($_POST, 'sales_status', $id))
				{
					$this->session->set_flashdata('msg', 'Record Edited Successfully');
				}
				else
				{
					$this->session->set_flashdata('msg', 'Error Editing Record');
				}
				redirect(base_url().'sales_status/edit/'.$id);
			}
			else
			{
				$data['pagetitle'] = 'Edit Sales Status';
				$data['Record'] = $this->Salesstatus_model->getById('sales_status', $id);
				$this->load->view('Sales_status/edit', $data);
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
			if ($this->Salesstatus_model->delete('sales_status', $id))
			{
				$this->session->set_flashdata('msg', 'Record Deleted Successfully');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Error Deleting Record');
			}
			redirect(base_url().'sales_status');
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
			if ($this->Salesstatus_model->enable('sales_status', $id))
			{
				$this->session->set_flashdata('msg', 'Record Enabled Successfully');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Error Enabling Record');
			}
			redirect(base_url().'sales_status');
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
			if ($this->Salesstatus_model->disable('sales_status', $id))
			{
				$this->session->set_flashdata('msg', 'Record Disabled Successfully');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Error Disabling Record');
			}
			redirect(base_url().'sales_status');
		}
		else
		{
			redirect(base_url());
		}
	}
}