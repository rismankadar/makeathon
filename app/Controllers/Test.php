<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ValueModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Test extends Controller
{
      public function index()
      {
            return view('test/index');
      }

      public function test()
      {
            $valueModel = new ValueModel;
            $data = [
                  "value_key" => trim(esc($this->request->getPost('key'))),
                  "value_nilai" => trim(esc($this->request->getPost('nilai'))),
            ];

            $valueModel->insert($data);
            return redirect()->back();
      }
      public function test2()
      {
            $valueModel = new ValueModel;
            $sensorkey = trim(esc($_POST['value_key']));
            $sensorValue = trim(esc($_POST['value_nilai']));
            $data = [
                  "value_key" =>  $sensorkey,
                  "value_nilai" =>  $sensorValue,
            ];

            $valueModel->insert($data);
            return $this->response->setStatusCode(201)->setJSON(['message' => 'Data saved successfully']);
      }

      public function create()
      {
            $model = new ValueModel;

            // Menerima data dari NodeMCU
            $sensorName = trim(esc($this->request->getPost('key')));
            $sensorValue = trim(esc($this->request->getPost('nilai')));

            // Memasukkan data ke database
            $data = [
                  'value_key' => $sensorName,
                  'value_nilai' => $sensorValue,
            ];

            if ($model->insertData($data)) {
                  return $this->response->setStatusCode(201)->setJSON(['message' => 'Data saved successfully']);
            } else {
                  return $this->failServerError('Terjadi kesalahan saat menyimpan data.');
            }
      }

      public function getChartData()
      {
            $labels = ['Label 1', 'Label 2', 'Label 3', 'Label 4', 'Label 5']; // Get the labels dynamically from your data source
            $data = [10, 20, 15, 25, 30]; // Get the data dynamically from your data source

            $chartData = [
                  'labels' => $labels,
                  'data' => $data
            ];

            return $this->response->setJSON($chartData);
      }
      public function export($key)
      {
            $valueModel = new ValueModel;
            $valueModel->select();
            $query = $valueModel->getAllData($key);
            if (!empty($query)) {
                  $spreadsheet = new Spreadsheet();
                  $spreadsheet = new Spreadsheet();
                  $activeWorksheet = $spreadsheet->getActiveSheet();
                  $activeWorksheet->setCellValue('A1', 'No');
                  $activeWorksheet->setCellValue('B1', 'Nilai');
                  $activeWorksheet->setCellValue('C1', 'waktu');
                  $row = 2;
                  $no = 1;
                  foreach ($query as $data) {
                        $activeWorksheet->setCellValue('A' . $row, $no);
                        $activeWorksheet->setCellValue('B' . $row, $data->value_nilai);
                        $activeWorksheet->setCellValue('C' . $row, $data->created_at);
                        $row++;
                        $no++;
                  }


                  $filename = 'data sesnor key ' . $key . '.xlsx';

                  // Redirect output ke file Excel
                  header('Content-Type: application/vnd.ms-excel');
                  header('Content-Disposition: attachment;filename="' . $filename . '"');
                  header('Cache-Control: max-age=0');

                  $writer = new Xlsx($spreadsheet);
                  $writer->save('php://output');
                  exit;
            }
            return redirect()->back();
      }
}
