<?php
namespace SysAdmin\Models\baseInfo;

class DepartmentModel extends \CodeIgniter\Model
{

    protected $table = 'department';
    protected $allowedFields = ['dno','dname','director','org','notes','d_state','create_at','update_at'];

//部门编码 dno；组织名称 dname；部门负责人 director；所属组织 org；排序 sort_order；备注 notes；创建时间 create_at update_at




    public function getList($sarray,$id=false)
    {
        if ($id){
            return  $this->select($sarray)
                ->join('persons','persons.pid=department.director','left')
//                ->join('AIC','AIC.aid=department.org','left')
                ->where('did',$id)
                ->first();
        }else{
            return $this->select($sarray)->orderBy('sort_order desc,id asc')->findAll();
        }
    }
    public function getAList()
    {
            $db      = \Config\Database::connect();
            $builder_b= $db->table('AIC');
//
//    工商所ID	aid;父ID	paid;名称	name;统一社会信用代码	licenseNo;状态	state;地区码	AC;排序	sort_order

        return  $alist=$builder_b->select('aid,paid,short_name,licenseNo,AC')->where('state','1')->orderBy('sort_order','desc')->get()->getResultArray();
    }

    public function upDep($id=false,$data=false){
        if ($id){
            return $this->set($data)->where('did',$id)->update();
        }else{
            return false;
        }
    }
    public function inDep($data){
        return $this->insert($data);
    }
    public function stopDep($cid = false)
    {
        if ($cid){
            $cid=explode(',',$cid);
            if (count($cid)){
                return $this->set('d_state',0)->whereIn('did',$cid)->update();
//                var_dump($this->getLastQuery());
//
//                return  $nnum;
            }
        }else{
            return false;
        }

    }





}