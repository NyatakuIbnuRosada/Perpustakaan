<?php
namespace App\Controllers;
use App\Models\PegawaiModel;
use CodeIgniter\Controller;

class Pegawai extends BaseController {
    public function index()
    {
        $model = new \App\Models\PegawaiModel();
        $data['pegawai'] = $model->findAll();
        return view('pegawai/index', $data);
    }
    

  public function create() {
    return view('pegawai/create');
  }

  public function store() {
    $model = new PegawaiModel();
    $model->save([
      'nama' => $this->request->getPost('nama'),
      'jabatan' => $this->request->getPost('jabatan'),
      'alamat' => $this->request->getPost('alamat')
    ]);
    return redirect()->to('/pegawai');
  }

  public function edit($id) {
    $model = new PegawaiModel();
    $data['pegawai'] = $model->find($id);
    return view('pegawai/edit', $data);
  }

  public function update($id) {
    $model = new PegawaiModel();
    $model->update($id, [
      'nama' => $this->request->getPost('nama'),
      'jabatan' => $this->request->getPost('jabatan'),
      'alamat' => $this->request->getPost('alamat')
    ]);
    return redirect()->to('/pegawai');
  }

  public function delete($id) {
    $model = new PegawaiModel();
    $model->delete($id);
    return redirect()->to('/pegawai');
  }
}

?>