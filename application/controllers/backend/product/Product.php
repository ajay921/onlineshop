<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

class Product extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('backend/user_model');
        $this->load->model('backend/product/product_model');
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
    function productListing()
    {
              
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->product_model->productListingCount($searchText);

            $returns = $this->paginationCompress ( "administrator/productListing/", $count, 10 );
            
            $data['productRecords'] = $this->product_model->productListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'Product Listing';

           // pre($data);die;
            
            $this->loadViews("backend/product/list", $this->global, $data, NULL);
        
    }

    /**
     * This function is used to load the add new form
     */
    public function add()
    {
        //print_r($_FILES);die;
        $data=array();
        $data['title']='Product';
        $this->global['pageTitle'] = 'Add New Product';
        $this->form_validation->set_rules('category_id','Category Name','trim|required');
        $this->form_validation->set_rules('p_name','Product Name','trim|required|max_length[128]');
        $this->form_validation->set_rules('p_desc','Product Description','trim|required|max_length[128]');
        if($this->input->post()){
           
            if($this->form_validation->run() == FALSE)
            {
                $this->loadViews("backend/product/add", $this->global, $data, NULL);    
            }
            else
            {
                $profilePic = uploadfiles($_FILES, UPLOADS_PATH, 'p_image', 'userprofile', 'jpg|jpeg|png|PNG|JPG|JPEG|GIF|gif', '1', '140x140_100x100_186x186_59x59');
               // pre($profilePic);die;
                if(!empty($profilePic)){
                    $data['p_image'] = $profilePic['file_name'];
                }
               // pre($data);die;
                $category_id = $this->input->post('category_id');
                $name = ucwords(strtolower($this->input->post('p_name')));
                $desc = $this->input->post('p_desc');
                $slug=create_slug($name,'tbl_products');
                $data = array(
                    'category_id'=>$category_id,
                    'product_name'=>$name,
                    'description'=>$desc, 
                    'product_image'=>$data['p_image'],
                    'slug'=>$slug,
                    'createdDtm'=>date('Y-m-d H:i:s')
                );
               // pre($data);die;
                $data=$this->security->xss_clean($data);
                $result = $this->product_model->insert($data);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Product created successfully');
                    redirect('administrator/productListing');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Something went wrong');
                }
            } 
        }else{
            $this->loadViews("backend/product/add", $this->global, $data, NULL);    
        }   
    }


    public function edit($id=NULL)
    {
        $data=array();
        $data['editData']=$this->product_model->getData($id);
        //pre($data);die;
        $data['title']='Product';
        $this->global['pageTitle'] = 'Edit Product';
        $this->form_validation->set_rules('category_id','Category Name','trim|required');
        $this->form_validation->set_rules('p_name','Product Name','trim|required|max_length[128]');
        $this->form_validation->set_rules('p_desc','Product Description','trim|required|max_length[128]');
        if($this->input->post()){
           
            if($this->form_validation->run() == FALSE)
            {
                $this->loadViews("backend/product/edit", $this->global, $data, NULL);    
            }
            else
            {
                if(isset($_FILES['p_image']['name']) && !empty($_FILES['p_image']['name'])){
                    unlink(UPLOADS_PATH_PROFILE.$data['editData']->product_image);
                    unlink(UPLOADS_PATH_PROFILE_THUMB_ONE.$data['editData']->product_image);
                    unlink(UPLOADS_PATH_PROFILE_THUMB_TWO.$data['editData']->product_image);
                    unlink(UPLOADS_PATH_PROFILE_THUMB_THREE.$data['editData']->product_image);
                    unlink(UPLOADS_PATH_PROFILE_THUMB_FOUR.$data['editData']->product_image);

                }
                $uploadFile = uploadfiles($_FILES, UPLOADS_PATH, 'p_image', 'userprofile', 'jpg|jpeg|png|PNG|JPG|JPEG|GIF|gif', '1', '140x140_100x100_186x186_59x59');
               
                $category_id = $this->input->post('category_id');
                $name = ucwords(strtolower($this->input->post('p_name')));
                $desc = $this->input->post('p_desc');
                $data = array(
                    'category_id'=>$category_id,
                    'product_name'=>$name,
                    'description'=>$desc, 
                    'product_image'=>isset($uploadFile['file_name']) && $uploadFile['file_name'] != '' ? $uploadFile['file_name'] : $data['editData']->product_image,
                );$this->loadViews("backend/product/edit", $this->global, $data, NULL);
               // pre($data);die;
                $data=$this->security->xss_clean($data);
                $result = $this->product_model->update($data,$id);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Product created successfully');
                    redirect('administrator/productListing');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Something went wrong');
                }
            } 
        }else{
            $this->loadViews("backend/product/edit", $this->global, $data, NULL);    
        }   
    }

    public function view($id){
        $data=array();
        $data['viewData']=$this->product_model->getData($id);
        $data['title']='Product';
        $this->global['pageTitle'] = 'Add New Product';
        $this->loadViews("backend/product/view", $this->global, $data, NULL);
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