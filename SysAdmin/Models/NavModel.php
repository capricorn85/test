<?php
namespace SysAdmin\Models;

class NavModel extends \CodeIgniter\Model
{
    protected $table = 'c_nav';
    protected $allowedFields = ['pid','label','n_type','target','status','thumb','link_url','content','status','sort_order','create_at','update_at','delete_at'];

    public function getNav($sarray='id,pid',$con=false)
    {
//        dd($sarray);
//            return $this->select($sarray)->where('status',1)->orderBy('sort desc,id asc')->findAll();
            return $this->select($sarray)->orderBy('sort_order desc,id asc')->findAll();


    }
    public function getNavOne($sarray='id,pid',$id)
    {
//        dd($sarray);
//            return $this->select($sarray)->where('status',1)->orderBy('sort desc,id asc')->findAll();
        return $this->select($sarray)->where('id',$id)->orderBy('sort_order desc,id asc')->first();


    }
    public function getNavCate($sarray='id,pid',$cid,$id,$id2=true)
    {
//        dd($sarray);
        return $this->select($sarray) ->groupStart()
            ->orWhere('pid',$id)
            ->orWhere('id',$cid)
            ->orWhere('pid',$cid)
            ->orWhere('pid',$id2)
            ->groupEnd()
            ->where('status',1)->orderBy('sort_order desc,id asc')->findAll();
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