<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Iku1Model;

class Iku1 extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $model = new Iku1Model();
        $data = $model->findAll();
        return $this->respond($data);
    }

    public function get($iku1_id = null)
    {
        $model = new Iku1Model();
        $data = $model->find($iku1_id);
        if (!$data) {
            return $this->failNotFound('No Data Found');
        } else {
            return $this->respond($data);
        }
    }

    public function show($iku1_id = null)
    {
        $model = new Iku1Model();
        $data = $model->find($iku1_id);
        if (!$data) {
            return $this->failNotFound('No Data Found');
        } else {
            return $this->respond($data);
        }
    }

    public function create()
    {
        helper(['form']);
    
        $data = [
            'no_ijazah' => $this->request->getVar('no_ijazah'),
            'nama_alumni' => $this->request->getVar('nama_alumni'),
            'status'      => $this->request->getVar('status'),
            'gaji'        => $this->request->getVar('gaji'),
            'masa_tunggu' => $this->request->getVar('masa_tunggu')
        ];
    
        // Periksa apakah bidang-bidang yang diperlukan ada yang kosong
        foreach ($data as $key => $value) {
            if (empty($value)) {
                unset($data[$key]);
            }
        }
    
        $model = new Iku1Model();
        $model->save($data);
    
        $response = [
            'status'   => 201,
            'error'    => null,
            'messages' => [
                'success' => 'Data Inserted'
            ]
        ];
    
        return $this->respondCreated($response);
    }
    
    public function update($iku1_id = null)
    {
        helper(['form']);
    
        $data = [
            'no_ijazah' => $this->request->getVar('no_ijazah'),
            'nama_alumni' => $this->request->getVar('nama_alumni'),
            'status'      => $this->request->getVar('status'),
            'gaji'        => $this->request->getVar('gaji'),
            'masa_tunggu' => $this->request->getVar('masa_tunggu')
        ];
    
        // Periksa apakah bidang-bidang yang diperlukan ada yang kosong
        foreach ($data as $key => $value) {
            if (empty($value)) {
                unset($data[$key]);
            }
        }
    
        $model = new Iku1Model();
        $dataToUpdate = $model->find($iku1_id);
    
        if (!$dataToUpdate) return $this->failNotFound('No Data Found');
    
        $model->update($iku1_id, $data);
    
        // Kode untuk menampilkan view setelah update
        return view('edit_iku1', $data);
    }
    

    public function delete($iku1_id = null)
    {
        $model = new Iku1Model();
        $dataToDelete = $model->find($iku1_id);

        if (!$dataToDelete) return $this->failNotFound('No Data Found');
        
        $model->delete($iku1_id);

        $response = [
            'status'   => 200,
            'error'    => null,
            'messages' => [
                'success' => 'Data Deleted'
            ]
        ];

        return $this->respond($response);
    }
}
