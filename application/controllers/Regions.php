<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Regions extends CI_Controller 
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Regions_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in')=='Admin')
		{
			$data['Records'] = $this->Regions_model->getAll('regions'); 
			$data['pagetitle'] = 'Region List';
			$this->load->view('Regions/viewlist', $data);
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
				$res = $this->Regions_model->add($_POST, 'regions');
				if ($res)
				{
					$Array['region_id'] = $res;
					$this->Regions_model->add($Array, 'lead_exec');
					$this->session->set_flashdata('msg', 'Record Added Successfully');
				}
				else
				{
					$this->session->set_flashdata('msg', 'Error Adding Record');
				}
				
				redirect(base_url().'regions/add');
			}
			else
			{
				$data['pagetitle'] = 'Add Region';
				$this->load->view('Regions/add', $data);
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
				if ($this->Regions_model->edit($_POST, 'regions', $id))
				{
					$this->session->set_flashdata('msg', 'Record Edited Successfully');
				}
				else
				{
					$this->session->set_flashdata('msg', 'Error Editing Record');
				}
				redirect(base_url().'regions/edit/'.$id);
			}
			else
			{
				$data['pagetitle'] = 'Edit Region';
				$data['Record'] = $this->Regions_model->getById('regions', $id);
				$this->load->view('Regions/edit', $data);
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
			if ($this->Regions_model->delete('regions', $id))
			{
				$this->session->set_flashdata('msg', 'Record Deleted Successfully');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Error Deleting Record');
			}
			redirect(base_url().'regions');
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
			if ($this->Regions_model->enable('regions', $id))
			{
				$this->session->set_flashdata('msg', 'Record Enabled Successfully');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Error Enabling Record');
			}
			redirect(base_url().'regions');
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
			if ($this->Regions_model->disable('regions', $id))
			{
				$this->session->set_flashdata('msg', 'Record Disabled Successfully');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Error Disabling Record');
			}
			redirect(base_url().'regions');
		}
		else
		{
			redirect(base_url());
		}
	}
}