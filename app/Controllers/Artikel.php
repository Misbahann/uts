<?php

namespace App\Controllers;

use App\Models\ArtikelModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Artikel extends BaseController
{
    public function admin_index()
    {
        $title = 'Daftar Artikel';
        $q = $this->request->getVar('q') ?? '';
        $model = new ArtikelModel();
        $data = [
            'title' => $title,
            'q' => $q,
            'artikel' => $model->like('judul', $q)->paginate(10), // Data dibatasi 10 record per halaman
            'pager' => $model->pager,
        ];
        return view('artikel/admin_index', $data);
    }

    public function view($slug)
    {
        $model = new ArtikelModel();
        $artikel = $model->where(['slug' => $slug])->first();

        // Menampilkan error apabila data tidak ada.
        if (!$artikel) {
            throw PageNotFoundException::forPageNotFound();
        }

        $title = $artikel['judul'];
        return view('artikel/detail', [
            'artikel' => $artikel,
            'title' => $title
        ]);
    }

    public function add()
    {
        // Validasi data
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul' => 'required',
            'gambar' => 'uploaded[gambar]|is_image[gambar]|max_size[gambar,2048]'
        ]);

        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $file = $this->request->getFile('gambar');

            // Jika file ada, pindahkan ke direktori 'public/gambar'
            if ($file->isValid() && !$file->hasMoved()) {
                $file->move(ROOTPATH . 'public/gambar');
            }

            $artikel = new ArtikelModel();
            $artikel->insert([
                'judul' => $this->request->getPost('judul'),
                'isi' => $this->request->getPost('isi'),
                'slug' => url_title($this->request->getPost('judul')),
                'gambar' => $file->getName(),
            ]);

            return redirect()->to('admin/artikel');
        }

        $title = "Tambah Artikel";
        return view('artikel/add', compact('title'));
    }    

    public function edit($id)
    {
        $model = new ArtikelModel();
        $artikel = $model->where(['id' => $id])->first();

        $validation = \Config\Services::validation();

        $data = [
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
            'slug' => url_title($this->request->getPost('judul'), '-', true),
            'status' => $this->request->getPost('status'),
            'gambar' => $this->request->getPost('gambar')
        ];

        if ($validation->run($data, 'artikel') == false) {
            return view('artikel/edit', [
                'artikel' => $artikel,
                'title' => 'Edit Artikel'
            ]);
        } else {
            $model->update($id, $data);
            return redirect()->to(base_url('/admin/artikel'));
        }
    }

    public function delete($id)
    {
        $model = new ArtikelModel();
        $model->delete($id);
        return redirect()->to(base_url('/admin/artikel'));
    }
}