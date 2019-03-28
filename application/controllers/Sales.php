<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sales extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('data_model');
		$this->load->model('user_model');
	}

	public function index()
	{
		if ($this->session->userdata('logged_in')=='Admin')
		{
			$data['Records'] = $this->data_model->getAll('sales'); 
			$data['pagetitle'] = 'Sales Executive List';
			$this->load->view('Sales/viewlist', $data);
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
				$region_id="";
				$count=0;
				foreach ($_POST['region_id'] as $value) {
					if ($count==0) {
					$region_id.= $value;	
					}else{
            			$region_id.= ",".$value;
            		}
            		$count++;
        		}
				$_POST['region_id']=$region_id;

				
				if ($this->data_model->add($_POST, 'sales'))
				{
					$rec = $this->data_model->getByCondition(array('field' => 'id', 'value' => $_POST['region_id']), 'lead_exec')[0];
					$rec['count'] +=1;
					// print_r($rec);
					$this->data_model->edit(array('count' => $rec['count']), 'lead_exec', $rec['id']);
					$this->session->set_flashdata('msg', 'Record Added Successfully');
				}
				else
				{
					$this->session->set_flashdata('msg', 'Error Adding Record');
				}
				
				$Array['user'] = $_POST['name'];
				$Array['Email'] = $_POST['email'];
				$Array['Password'] = $pass;
				$Array['Link'] = base_url().'sales_exc';
				
				$this->user_model->sendMail($Array);
				
				redirect(base_url().'sales/add');
			}
			else
			{
				$data['pagetitle'] = 'Add Sales Executive';
				$data['Regions'] =$this->data_model->getAll('regions');
				$this->load->view('Sales/add', $data);
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
				$region_id="";
				$count=0;
				foreach ($_POST['region_id'] as $value) {
					if ($count==0) {
					$region_id.= $value;	
					}else{
            			$region_id.= ",".$value;
            		}
            		$count++;
        		}
				$_POST['region_id']=$region_id;

				if ($this->data_model->edit($_POST, 'sales', $id))
				{
					$this->session->set_flashdata('msg', 'Record Edited Successfully');
				}
				else
				{
					$this->session->set_flashdata('msg', 'Error Editing Record');
				}
				redirect(base_url().'sales/edit/'.$id);
			}
			else
			{
				$data['pagetitle'] = 'Edit Sales Executive';
				$data['Record'] = $this->data_model->getById('sales', $id);
				$data['Regions'] =$this->data_model->getAll('regions');
				$this->load->view('Sales/edit', $data);
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
			if ($this->data_model->delete('sales', $id))
			{
				$this->session->set_flashdata('msg', 'Record Deleted Successfully');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Error Deleting Record');
			}
			redirect(base_url().'sales');
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
			if ($this->data_model->enable('sales', $id))
			{
				$this->session->set_flashdata('msg', 'Record Enabled Successfully');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Error Enabling Record');
			}
			redirect(base_url().'sales');
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
			if ($this->data_model->disable('sales', $id))
			{
				$this->session->set_flashdata('msg', 'Record Disabled Successfully');
			}
			else
			{
				$this->session->set_flashdata('msg', 'Error Disabling Record');
			}
			redirect(base_url().'sales');
		}
		else
		{
			redirect(base_url());
		}
	}
}