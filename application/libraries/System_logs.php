<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class System_logs
{
    protected $CI;
    
    public function __construct()
    {
        $this->CI =& get_instance();
    }
	
    public function create_log($action = NULL, $data = NULL)
	{
        if ($this->CI->ion_auth->logged_in())
	  	{
			$datos = array
					(
						'user_id'   => $this->CI->session->userdata('user_id'),
						'date' => date('Y-m-d H:i:s'),
						'ip'     => $this->CI->input->ip_address(),
						'action' => $action,
						'data'   => $data
					);
			
			$this->CI->db->insert('logs', $datos);
		}
	}

}

/* End of file System_logs.php */
/* Location: ./application/libraries/System_logs.php */