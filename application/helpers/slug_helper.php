<?php
if (!function_exists('create_slug')) {
    function create_slug($string,$table){
    	$ci = get_instance();
        $slug = trim($string);
        $slug = strtolower($slug);
        $slug = str_replace(' ', '-', $slug);
        $res = $ci->user_model->get_slug($slug,$table);
        $count = count($res);
        $slug = ($count < 1) ? $slug : $slug.'-'.$count;
        

        return $slug;
    } 
}


?>
