<?php

namespace App\Controllers;

use \App\Models\KomikModel;

class Komik extends BaseController
{
 protected $komikModel;

 public function __construct()
 {
  $this->komikModel = new KomikModel();
 }

 public function index()
 {
  // $komik = $this->komikModel->findAll();

  $data = [
   'judul' => "Daftar Komik",
   'komik' => $this->komikModel->getKomik()
  ];

  // cara koneksi ke db tanpa model
  // $db = \Config\Database::connect();
  // $komik = $db->query("SELECT * FROM komik");
  // foreach ($komik->getResultArray() as $row) {
  //     d($row);
  // }     

  return view('komik/index', $data);
 }

 public function detail($slug)
 {
  // $komik = $this->komikModel->getKomik($slug);
  $data = [
   'judul' => 'Detail Komik',
   'komik' => $this->komikModel->getKomik($slug)
  ];

  // jika komik tidak ada di tabel
  if (empty($data['komik'])) {
   throw new \codeigniter\Exceptions\PageNotFoundException('Judul Komik ' . $slug . ' Tidak Ditemukan');
  }

  return view('komik/detail', $data);
 }

 public function create()
 {
  // session();
  $data = [
   'judul' => 'Form Tambah Data Komik',
   'validation' => \config\Services::validation()
  ];

  return view('komik/create', $data);
 }




 public function save()
 {
  // dd($this->request->getVar());

  // Validasi Input
  if (!$this->validate([
   'judul' => [
    'rules' => 'required|is_unique[komik.judul]',
    'errors' => [
     'required' => '{field} komik harus diisi',
     'is_unique' => '{field} komik sudah terdaftar'
    ]
   ],
   'penulis' => [
    'rules' => 'required|is_unique[komik.penulis]',
    'errors' => [
     'required' => '{field} komik harus diisi',
     'is_unique' => '{field} komik sudah terdaftar'
    ]
   ],
   'penerbit' => [
    'rules' => 'required|is_unique[komik.penerbit]',
    'errors' => [
     'required' => '{field} komik harus diisi',
     'is_unique' => '{field} komik sudah terdaftar'
    ]
   ],
   'sampul' => [
    'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/png, image/jpg,image/jpeg]',
    'errors' => [
     'max_size' => 'Ukuran gambar anda terlalu besar',
     'is_image' => 'Yang anda pilih bukan gambar',
     'mime_in' => 'Yang anda pilih bukan gambar'
    ]
   ]


  ])) {

   //    $validation = \config\Services::validation();

   //    return redirect()->to('http://localhost/ci4komik/public/komik/create')->withInput()->with('validation', $validation);

   return redirect()->to('http://localhost/ci4komik/public/komik/create')->withInput();
  }

  // ambil gambar
  $fileSampul = $this->request->getFile('sampul');
  // dd($fileSampul);

  // cek apakah tidak ada gambar yang di upload
  if ($fileSampul->getError() == 4) {
   $namaSampul = 'default.jpg';
  } else {
   // generate nama sampul random
   $namaSampul = $fileSampul->getRandomName();

   // pindahkan file ke folder img
   $fileSampul->move('img', $namaSampul);
  }


  $slug = url_title($this->request->getVar('judul'), '-', true);

  $this->komikModel->save([
   'judul' => $this->request->getVar('judul'),
   'slug' => $slug,
   'penulis' => $this->request->getVar('penulis'),
   'penerbit' => $this->request->getVar('penerbit'),
   'sampul' => $namaSampul
  ]);

  // Pesan Flash Data
  session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');

  return redirect()->to('http://localhost/ci4komik/public/komik');
 }




 public function delete($no)
 {

  // cari gambar berdasarkan no
  $komik = $this->komikModel->find($no);

  // cek jika file gambar nya default.jpg
  if ($komik['sampul'] != 'default.jpg') {
   // hapus gambar
   unlink('img/' . $komik['sampul']);
  }

  $this->komikModel->delete($no);

  session()->setFlashdata('pesan', 'Data Berhasil Dihapus');

  return redirect()->to('http://localhost/ci4komik/public/komik');
 }




 public function edit($slug)
 {
  $data = [
   'judul' => 'Form Ubah Data Komik',
   'validation' => \config\Services::validation(),
   'komik' => $this->komikModel->getKomik($slug)
  ];

  return view('komik/edit', $data);
 }





 public function update($no)
 {

  // cek judul
  $komikLama = $this->komikModel->getKomik($this->request->getVar('slug'));

  if ($komikLama['judul'] == $this->request->getVar('judul')) {
   $rule_judul = 'required';
  } else {
   $rule_judul = 'required|is_unique[komik.judul]';
  }

  // Validasi Input
  if (!$this->validate([
   'judul' => [
    'rules' => $rule_judul,
    'errors' => [
     'required' => '{field} komik harus diisi',
     'is_unique' => '{field} komik sudah terdaftar'
    ]
   ],
   'sampul' => [
    'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/png,image/jpg,image/jpeg]',
    'errors' => [
     'max_size' => 'Ukuran gambar anda terlalu besar',
     'is_image' => 'Yang anda pilih bukan gambar',
     'mime_in' => 'Yang anda pilih bukan gambar',
    ]
   ]


  ])) {
   // $validation = \config\Services::validation();

   return redirect()->to('http://localhost/ci4komik/public/komik/edit/' . $this->request->getVar('slug'))->withInput();
  }

  // kelola nama file yang baru
  $fileSampul = $this->request->getFile('sampul');

  // cek gambar, apakah tetap gambar lama
  if ($fileSampul->getError() == 4) {
   $namaSampul = $this->request->getVar('sampulLama');
  } else {
   // generate nama file random baru
   $namaSampul = $fileSampul->getRandomName();
   // pindahkan gambar 
   $fileSampul->move('img', $namaSampul);
   // hapus file yang lama
   unlink('img/' . $this->request->getVar('sampulLama'));
  }




  $slug = url_title($this->request->getVar('judul'), '-', true);

  $this->komikModel->save([
   'no' => $no,
   'judul' => $this->request->getVar('judul'),
   'slug' => $slug,
   'penulis' => $this->request->getVar('penulis'),
   'penerbit' => $this->request->getVar('penerbit'),
   'sampul' => $namaSampul
  ]);

  // Pesan Flash Data
  session()->setFlashdata('pesan', 'Data Berhasil Diubah');

  return redirect()->to('http://localhost/ci4komik/public/komik');
 }
}
