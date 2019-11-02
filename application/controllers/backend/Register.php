<?php
class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('backend/user_model');
    }

    public function index(){
    	$result = $this->user_model->checkEmailExists($this->input->post('email'));
    	//pre($result);die;
    	if(!empty($result)){
    		$this->session->set_flashdata('error', 'Email already used. Please use another email');
	        redirect('/register');
    	}else{

	        if($this->input->post()){
		        $this->form_validation->set_rules('fname','Full Name','trim|required|max_length[128]');
		        $this->form_validation->set_rules('email','Email','trim|required|valid_email|max_length[128]');
		        $this->form_validation->set_rules('password','Password','required|max_length[20]');
		        $this->form_validation->set_rules('address','Address','trim|required|max_length[200]');
		        $this->form_validation->set_rules('mobile','Mobile Number','required|min_length[10]');
		        
		        if($this->form_validation->run() == FALSE)
		        {
		            $this->load->view('backend/register');
		        }
		        else
		        {
		            $name = ucwords(strtolower($this->security->xss_clean($this->input->post('fname'))));
		            $email = strtolower($this->security->xss_clean($this->input->post('email')));
		            $password = $this->input->post('password');
		            $roleId = 2;
		            $mobile = $this->security->xss_clean($this->input->post('mobile'));
		            $address = $this->security->xss_clean($this->input->post('address'));
		            $userInfo = array(
		            	'email'=>$email, 
		            	'password'=>getHashedPassword($password), 
		            	'roleId'=>$roleId, 
		            	'name'=> $name,
		                'mobile'=>$mobile, 
		                'address'=>$address, 
		                'createdDtm'=>date('Y-m-d H:i:s')
		            );
		            $result = $this->user_model->addNewUser($userInfo);
		            
		            if($result > 0)
		            {
		                $this->session->set_flashdata('success', 'You have successfully registerd with us.');
		                redirect('/backend/login');
		            }
		            else
		            {
		                $this->session->set_flashdata('error', 'Something went wrong');
		                redirect('/register');
		            }
		        }
		    }else{
		        $this->load->view('backend/register');
		    }
		}
    }
}
?>