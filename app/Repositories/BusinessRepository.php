<?php 
namespace App\Repositories;

interface BusinessRepository
{
  public function store($data);
  public function destroy($param);
  public function update($param,$data);
  public function all();
  public function search($params);
  public function find($param);
  public function get($data);
  public function rules();
}
