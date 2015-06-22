<?php namespace App\Inroll\Repositories;
/**
 * Created by PhpStorm.
 * User: shijian0602
 * Date: 7/11/14
 * Time: 6:10 PM
 */
interface ElectorRepositoryInterface{
    public function getAll();
    public function getById($id);
    public function getByField($match);

}