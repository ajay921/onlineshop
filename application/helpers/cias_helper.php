<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


/**
 * This function is used to print the content of any data
 */
function pre($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

/**
 * This function used to get the CI instance
 */
if(!function_exists('get_instance'))
{
    function get_instance()
    {
        $CI = &get_instance();
    }
}

/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 */
if(!function_exists('getHashedPassword'))
{
    function getHashedPassword($plainPassword)
    {
        return password_hash($plainPassword, PASSWORD_DEFAULT);
    }
}

/**
 * This function used to generate the hashed password
 * @param {string} $plainPassword : This is plain text password
 * @param {string} $hashedPassword : This is hashed password
 */
if(!function_exists('verifyHashedPassword'))
{
    function verifyHashedPassword($plainPassword, $hashedPassword)
    {
        return password_verify($plainPassword, $hashedPassword) ? true : false;
    }
}

/**
 * This method used to get current browser agent
 */
if(!function_exists('getBrowserAgent'))
{
    function getBrowserAgent()
    {
        $CI = get_instance();
        $CI->load->library('user_agent');

        $agent = '';

        if ($CI->agent->is_browser())
        {
            $agent = $CI->agent->browser().' '.$CI->agent->version();
        }
        else if ($CI->agent->is_robot())
        {
            $agent = $CI->agent->robot();
        }
        else if ($CI->agent->is_mobile())
        {
            $agent = $CI->agent->mobile();
        }
        else
        {
            $agent = 'Unidentified User Agent';
        }

        return $agent;
    }
}

if(!function_exists('setProtocol'))
{
    function setProtocol()
    {
        $CI = &get_instance();
                    
        $CI->load->library('email');
        
        $config['protocol'] = PROTOCOL;
        $config['mailpath'] = MAIL_PATH;
        $config['smtp_host'] = SMTP_HOST;
        $config['smtp_port'] = SMTP_PORT;
        $config['smtp_user'] = SMTP_USER;
        $config['smtp_pass'] = SMTP_PASS;
        $config['charset'] = "utf-8";
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        
        $CI->email->initialize($config);
        
        return $CI;
    }
}

if(!function_exists('emailConfig'))
{
    function emailConfig()
    {
        $CI->load->library('email');
        $config['protocol'] = PROTOCOL;
        $config['smtp_host'] = SMTP_HOST;
        $config['smtp_port'] = SMTP_PORT;
        $config['mailpath'] = MAIL_PATH;
        $config['charset'] = 'UTF-8';
        $config['mailtype'] = "html";
        $config['newline'] = "\r\n";
        $config['wordwrap'] = TRUE;
    }
}

if(!function_exists('resetPasswordEmail'))
{
    function resetPasswordEmail($detail)
    {
        $data["data"] = $detail;
        // pre($detail);
        // die;
        
        $CI = setProtocol();        
        
        $CI->email->from(EMAIL_FROM, FROM_NAME);
        $CI->email->subject("Reset Password");
        $CI->email->message($CI->load->view('email/resetPassword', $data, TRUE));
        $CI->email->to($detail["email"]);
        $status = $CI->email->send();
     //   pre($status);die("dd");
      print_r($CI->email->print_debugger());die;
        return $status;
    }
}

if(!function_exists('setFlashData'))
{
    function setFlashData($status, $flashMsg)
    {
        $CI = get_instance();
        $CI->session->set_flashdata($status, $flashMsg);
    }
}

if(!function_exists('getCategories'))
{
    function getCategories()
    {
        $CI = get_instance();
        $CI->db->select( '*' );
        $CI->db->from( 'tbl_categories' );
        $CI->db->where( 'isDeleted', '0' );
        $result = $CI->db->get()->result();
        return $result;
    }
}

if(!function_exists('getCategoryNameByID'))
{
    function getCategoryNameByID($category_id)
    {
        $CI = get_instance();
        $CI->db->select( 'name' );
        $CI->db->from( 'tbl_categories' );
        $CI->db->where( 'isDeleted', '0' );
        $result = $CI->db->get()->row();
        return $result->name;
    }
}

function uploadfiles($FILES,$UPLOADSPATH,$uploadfield,$type,$allowedtype,$resize=0,$varioussizes='0') {

    $obj = & get_instance();
    $obj->load->library('upload');
    if(isset($_POST)){
        if (isset($_FILES) && !empty($FILES['p_image']['name'])) {
            $config['overwrite'] = TRUE;
            $config['encrypt_name']= TRUE;
            $ext = explode(".", $FILES['p_image']['name']);
            $config['file_name'] = time().'.'.$FILES['p_image']['name'];
            $config['upload_path'] = $UPLOADSPATH.$type.'/';
            $config['allowed_types'] = $allowedtype;

            _checkDirectorys($config['upload_path'],$resize,$varioussizes);
            $obj->upload->initialize($config);
           
            if($obj->upload->do_upload($uploadfield)) {
                $datafile=array();
                $datafile = $obj->upload->data();
                @chmod($config['upload_path'].$datafile['file_name'], 0777);
                if($resize==1){
                    if($type=="blog")
                    {
                        exactresizeblogs($config['upload_path'],$config['file_name'],$varioussizes);
                    }
                    else
                    {
                        _imageResizings($config['upload_path'],$datafile['file_name'],$varioussizes);
                    }

                }

                
            } else {

               $datafile['error']  = $obj->upload->display_errors();
            }

       return $datafile;
        }
    }
}






function exactresizeblogs($path, $file,$varioussizes='0')
{
    $obj = & get_instance();
    $obj->load->library('zebra_image');
    try{
        $obj->zebra_image->source_path=$path.$file;
        $obj->zebra_image->jpeg_quality = 100;
        $obj->zebra_image->preserve_aspect_ratio = true;
        $obj->zebra_image->enlarge_smaller_images = true;
        $obj->zebra_image->preserve_time = true;
        if(isset($varioussizes) && !empty($varioussizes))
        {
            $params=explode("_",$varioussizes);
            for($i=0;$i<count($params);$i++)
            {
                $split2=explode("x",$params[$i]);
                $obj->zebra_image->target_path=$path . "thumbs/".$params[$i].'/'.$file;
                $obj->zebra_image->resize($split2[0], $split2[1], ZEBRA_IMAGE_CROP_CENTER);
            }
        }
        else
        {
            $obj->zebra_image->target_path=$path . "thumbs/67x67/".$file;
            $obj->zebra_image->resize('67','67', ZEBRA_IMAGE_CROP_CENTER);
        }
    }
    catch (Exception $e)
    {
        echo 'Caught exception while resizing images of '.$file.'. Message: '.$e->getMessage();
    }
}


/**
 * @ Function Name      : _imageResizing
 * @ Function Params    :
 * @ Function Purpose   : Private function for creatiung user photos thumbs of different sizes
 * @ Function Returns   :
 **/
function _imageResizings($path, $file,$varioussizes='0') {
    error_reporting(1);
    $obj = & get_instance();
    $obj->load->library('image_lib');
    try{
        $thumb['image_library'] = 'gd2';
        $thumb['source_image'] = $path . $file;
        $thumb['thumb_marker'] = "";
        $config['create_thumb'] = TRUE;
        $thumb['maintain_ratio'] = FALSE;
        $thumb['master_dim'] = TRUE;
        $config['quality']   = 100;

        if(isset($varioussizes) && !empty($varioussizes))
        {
            $params=explode("_",$varioussizes);
            for($i=0;$i<count($params);$i++)
            {
                $split2=explode("x",$params[$i]);
                $thumb['width'] = $split2[0];
                $thumb['height'] =$split2[1];
                $thumb['new_image'] = $path . "thumbs/".$params[$i];
                $obj->image_lib->initialize($thumb);
                $obj->image_lib->resize();
            }
        }
        else
        {
            $thumb['width'] = 67;
            $thumb['height'] = 67;
            $thumb['new_image'] = $path . "thumbs/67x67";
            $obj->image_lib->initialize($thumb);
            $obj->image_lib->resize();
        }
    }
    catch (Exception $e){
        echo 'Caught exception while resizing images of '.$file.'. Message: '.$e->getMessage();
    }
}


/**
 * @ Function Name      : _checkDirectory
 * @ Function Params        : $path=upload path
 * @ Function Purpose   : check file upload directory exists or not!
 */
function _checkDirectorys($path,$resize=0,$varioussizes='0') {
    // echo "i m here";
    //echo $path; die;
    error_reporting(0);
    if (!is_dir($path)) {

        @mkdir($path, 0777);
        @chmod($path, 0777);
    }
    else
    {
        @chmod($path, 0777);
        @chmod($path . "thumbs/", 0777);
    }
    if($resize==1)
    {


        if (!is_dir($path . 'thumbs')) {
            mkdir($path . 'thumbs', 0777,true);
            @chmod($path . "thumbs/", 0777);
        }
        if(isset($varioussizes) && !empty($varioussizes))
        {
            $params=explode("_",$varioussizes);
            for($i=0;$i<count($params);$i++)
            {
                if (!is_dir($path . "thumbs/".$params[$i])) {
                    mkdir($path . "thumbs/".$params[$i], 0777,true);
                    @chmod($path . "thumbs/".$params[$i], 0777);
                }
            }
        }
        else
        {
            if (!is_dir($path . "thumbs/67x67")) {
                mkdir($path . "thumbs/67x67", 0777,true);
                @chmod($path . "thumbs/67x67", 0777);
            }
        }

    }
}
?>