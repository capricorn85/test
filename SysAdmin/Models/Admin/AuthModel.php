<?php


namespace SysAdmin\Models\Admin;


class AuthModel extends \CodeIgniter\Model
{
    protected $table = 'authority';
    protected $allowedFields = ['auth_name','descri','scopes'];
    public function getList($sarray,$id=false){
        if ($id){
            return $this->select($sarray,false)->where('id',$id)->first();
        }else{
            return $this->select($sarray)->findAll();
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
    public function inAuth($data=false){
        if ($data){
            return $this->insert($data);
        }
        else{
            return false;
        }
    }
    public function delAuth($cid = false)
    {
        if ($cid){
            $cid=explode(',',$cid);
            if (count($cid)){
                $this->whereIn('id',$cid)->delete();
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }
    }