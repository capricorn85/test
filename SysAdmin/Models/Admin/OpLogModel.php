<?php


namespace SysAdmin\Models\Admin;

class OpLogModel extends \CodeIgniter\Model
{
    protected $table = 'op_log';

    protected $allowedFields = ['title','describ','opdate','aid','optype','notes'];
    public function getList($sarray,$LOCALADM=999){
        if ($LOCALADM==999){
            return $this->select($sarray)->findAll();
        }else{
            return $this->select($sarray)->whereIn('LOCALADM',['510600006','510600007','510600008'])->findAll();
        }
    }

    public function inOpLog($data){
        $this->insert($data);
        return true;

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