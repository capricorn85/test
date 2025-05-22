<?php
namespace SysAdmin\Models\baseInfo;

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

    public function delSwiper($cid = false)
    {
//        $builder->delete(array('id' => $id));;

        if ($cid) {
            $cid = explode(',', $cid);

            return $this->whereIn('id', $cid)->delete();
        }

    }



}