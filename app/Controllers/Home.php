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
        ];
        return view('dashboard/index', $data);
    }
}
