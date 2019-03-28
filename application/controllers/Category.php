<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller 
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Category_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in')=='Admin')
		{
			$data['Records'] = $this->Category_model->getAll('category'); 
			$data['pagetitle'] = 'Category List';
			$this->load->view('Category/viewlist', $data);
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
				if ($this->Category_model->add($_POST, 'category'))
				{
					$this->session->set_flashdata('msg', 'Record Added Successfully');
				}
				else
				{
					$this->session->set_flashdata('msg', 'Error Adding Record');
				}
				
				redirect(base_url().'category/add');
			}
			else
			{
				$data['pagetitle'] = 'Add Category';
				$this->load->view('Category/add', $data);
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
				if ($this->Category_model->edit($_POST, 'category', $id))
				{
					$this->session->set_flashdata('msg', 'Record Edited Successfully');
				}
				else
				{
					$this->session->set_flashdata('msg', 'Error Editing Record');
				}
				redirect(base_url().'category/edit/'.$id);
			}
			else
			{
				$data['pagetitle'] = 'Edit Category';
				$data['Record'] = $this->Category_model->getById('category', $id);
				$this->load->view('Category/edit', $data);
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
			if ($this->Category_model->delete('category', $id))
			{
				$this->session->set_flashdata('msg', 'Record Deleted Successfully');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Error Deleting Record');
			}
			redirect(base_url().'category');
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
			if ($this->Category_model->enable('category', $id))
			{
				$this->session->set_flashdata('msg', 'Record Enabled Successfully');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Error Enabling Record');
			}
			redirect(base_url().'category');
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
			if ($this->Category_model->disable('category', $id))
			{
				$this->session->set_flashdata('msg', 'Record Disabled Successfully');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Error Disabling Record');
			}
			redirect(base_url().'category');
		}
		else
		{
			redirect(base_url());
		}
	}
}