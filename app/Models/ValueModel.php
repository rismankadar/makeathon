<?php

namespace App\Models;

use CodeIgniter\Model;

class valueModel extends Model
{
      protected $db, $builder;
      protected $table      = 'sensor_value';
      protected $primaryKey = 'value_id';

      protected $useAutoIncrement = true;

      protected $returnType     = 'object';
      protected $useSoftDeletes = true;

      protected $allowedFields = ['value_key', 'value_nilai'];

      public function __construct()
      {
            $this->db = \Config\Database::connect();
            $this->builder = $this->db->table('sensor_value');
      }

      public function getAll($key)
      {
            $this->builder->select('');
            $this->builder->where('value_key', $key);
            $query = $this->builder->get();
            return $query->getResult();
      }

      public function getvalue($key)
      {
            $this->builder->select('');
            $this->builder->where('value_key', $key);
            $query = $this->builder->get();
            return $query->getResult();
      }
}
