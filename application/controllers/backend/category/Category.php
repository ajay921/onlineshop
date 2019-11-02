<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Category extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('backend/user_model');
        $this->load->model('backend/category/category_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Dashboard';
        
        $this->loadViews("backend/dashboard", $this->global, NULL , NULL);
    }
    
    /**
     * This function is used to load the user list
     */
    function categoryListing()
    {
        if($this->isAdmin() == TRUE)
        {
            $this->loadThis();
        }
        else
        {        
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $count = $this->category_model->categoryListingCount($searchText);


            $returns = $this->paginationCompress ( "administrator/categoryListing/", $count, 10 );
           // pre($returns);die;
            
            $data['categoryRecords'] = $this->category_model->categoryListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'Category Listing';
            
            $this->loadViews("backend/category/list", $this->global, $data, NULL);
        }
    }

    /**
     * This function is used to load the add new form
     */
    public function add()
    {
        
        $data['role']='';
        $this->global['pageTitle'] = 'Add New Category';
        $this->form_validation->set_rules('category','Category Name','trim|required|max_length[128]');

        if($this->input->post()){
           
            if($this->form_validation->run() == FALSE)
            {
                $this->loadViews("backend/category/add", $this->global, $data, NULL);    
            }
            else
            {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('category'))));
                $slug=create_slug($name,'tbl_categories');
                $data = array(
                    'name'=>$name, 
                    'slug'=>$slug,
                    'createdDtm'=>date('Y-m-d H:i:s')
                );
                $result = $this->category_model->insert($data);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Category created successfully');
                    redirect('administrator/categoryListing');
                }
                else
                {
                    $this->session->set_flashdata('error', 'User creation failed');
                }
            } 
        }else{
            $this->loadViews("backend/category/add", $this->global, $data, NULL);    
        }   
    }


    public function edit($id=NULL)
    {
        
        $data['editData']=$this->category_model->getData($id);
        //pre($data);die;
        $this->global['pageTitle'] = 'Add New Category';
        $this->form_validation->set_rules('category','Category Name','trim|required|max_length[128]');

        if($this->input->post()){
           
            if($this->form_validation->run() == FALSE)
            {
                $this->loadViews("backend/category/add", $this->global, $data, NULL);    
            }
            else
            {
                $name = ucwords(strtolower($this->security->xss_clean($this->input->post('category'))));
                $data = array(
                    'name'=>$name, 
                );
                $result = $this->category_model->update($data,$id);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Category has been updated successfully');
                    redirect('administrator/categoryListing');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Something went wrong.');
                    redirect('administrator/categoryListing');
                }
            } 
        }else{
            $this->loadViews("backend/category/edit", $this->global, $data, NULL);    
        }   
    }

    public function view($id){
        $data=array();
        $data['viewData']=$this->category_model->getData($id);
        $data['title']='Category';
        $this->global['pageTitle'] = 'View Category';
        $this->loadViews("backend/category/view", $this->global, $data, NULL);
    }
   
    

    /**
     * This function is used to delete the user using userId
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser() 
    {
       // pre($_POST);die;
        if($this->isAdmin() == TRUE)
        {
            echo(json_encode(array('status'=>'access')));
        }
        else
        {
            $userId = $this->input->post('userId');
            $table=$this->input->post('table');
            $column=$this->input->post('column');
            
            $userInfo = array('isDeleted'=>1,'updatedBy'=>$this->vendorId, 'updatedDtm'=>date('Y-m-d H:i:s'));
            
            $result = $this->user_model->deleteUser($userId, $userInfo, $table, $column);
            
            if ($result > 0) { echo(json_encode(array('status'=>TRUE))); }
            else { echo(json_encode(array('status'=>FALSE))); }
        }
    }
    

    
}

?>