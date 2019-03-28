<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Publisher extends CI_Controller 
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Publisher_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in')=='Admin')
		{
			$data['Records'] = $this->Publisher_model->getAll('publisher'); 
			$data['pagetitle'] = 'Publisher List';
			$this->load->view('Publisher/viewlist', $data);
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
				if ($this->Publisher_model->add($_POST, 'publisher'))
				{
					$this->session->set_flashdata('msg', 'Record Added Successfully');
				}
				else
				{
					$this->session->set_flashdata('msg', 'Error Adding Record');
				}
				
				redirect(base_url().'publisher/add');
			}
			else
			{
				$data['pagetitle'] = 'Add Publisher';
				$this->load->view('Publisher/add', $data);
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
				if ($this->Publisher_model->edit($_POST, 'publisher', $id))
				{
					$this->session->set_flashdata('msg', 'Record Edited Successfully');
				}
				else
				{
					$this->session->set_flashdata('msg', 'Error Editing Record');
				}
				redirect(base_url().'publisher/edit/'.$id);
			}
			else
			{
				$data['pagetitle'] = 'Edit Publisher';
				$data['Record'] = $this->Publisher_model->getById('publisher', $id);
				$this->load->view('Publisher/edit', $data);
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
			if ($this->Publisher_model->delete('publisher', $id))
			{
				$this->session->set_flashdata('msg', 'Record Deleted Successfully');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Error Deleting Record');
			}
			redirect(base_url().'publisher');
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
			if ($this->Publisher_model->enable('publisher', $id))
			{
				$this->session->set_flashdata('msg', 'Record Enabled Successfully');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Error Enabling Record');
			}
			redirect(base_url().'publisher');
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
			if ($this->Publisher_model->disable('publisher', $id))
			{
				$this->session->set_flashdata('msg', 'Record Disabled Successfully');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Error Disabling Record');
			}
			redirect(base_url().'publisher');
		}
		else
		{
			redirect(base_url());
		}
	}
}