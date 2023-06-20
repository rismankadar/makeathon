<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\Response;

class ChartController extends Controller
{
      public function updateData()
      {
            $i = 0;
            // Proses pembaruan data chart
            $data = [
                  'labels' => $this->generateRandomData(),
                  'datasets' => [
                        [
                              'label' => $this->generateRandomData(),
                              'data' => $this->generateRandomData(),
                              'backgroundColor' => 'rgba(54, 162, 235, 0.5)',
                              'borderColor' => 'rgba(54, 162, 235, 1)',
                              'borderWidth' => 1
                        ]
                  ]
            ];

            // Buat respon dalam bentuk JSON
            $response = $this->response
                  ->setJSON($data)
                  ->setStatusCode(Response::HTTP_OK);

            return $response;
      }

      private function generateRandomData()
      {
            // Generate data acak untuk grafik
            $data = [];
            for ($i = 0; $i < 6; $i++) {
                  $data[] = rand(1, 20);
            }

            return $data;
      }
}
