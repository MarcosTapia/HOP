<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Simplelogin
{
	var $CI;
	var $user_table = 'usuarios';

	function Simplelogin()
	{
		
	}
	
	function login($usuario = '', $password = '') {

		//Put here for PHP 4 users
		$this->CI =& get_instance();		

		//Make sure login info was sent
		if($usuario == '' OR $password == '') {
			return false;
		}

		//Check if already logged in
		if($this->CI->session->userdata('logged_in')) {
			//User is already logged in.
			return false;
		}

		//Check against user table
		$this->CI->db->where('usuario', $usuario);
		$this->CI->db->select('usuarios.*');
		$query = $this->CI->db->get_where($this->user_table);

		if ($query->num_rows() > 0) {
			$row = $query->row_array(); 
			//Check against password
			//if(md5($password) != $row['clave']) {
			if($password != $row['clave']) {
				return false;
			}
			
			//Destroy old session
			$this->CI->session->sess_destroy();

			//Create a fresh, brand new session
			$this->CI->session->sess_create();
			
			//Set session data
			//$this->CI->session->set_userdata($row);
			$this->CI->session->set_userdata($row);
			
			//Remove the password field
			unset($row['clave']);
			
			//Set logged_in to true
			$this->CI->session->set_userdata(array('logged_in' => true));			
			
			//Login was successful
			return true;

		} else {
			//No database result found
			return false;
		}	
	}

	function logout() {
		//Put here for PHP 4 users
		$this->CI =& get_instance();		
		//Destroy session
		$this->CI->session->sess_destroy();
	}

}

?>