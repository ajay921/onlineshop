<?php if(!defined('BASEPATH')) exit('No direct script access allowed');


class Product_model extends CI_Model
{
    
    function insert($data)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_products', $data);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    function productListingCount($searchText = '')
    {
        $this->db->select('*');
        $this->db->from('tbl_products');
        if(!empty($searchText)) {
            $likeCriteria = "(tbl_products.product_name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('tbl_products.isDeleted', '0');
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    function productListing($searchText = '', $page, $segment)
    {
        $this->db->select('*');
        $this->db->from('tbl_products');
        if(!empty($searchText)) {
            $likeCriteria = "(tbl_products.product_name  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('tbl_products.isDeleted', '0');
        $this->db->order_by('tbl_products.id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }

    public function getData($id){

        $this->db->select('*');
        $this->db->from('tbl_products');
        $this->db->where('id',$id);
        return $this->db->get()->row();

    }

     function update($data, $Id)
    {
        $this->db->where('id', $Id);
        $this->db->update('tbl_products', $data);
        if($this->db->affected_rows()>0){
            return true;
        }else{
            return false;
        }
    }

    function get_slug($slug,$table){
         $this->db->where("slug", $slug);
        $query = $this->db->get($table)->result();
        return $query;
        
    }
}

?>