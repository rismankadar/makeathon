<?php

namespace App\Models;

use CodeIgniter\Model;

class SensorModel extends Model
{
      protected $db, $builder;
      protected $table      = 'sensor';
      protected $primaryKey = 'sensor_id';

      protected $useAutoIncrement = true;

      protected $returnType     = 'object';
      protected $useSoftDeletes = true;

      protected $allowedFields = ['sensor_key', 'sensor_name', 'sensor_deskripsi', 'sensor_status'];

      public function __construct()
      {
            $this->db = \Config\Database::connect();
            $this->builder = $this->db->table('sensor');
      }

      public function getAll()
      {
            $this->builder->select('');
            $this->builder->where('sensor_status', '1');
            $query = $this->builder->get();
            return $query->getResult();
      }
}
