<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\Response;

class AjaxController extends Controller
{
      public function handleRequest()
      {
            // Proses permintaan AJAX
            $data = ['message' => 'Permintaan AJAX berhasil diproses'];

            // Buat respon dalam bentuk JSON
            $response = $this->response
                  ->setJSON($data)
                  ->setStatusCode(Response::HTTP_OK);

            return $response;
      }
}
