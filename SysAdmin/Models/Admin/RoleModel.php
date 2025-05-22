<?php


namespace SysAdmin\Models\Admin;


class RoleModel extends \CodeIgniter\Model
{
    protected $table = 'role';
    protected $allowedFields = ['rolename','pid','descri','rstyle'];
    public function getList($sarray,$id=false){
        if ($id){
            return $this->select($sarray)->join('role as r','r.id=role.pid','left')->where('role.id',$id)->first();
        }else{
            return $this->select($sarray)->join('role as r','r.id=role.pid','left')->findAll();
        }

    }
    public function getPlist($sarray){
        if ($sarray){
            return $this->select($sarray)->where('rstyle',2)->findAll();

        }else{
            return false;
        }

    }
    public function ifChild($id=false){
        if ($id){
            return $this->select('id')->where('pid',$id)->findAll();
        }
        return false;
    }
    public function upRole($id=false,$data){
        if ($id&&$data){
            return $this->set($data)->where('id',$id)->update();
        }else{
            return false;
        }
    }
    public function inRole($data){
        if ($data){
            return $this->insert($data);
        }
        return false;

    }

    public function delRole($ids = false)
    {
//        $builder->delete(array('id' => $id));;

        if ($ids){
            $ids=explode(',',$ids);
            if (count($ids)){
                $rlist = $this->select("id,pid")->findAll();
                $treeChildList=[];
                foreach ($ids as $id){//
                    $treeChild= $this->findChild($id,$rlist);
                    $treeChildList=array_merge($treeChildList,$treeChild);
                }
                $treeChildList=array_unique($treeChildList);
                return   $this->whereIn('id',$treeChildList)->delete();
            }
            return false;

        }else{
            return false;
        }

    }
    private function findChild($pid, $list){
        $treeList = [];
        $treeList[]=$pid;
        foreach ($list as $v) {
            if ($pid == $v['pid']) {
                $treeList[]=$v['id'];
                $this->findChild($v['id'], $list);
            }
        }
        return $treeList;
    }
}