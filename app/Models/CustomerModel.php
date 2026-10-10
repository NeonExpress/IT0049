<?php 
namespace app\Models;

use CodeIgniter\Model;


Class CustomerModel extends Model{
    protected $table = 'customer';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['name', 'email', 'phone', 'address'];
}

