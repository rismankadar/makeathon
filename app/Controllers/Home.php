<?php

namespace App\Controllers;

use App\Models\SensorModel;

class Home extends BaseController
{
    public function index()
    {
        $sensorModel = model(SensorModel::class);
        $data = [
            'sensors' => $sensorModel->getAll(),
            'judul' => 'dashboard',
        ];
        return view('dashboard/index', $data);
    }

    public function tambah()
    {

        helper('text');
        $key = random_string('alnum', 5);
        $sensorModel = model(SensorModel::class);
        $name = trim(esc($this->request->getPost('name')));
        $deskripsi = trim(esc($this->request->getPost('deskripsi')));
        $data = [
            'sensor_key' => $key,
            'sensor_name' => $name,
            'sensor_deskripsi' => $deskripsi
        ];

        $sensorModel->insert($data);
        return redirect()->back();
    }
}
