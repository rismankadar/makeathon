<?php

namespace App\Controllers;

use App\Models\SensorModel;
use App\Models\ValueModel;

class Home extends BaseController
{
    public function index()
    {
        $modelSensor = model(SensorModel::class);
        $data = [

            'cardSensor' => $modelSensor->getSensorCard(),
        ];
        return view('dashboard/index', $data);
    }
    public function tambah()
    {
        helper('text');
        $modelSensor = new SensorModel;
        $name = trim(esc($this->request->getPost('name')));
        $deskripsi = trim(esc($this->request->getPost('deskripsi')));
        $unit = trim(esc($this->request->getPost('unit')));
        $key = random_string('alnum', 5);
        $data = [
            'sensor_name' => $name,
            'sensor_deskripsi' => $deskripsi,
            'sensor_key' => $key,
        ];
        $modelSensor->insert($data);
        return redirect()->back();
    }
    public function getData($id)
    {
        $model = new ValueModel;
        $data['data'] = $model->getMax($id);

        return json_encode($data);
    }
    public function getTable($id)
    {
        $model = new ValueModel;
        $data['data'] = $model->getMax($id);

        return json_encode($data);
    }

    public function detail($id)
    {
        $valueModel = new ValueModel;
        $sensorModel = new SensorModel;
        $data = [
            'values' => $valueModel->getValueLimit($id),
            'sensor' => $sensorModel->getSensor($id)
        ];
        return view('/detail', $data);
    }
}
