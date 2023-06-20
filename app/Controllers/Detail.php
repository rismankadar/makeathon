<?php

namespace App\Controllers;

use App\Models\AdjustModel;
use App\Models\SensorModel;
use App\Models\ValueModel;

class Detail extends BaseController
{
      public function index()
      {
            $modelSensor = model(SensorModel::class);
            $data = [

                  'cardSensor' => $modelSensor->getSensorCard(),
            ];
            return view('dashboard/index', $data);
      }


      public function detail($id)
      {
            $valueModel = new ValueModel;
            $sensorModel = new SensorModel;
            $data = [

                  'sensor' => $sensorModel->getSensor($id)
            ];
            return view('/detail/index', $data);
      }
      public function chart($key)
      {
            $valueModel = new ValueModel;

            $data = $valueModel->getValueLabel($key); // Ganti getDataFromDatabase dengan method yang sesuai di model Anda

            return $this->response->setJSON($data);
      }
      public function getTable($key)
      {
            $valueModel = new ValueModel;

            $data = $valueModel->getValueLabel($key); // Ganti getDataFromDatabase dengan method yang sesuai di model Anda

            return $this->response->setJSON($data);
      }
      public function getTableAdjust($key)
      {
            $valueModel = new AdjustModel;

            $data = $valueModel->getValueAdjust($key); // Ganti getDataFromDatabase dengan method yang sesuai di model Anda

            return $this->response->setJSON($data);
      }
      public function adjustValue($key)
      {
            // Logika atau perubahan nilai atribut yang diperlukan di sini
            $model = new ValueModel;
            $data['data'] = $model->getMax($key);

            return json_encode($data);

            // // Mengembalikan respons dengan nilai yang dihasilkan
            // return $this->response->setJSON(['value' => $randomValue]);
      }


      public function setValueAdjust()
      {
            $adjust = new AdjustModel;
            $adjustKey = trim(esc($this->request->getPost('key')));
            $adjustValue = trim(esc($this->request->getPost('nilai')));
            $adjustDeskripsi = trim(esc($this->request->getPost('deskripsi')));
            $data = [
                  'adjust_key' => $adjustKey,
                  'adjust_nilai' => $adjustValue,
                  'adjust_deskripsi' => $adjustDeskripsi,
            ];
            $adjust->insert($data);
            return redirect()->back();
      }
}
