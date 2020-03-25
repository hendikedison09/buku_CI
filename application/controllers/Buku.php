<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {

    public function __construct() {// con
        parent ::__construct();
        $this->load->model('Buku_model');

        if ($this->session->userdata('status') != 'logged in')
         {
            redirect('Login/index');  
        }
    }

    public function index()
    { 
        $data['title'] = '';
       /// $data['buku'] = $this->Buku_model->getBuku();
        //var_dump($data['buku']);
        
        if($this->input->get('keyword'))
        {
            $keyword = $this->input->get('keyword');
            $data['buku'] = $this->Buku_model->search($keyword);
        }
        else {
            $data['buku'] = $this->Buku_model->getBuku();
        }

        $this->load->view('templates/header',$data);
        $this->load->view('buku/index_view', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Data';

        $this->form_validation->set_rules('judul', 'Judul', 'required',array('required' => '%s harus diisi'));
        $this->form_validation->set_rules('penulis', 'Penulis', 'required',array('required' => '%s harus diisi'));
        $this->form_validation->set_rules('tahun_terbit', 'Tahun Terbit', 'required|exact_length[4]', array('required' => '%s harus diisi', 'exact_length' => 'Format %s : YYYY'));
        $this->form_validation->set_rules('harga', 'Harga', 'required|min_length[5]', array('required' => '%s harus diisi', 'min_length'=> '%s minimal 5 digit angka'));
        
        if ($this->form_validation->run() == FALSE) 
        {

            $data['genre'] = $this->Buku_model->getGenre();

            $this->load->view('templates/header',$data);      
            $this->load->view('buku/tambah_view');
            $this->load->view('templates/footer');
        }
        else
        {

            $judul = $this->input->post('judul');
            $penulis =$this->input->post('penulis');
            $tahun_terbit = $this->input->post('tahun_terbit');
            $harga = $this->input->post('harga');
            $id_genre = $this->input->post('id_genre');
     
           
     
            $data = array(    
                                'judul' => $judul,
                                'penulis' => $penulis,
                                'tahun_terbit'=> $tahun_terbit,
                                'harga'=> $harga,
                                'id_genre'=> $id_genre
                      );
                      $this->Buku_model->tambah_data($data);
     
                      $this->session->set_flashdata('sukses', 'ditambahkan');
                      
                      
                      
                      redirect('Buku/index');
        }

      
        
    }
    public function edit($id_buku)
    { 
        $data['title'] = 'edit data';

       
        $where = array('id_buku' => $id_buku);

        $this->form_validation->set_rules('judul', 'Judul', 'required',array('required' => '%s harus diisi'));
        $this->form_validation->set_rules('penulis', 'Penulis', 'required',array('required' => '%s harus diisi'));
        $this->form_validation->set_rules('tahun_terbit', 'Tahun Terbit', 'required|exact_length[4]', array('required' => '%s harus diisi', 'exact_length' => 'Format %s : YYYY'));
        $this->form_validation->set_rules('harga', 'Harga', 'required|min_length[5]', array('required' => '%s harus diisi', 'min_length'=> '%s minimal 5 digit angka'));
        

        if ($this->form_validation->run() ==  FALSE) 
        {
            
            $data['buku'] = $this->Buku_model->edit_form($where);
            $data['genre'] = $this->Buku_model->getGenre();
    
            $this->load->view('templates/header', $data);
            $this->load->view('buku/edit_view', $data);
            $this->load->view('templates/footer');
        } 

        else 
        {
            $id_buku = $this->input->post('id_buku');
            $judul = $this->input->post('judul');
            $penulis =$this->input->post('penulis');
            $tahun_terbit = $this->input->post('tahun_terbit');
            $harga = $this->input->post('harga');
            $id_genre = $this->input->post('id_genre');


            $data = array(
                'judul' => $judul,
                'penulis' => $penulis,
                'tahun_terbit'=> $tahun_terbit,
                'harga'=> $harga,
                'id_genre'=> $id_genre
                      );
        
                  
                   $this->Buku_model->edit_data($where, $data);
        
                   $this->session->set_flashdata('sukses', ' Edit Data');
        
                 redirect('Buku/index');
        }
        


      


        



       // $where = array('id_buku' => $id_buku);
       // $data['buku'] = $this->Buku_model->edit_form($where);
        //$this->load->view('edit_view', $data);
             
        //     if (empty($id) or count($data['result'])==0 ){
        //         redirect('user/index');
        //     }else{    
        //         $result=$this->Model_user->getUser($id);
        //         $data['id'] = $result['id'];
        //         $data['username'] = $result['username'];
        //             $data['fullname'] = $result['fullname'];
        //         $this->load->view('view_user/edit', $data); 
        //     }    
        //   }

        //public function edit($id_buku){
        //$where = array('id_buku' => $id_buku);
        //$data['buku'] = $this->Buku_model->edit_form($where);
        //$this->load->view('edit_view', $data);
        //}

    //id_buku disimpan diarray
    }
    //public function edit_proses($id)
    //{
      //  $id_buku = $this->input->post('id_buku');
        //$judul = $this->input->post('judul');
        //$penulis =$this->input->post('penulis');
        //$tahun_terbit = $this->input->post('tahun_terbit');
        //$harga = $this->input->post('harga');
 
        //$data = array(
          //  'id_buku' => $id_buku,
            //'judul' => $judul,
            //'penulis' => $penulis,
            //'tahun_terbit'=> $tahun_terbit,
            //'harga'=> $harga
                 // );

              //    $this->Buku_model->update_data($data);

                //  $this->session->set_flashdata('sukses', 'Berhasil Edit Data');
                  
       // redirect('Buku/index');
    //}
    // versi Bu bias
public function hapus($id_buku)
    {
        $where = array('id_buku' => $id_buku);
       $this->Buku_model->hapus_data($where, 'buku');

       $this->session->set_flashdata('sukses', 'Hapus Data');
       redirect('Buku/index');
    }


    //public function hapus($id){
      //  $this->Buku_model->hapus_data($id);
       // $this->session->set_flashdata('sukses', 'Berhasil Hapus Data');
        
        //redirect('Buku/index');
        
    //}
    public function search()
    {
        //$keyword = $this->input->get('keyword');

       //$data['buku'] = $this->Buku_model->search($keyword);

       $this->load->view('index_view', $data);
       
    }
    public function detail($id_buku)
    {
        $data['title'] = 'Detail Buku';

        $where = array('id_buku' => $id_buku);
        $data['buku'] = $this->Buku_model->getBukuByid($where);

        $this->load->view('templates/header' , $data);
        $this->load->view('buku/detail_view' , $data);
        $this->load->view('templates/footer');
        
    }
    
}

// ngeload model query menyimpan di getbuku termasuk array asosiatif array yang menyimpan array lain
/* End of file Buku.php */
//controller $data['genre'] ke view $genre
//tampilkan satu satu menggunakan foreach

