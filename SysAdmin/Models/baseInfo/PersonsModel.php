<?php
namespace SysAdmin\Models\baseInfo;

class PersonsModel extends \CodeIgniter\Model
{

    protected $table = 'persons';
    protected $allowedFields = ['name','dep','capacity','p_state','tel','a_state','create_at','update_at'];

//人员ID	pid
//姓名	name
//所属部门	dep
//身份	capacity ,标识负责人为1，默认为0
//人员状态	p_state
//联系电话	tel
//账号状态	a_state
//创建时间	creat_date
//备注	notes


//'list'  =>$this->PersonsModel->select('pid,dname,persons.name pname,p_state,a_state,persons.creat_date,tel,capacity,,AIC.short_name aname')
//->join('department','persons.dep=department.did','left')
//->join('aic','aic.aid=department.org','left')

    public function getPFList($sarray,$id=false)
    {
        if ($id){
            $data=$this->select($sarray)
                ->join('dep_aic','dep_aic.did=persons.dep','left')
                ->where('pid',$id)
                ->first();

//            $data = [
//                'ddata'  => $ddata,
//                'alist'  => $alist,
//            ];
            return $data;

        }else{
            return $this->select($sarray)->orderBy('sort_order desc,id asc')->findAll();
        }
    }

    public function getList($sarray,$id=false)
    {
        if ($id){
            $ddata=$this->select($sarray)
                ->join('persons','persons.pid=department.director','left')
//                ->join('AIC','AIC.aid=department.org','left')
                ->where('did',$id)
                ->first();

            $db      = \Config\Database::connect();
            $builder_b= $db->table('AIC');
//
//    工商所ID	aid;父ID	paid;名称	name;统一社会信用代码	licenseNo;状态	state;地区码	AC;排序	sort_order

            $alist=$builder_b->select('aid,paid,short_name,licenseNo,AC')->where('state','1')->orderBy('sort_order','desc')->get()->getResultArray();

            $data = [
                'ddata'  => $ddata,
                'alist'  => $alist,
            ];
            return $data;

        }else{
            return $this->select($sarray)->orderBy('sort_order desc,id asc')->findAll();
        }
    }
    public function getPList($sarray,$id=false)
    {
//返回人员信息，含人名name，部门dep，是否生成账号a_state
        return $this->select($sarray)
            ->join('dep_aic','dep_aic.did=persons.dep','left')->findAll();
    }

    public function upCfy($id=false,$data=false){
        if ($id){
            return $this->set($data)->where('pid',$id)->update();
        }else{
            return false;
        }
    }

    public function inCfy($data){
        return $this->insert($data);
    }
    public function delCfy($cid = false)
    {
        if ($cid){
            $cid=explode(',',$cid);
            if (count($cid)){
                return   $this->whereIn('pid',$cid)->delete();
            }
        }else{
            return false;
        }

    }





}