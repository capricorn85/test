<?php
namespace SysAdmin\Models\sysCategory;

class SysCateModel extends \CodeIgniter\Model
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

    protected $table = 'system_menu';
    protected $allowedFields = ['pid','title','icon','href','target','cate_id','sort','status','remark','create_at','update_at','delete_at'];


    public function getNav($sarray,$id=false)
    {
        if ($id){
            return $this->select($sarray)->where('id',$id)->first();
        }else{
            return $this->select($sarray)->findAll();
        }
    }

    public function getNavAll($sarray)
    {

            return $this->select($sarray)->where('status',1)->findAll();

    }

    public function upNav($id=false,$data=false){
        if ($id){
            return $this->set($data)->where('id',$id)->update();
        }else{
            return false;
        }
    }
    public function inNav($data){
        return $this->insert($data);
    }
    public function upPid($pid){
        return $this->set('child',1)->where('id',$pid)->update();
    }
    public function delNav($cid = false)
    {
//        $builder->delete(array('id' => $id));;

        if ($cid){
            $cid=explode(',',$cid);
            if (count($cid)){
                $catlist = $this->select("id,pid")->findAll();
                $treeChildList=[];
                foreach ($cid as $id){//
                    $treeChild= $this->findChild($id,$catlist);
                    $treeChildList=array_merge($treeChildList,$treeChild);
                }
                $treeChildList=array_unique($treeChildList);
                return   $this->whereIn('id',$treeChildList)->delete();
            }
        }else{
            return false;
        }

    }

    function  getNavCon($sarray,$condition){
        return $this->select($sarray)->where($condition)->findAll();

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