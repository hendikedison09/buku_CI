<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Buku_model extends CI_Model {

    public function getBuku()
    {
       // $query_str = "SELECT * FROM buku";
        //$query = $this->db->query($query_str)->result_array();

        $query = $this->db->get('buku')->result();
        return $query;
    }
    public function tambah_data($data)
    {
        $this->db->insert('buku',$data);

    }
    public function edit_form($where)
    {
     $query = $this->db->get_where('buku',$where)->row_array();
 
   return $query;
      }

      public function edit_data($where,$data)
     {
        $this->db->where($where);
        $this->db->update('buku', $data);
     }

   // public function getBukuById($id)
    //{
       // $query_str = "SELECT * FROM buku WHERE id_buku=" . $id;
        //$query = $this->db->query($query_str)->row_array();

      //  $query = $this->db->get_where('buku',array('id_buku' => $id))->row_array();
        //return $query;
    //}

    //public function update_data($data)
    //{
      //   $this->db->where('id_buku', $data['id_buku']);
        // return $this->db->update('buku',$data);
    //}

   // public function hapus_data($id)
    //{
      //   $this->db->where('id_buku', $id);
        // return $this->db->delete('buku',array('id_buku' => $id));

    //}

     public function hapus_data($where)
    {
         $this->db->where($where);
         $this ->db->delete('buku');

    } 
    public function search($keyword)
    {
      //  $query = $this->db->query('SELECT * FROM buku WHERE judul LIKE "%'. $keyword. '%"'.
        //'OR penulis LIKE "%' . $keyword. '%"'.
        //'OR tahun_terbit LIKE "%'. $keyword.'%"')->result_array();

       // return $query;


        $this->db->like('judul',$keyword);
        $this->db->or_like('penulis',$keyword);
        $this->db->or_like('tahun_terbit',$keyword);

         $query = $this->db->get('buku')->result_array();

        return $query;
        
    }
   
   

    public function getBukuById($where)
    {
        $this->db->join('genre', 'buku.id_genre = genre.id_genre','left');

        $query = $this->db->get_where('buku', $where)->row_array();
        return $query;
    }

    public function getGenre()
    {
       $query = $this->db->get('genre')->result_array();
        return $query;

    }
}

/* End of file Buku_model.php */
//get untuk mengambil semua data
//get_where untuk mengambil 1 baris data tidak
?>