<?php

namespace App\Models;

use CodeIgniter\Model;

class SensorModel extends Model
{
      protected $sensor;
      protected $table      = 'sensor';
      protected $primaryKey = 'id';
      protected $useAutoIncrement = true;
      protected $returnType     = 'object';
      protected $useSoftDeletes = true;
      protected $allowedFields = ['sensor_name', 'sensor_deskripsi', 'sensor_key'];
      public function __construct()
      {
            $this->sensor = db_connect()->table('sensor');
      }
      public function getSensor($key)
      {
            $this->sensor->select();
            $this->sensor->where('sensor_key', $key);
            $query = $this->sensor->get();
            return $query->getResult();
      }
      public function getSensorCard()
      {
            $this->sensor->select();
            $query = $this->sensor->get();
            return $query->getResult();
      }
}
