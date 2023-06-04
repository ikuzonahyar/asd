<?php namespace App\Models;

use CodeIgniter\Model;

class user extends Model
{
	protected $DBGroup        = 'default';
	protected $table          = 'user';

  protected $returnType     = 'array';

  protected $allowedFields  = [
    'id_user',
    'nama',
    'email',
    'password',
    'role'
  ];

  protected $validationRules    = [];
  protected $validationMessages = [];
  protected $skipValidation     = false;

  public function list()
  {
    $query =  $this->select(['a.*'])
      ->from($this->table. ' a', true)
      ->get()->getResultArray();
    return $query;
  }
}