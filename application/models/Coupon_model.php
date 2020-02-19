<?php define('BASEPATH') OR exit('No direct script access allowed');

class Coupon_model extends CI_Model
{
    private $_table = "coupon";

    public $id_coupon;
    public $nama_coupon;
    public $gambar_coupon = "default.jpg";
    public $harga_coupon;
    public $validity;
    public $deskripsi_coupon;

    public function rules()
    {
        return [
            [
                'field' => 'nama_coupon',
                'label' => 'Nama',
                'rules' => 'required'
            ],
            [
                'field' => 'harga_coupon',
                'label' => 'Harga',
                'rules' => 'numeric'
            ],
            [
                'field' => 'deskripsi_coupon',
                'label' => 'Deskripsi',
                'rules' => 'required'
            ]
        ];
    }
}

public function getAll() 
{
    return $this->db->get($this->_table)->result();
    //SELECT * FROM coupon
}

public function getById($id)
{
    return $this->db->get_where($this->_table, ["id_coupon" => $id])->row();
    //SELECT * FROM coupon WHERE id_coupon=$id
}

public function save()
{
    $post = $this->input->post(); //ambil data dari form
    $this->id_coupon = uniqid(); //membuat id unik
    $this->nama_coupon = $post["name"]; //isi field nama kupon
    $this->harga_coupon = $post["harga"] //isi field harga kupon
    $this->deskripsi_coupon = $post["deskripsi"] // isi field deskripsi kupon
    $this->db->insert($this->_table, $this); //simpan ke database
}