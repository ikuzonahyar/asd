<?php namespace App\Models;

use CodeIgniter\Model;

class transaction extends Model
{
	protected $DBGroup        = 'default';
	protected $table          = 'file';

  protected $returnType     = 'array';

  protected $allowedFields  = [
    'id_file',
    'upload_by',
    'file_name_source',
    'file_name_finish',
    'file_url',
    'file_size',
    'password',
    'tgl_upload'
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

  public function listTransaction()
  {
    $query =  $this->select('X0.*, X1.nama as user, X1.role')
      ->from($this->table. ' X0', true)
      ->join('user X1', 'X0.upload_by = X1.id_user', 'left')
      ->get()->getResultArray();
    return $query;
  }
}