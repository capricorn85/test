<?php

namespace App\Models;

class SwiperModel extends \CodeIgniter\Model
{


//    protected $primaryKey = 'id';
//
//    protected $returnType = 'array';
//    protected $useSoftDeletes = true;
//
//    protected $allowedFields = ['name', 'email'];
//
//    protected $useTimestamps = false;
//    protected $createdField  = 'created_at';
//    protected $updatedField  = 'updated_at';
//    protected $deletedField  = 'deleted_at';

    protected $table = 'swipers';
    protected $allowedFields = ['title','href','is_show','itype','sort_order'];
    public function getNavOne($sarray='id,pid',$id)
    {
//        dd($sarray);
//            return $this->select($sarray)->where('status',1)->orderBy('sort desc,id asc')->findAll();
        return $this->select($sarray)->where('id',$id)->orderBy('sort_order desc,id asc')->first();


    }

    public function getSwiperList($sarray='title,href',$where1,$where2){

       $slist=$this->select($sarray)->where($where1)->where('itype',1)->orderBy('sort_order desc,id asc')->findAll();

        $llist=$this->select($sarray)->where($where2)->where('itype',2)->orderBy('sort_order desc,id asc')->first();
        return $data=[
            'slist'=>$slist,
            'llist'=>$llist
        ];




    }
}