<?php


namespace SysAdmin\Models\Admin;


class RoleAuthModel  extends \CodeIgniter\Model
{
    protected $table = 'role_auth';
    protected $allowedFields = ['aid','rid','mold'];
    public function getList($sarray,$rid=false,$aid=false){
        if ($rid&&$aid){
            return $this->select($sarray)->where('rid',$rid)->where('aid',$aid)->first();
        }else{
            return false;
        }
    }
    public function upAuth($data,$id=false){
        if ($data){
//            $ntime=date('Y-m-d H:i:s');
            if ($id){
                return $this->set($data)->where('id',$id)->update();
            }else{
                return $this->set($data)->update();
            }
        }else{
            return false;
        }
    }
    public function upAuthRole($data=false,$rid){
        if ($data&&$rid){
            //            删除所有对应该角色和记录，并重新插入
            $this->where('rid',$rid)->delete();
            foreach ($data as $k=>$v){
                $this->insert($v);
            }
            return true;
        }
        else{
            return false;
        }
    }

}