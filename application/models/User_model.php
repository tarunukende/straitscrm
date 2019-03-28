<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}

	public function Login($Array)
	{
		$username = $this->security->xss_clean($Array['Login_id']);
		$password = hash('sha512', $this->security->xss_clean($Array['Password']));
		// Prep the query
		$this->db->where('user_name', $username);
		$this->db->where('password', $password);
		
		// Run the query
		$query = $this->db->get('admin');
		
		// Let's check if there are any results
		if($query->num_rows() == 1)
		{
			$newdata = array(
				'userid'  => $query->result_array()[0]['id'],
				'name'  => 'Admin',
				'logged_in' => 'Admin'
			);
			$this->session->set_userdata($newdata);
			return true;
		}
		else
		{
			return false;
		}
	}

	public function salesExeLogin($Array)
	{
		$username = $this->security->xss_clean($Array['Login_id']);
		$password = hash('sha256', $this->security->xss_clean($Array['Password']));
		// Prep the query
		$this->db->where('email', $username);
		$this->db->where('password', $password);
		
		// Run the query
		$query = $this->db->get('sales');
		
		// Let's check if there are any results
		if($query->num_rows() == 1)
		{
			$newdata = array(
				'userid'  => $query->result_array()[0]['id'],
				'name'  => $query->result_array()[0]['name'] ,
				'logged_in' => 'Sales'
			);
			$this->session->set_userdata($newdata);
			return true;
		}
		else
		{
			return false;
		}
	}

	public function marketingExeLogin($Array)
	{
		$username = $this->security->xss_clean($Array['Login_id']);
		$password = hash('sha256', $this->security->xss_clean($Array['Password']));

		// Prep the query
		$this->db->where('email', $username);
		$this->db->where('password', $password);
		
		// Run the query
		$query = $this->db->get('marketing');
		
		// Let's check if there are any results
		if($query->num_rows() == 1)
		{
			$newdata = array(
				'userid'  => $query->result_array()[0]['id'],
				'name'  => $query->result_array()[0]['name'] ,
				'logged_in' => 'Marketing'
			);
			$this->session->set_userdata($newdata);
			return true;
		}
		else
		{
			return false;
		}
	}

	public function marketingAgentLogin($Array)
	{
		$username = $this->security->xss_clean($Array['Login_id']);
		$password = hash('sha256', $this->security->xss_clean($Array['Password']));

		// Prep the query
		$this->db->where('email', $username);
		$this->db->where('password', $password);
		
		// Run the query
		$query = $this->db->get('marketing_agent');
		
		// Let's check if there are any results
		if($query->num_rows() == 1)
		{
			$newdata = array(
				'userid'  => $query->result_array()[0]['id'],
				'name'  => $query->result_array()[0]['name'] ,
				'logged_in' => 'Marketing_team'
			);
			$this->session->set_userdata($newdata);
			return true;
		}
		else
		{
			return false;
		}
	}

	public function changePassword($Array, $table)
	{
		$id = $this->session->userdata('userid');
		$password = hash('sha256', $this->security->xss_clean($Array['old_pwd']));
		$new = hash('sha256', $this->security->xss_clean($Array['new_pwd']));

		
		// Prep the query
		$this->db->where('id', $id);
		$this->db->where('password', $password);
		
		// Run the query
		$query = $this->db->get($table);
		
		// Let's check if there are any results
		if($query->num_rows() == 1)
		{
			$this->db->where('id', $id);
			if ($this->db->update($table, array('password' => $new)))
			{
				return 'Success';
			}
			else
			{
				return 'Failed';
			}
		}
		else
		{
			return 'NotFound';
		}
	}

	public function sendMail($Array)
	{
		//Load email library
		$this->load->library('email');
		// $this->load->library('encrypt');

		//SMTP & mail configuration
		$config = array(
			'protocol'  => 'smtp',
			'smtp_host' => 'ssl://smtp.gmail.com',
			// 'smtphost'=> 'zsmtp.hybridzimbra',
			'smtp_port' => 465,
			'smtp_user' => 'straitsgroupmail@gmail.com',
			'smtp_pass' => '12@345678',
			'mailtype'  => 'html',
			'charset'   => 'utf-8'
		);

		$this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");

		if (isset($Array['user']))
		{
			//Email content
			$htmlContent = '<h3>Welcome to Straits Group\'s CRM</h3>';
			$htmlContent .= '<p>Hello '.$Array['user'].',<br>';
			$htmlContent .= 'Your Account has been created on our CRM with following credentials<br><br>';
			$htmlContent .= 'User Id: '.$Array['Email'] .'<br>';
			$htmlContent .= 'Password: '.$Array['Password'] .'</p><br>';
			if ($Array['Link']!= "")
			{
				$htmlContent .= '<p>You can use following Link to login to your panel<br>';
				$htmlContent .= '<a href ='.$Array['Link'].'>'.$Array['Link'].'</p>';
			}
			
			$this->email->subject('New Account Info from Straits Group\'s CRM');
		}
		else
		{
			$htmlContent = '<h3>Straits Group\'s CRM Notification</h3>';
			// $htmlContent 
			$htmlContent .= '<p>'.$Array['Message'].'</p>';
			$this->email->subject('New Notification from Straits Group\'s CRM');
		}

		$this->email->to($Array['Email']);
		$this->email->from('service@straitsgroup.com','Straits Group\'s CRM');
		
		$this->email->message($htmlContent);

		// print_r($this->email->message);
		//Send email
		if ($this->email->send())
		{
			return true;
		}
		else
		{
			echo $this->email->print_debugger();
		}
	}

	function encrypt($string) 
	{
		$key = "asdf1234"; //key to encrypt and decrypts.
		$result = '';
		$test = "";
		for($i=0; $i<strlen($string); $i++) 
		{
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)+ord($keychar));

			$test[$char]= ord($char)+ord($keychar);
			$result.=$char;
		}
		return urlencode(base64_encode($result));
	}

	function decrypt($string) 
	{
		$key = "asdf1234"; //key to encrypt and decrypts.
		$result = '';
		$string = base64_decode(urldecode($string));
		for($i=0; $i<strlen($string); $i++) 
		{
			$char = substr($string, $i, 1);
			$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char)-ord($keychar));
			$result.=$char;
		}
		return $result;
	}
}