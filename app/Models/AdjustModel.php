<?php

namespace App\Models;

use CodeIgniter\Model;

class AdjustModel extends Model
{
      protected $sensor;
      protected $table      = 'sensor_adjust';
      protected $primaryKey = 'adjust_id';
      protected $useAutoIncrement = true;
      protected $returnType     = 'object';
      protected $useSoftDeletes = true;
      protected $allowedFields = ['adjust_key', 'adjust_nilai', 'adjust_deskripsi'];
      public function __construct()
      {
            $this->sensor = db_connect()->table('sensor_adjust');
      }
      public function getAllData($key)
      {
            $this->sensor->select();
            $this->sensor->where('adjust_key', $key);
            $query = $this->sensor->get();
            return $query->getResult();
      }

      public function getValueAdjust($key)
      {
            $this->sensor->select('');
            $this->sensor->where('adjust_key', $key);
            $this->sensor->orderBy('adjust_id', 'DESC');
            $this->sensor->limit(10);

            $query = $this->sensor->get();
            return $query->getResult();
      }
}
