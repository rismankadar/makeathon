<?php

namespace App\Models;

use CodeIgniter\Model;

class ValueModel extends Model
{
      protected $sensor;
      protected $table      = 'sensor_value';
      protected $primaryKey = 'value_id';
      protected $useAutoIncrement = true;
      protected $returnType     = 'object';
      protected $useSoftDeletes = true;
      protected $allowedFields = ['value_key', 'value_nilai'];
      public function __construct()
      {
            $this->sensor = db_connect()->table('sensor_value');
      }
      public function getAllData($key)
      {
            $this->sensor->select();
            $this->sensor->where('value_key', $key);
            $query = $this->sensor->get();
            return $query->getResult();
      }
      public function getMax($key)
      {
            $this->sensor->select('');
            $this->sensor->where('value_key', $key);
            $this->sensor->orderBy('value_id', 'DESC');
            $this->sensor->limit(1);

            $query = $this->sensor->get();
            return $query->getResult();
      }
      public function getValueLabel($key)
      {
            $this->sensor->select('');
            $this->sensor->where('value_key', $key);
            $this->sensor->orderBy('value_id', 'DESC');
            $this->sensor->limit(10);

            $query = $this->sensor->get();
            return $query->getResult();
      }
      public function getValueNilai($key)
      {
            $this->sensor->select('value_nilai');
            $this->sensor->where('value_key', $key);
            $this->sensor->orderBy('value_id', 'ASC');
            $this->sensor->limit(10);
            $query = $this->sensor->get();
            return $query->getResult();
      }
}
