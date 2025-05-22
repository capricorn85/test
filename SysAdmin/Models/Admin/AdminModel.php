<?php


namespace SysAdmin\Models\Admin;


class AdminModel extends \CodeIgniter\Model
{
    protected $table = 'admin';
    protected $allowedFields = ['username','pwd','roleid','pid','creat_date','lastlogintime','logintime'];
    public function getList($sarray,$id=false){
        if ($id){
            return $this->select($sarray)->where('admin.id',$id)->join('persons','persons.pid=admin.pid','left')->join('dep_aic','dep_aic.did=persons.dep','left')->first();
        }else{
            return $this->select($sarray)->join('persons','persons.pid=admin.pid','left')->join('dep_aic','dep_aic.did=persons.dep','left')->findAll();
        }

    }

    public function delAdmin($aid = false)
    {
        if ($aid){
            $aid=explode(',',$aid);
            if (count($aid)){
                $this->whereIn('id',$aid)->delete();
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
}