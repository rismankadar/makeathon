<?php

namespace App\Controllers;

use App\Models\SensorModel;

class Detail extends BaseController
{
      public function index($key)
      {
            $sensorModel = model(SensorModel::class);
            $ValueModel = model(ValueModel::class);
            $data = [
                  'sensors' => $sensorModel->getSensor($key),
                  'value' => $ValueModel->getAll($key),
                  'judul' => 'detail',
            ];
            return view('detail/index', $data);
      }

      public function table($key)
      {
            $ValueModel = model(ValueModel::class);
            $data = $ValueModel->getAll($key); // Ganti getDataFromDatabase dengan method yang sesuai di model Anda

            return $this->response->setJSON($data);
      }
}
