<?php namespace SysAdmin\Controllers;
use SysAdmin\Models\baseInfo\PersonsModel;

class Persons extends BaseController
{

    public function __construct(){
        parent::__construct();
        $nav_id=270;
        $encrypted_base64_json = $_SESSION['admin']['premiss'];
        $decrypted_base64 = $this->encrypter->decrypt(base64_decode($encrypted_base64_json));
        $decrypted_json = base64_decode($decrypted_base64);
        $original_array = json_decode($decrypted_json, true); // 使用 true 得到数组而不是对象
        if ($_SESSION['admin']['id']==1) {
            $this->nav_mold=[1,1,1,1];
        }
        else if (isset($original_array[$nav_id])){
            $this->nav_mold=$original_array[$nav_id];
        }
        $this->PersonsModel = new PersonsModel();
    }
    public function index()
    {
        $condition = $this->condition();
        $where = $condition["where"];
        $like = $condition["like"];
        $data = [
            'list'  =>$this->PersonsModel->select('pid,dname,persons.name pname,p_state,a_state,persons.create_at,tel,capacity,,AIC.short_name aname')
                ->join('department','persons.dep=department.did','left')
                ->join('aic','aic.aid=department.org','left')
                ->where($where)
                ->like($like)
                ->orderBy('persons.name asc')
                ->paginate(15,'alist'),
            'pager' => $this->PersonsModel->pager,
            'nav_mold' =>$this->nav_mold
        ];

        return view('SysAdmin\Views\persons',$data);
    }

    function condition(){
        $where = [];
        $like = [];
        $status = trim($this->request->getGet("status"));
        if($status != ""){
            $where["status"] = $status;
        }

        $name = trim($this->request->getGet("name"));
        if($name != ""){
            $like["persons.name"] = $name;
        }
        $p_state = trim($this->request->getGet("p_state"));
        if($p_state != ""&&$p_state !="999"){
            $like["p_state"] = $p_state;
        }
        $a_state = trim($this->request->getGet("a_state"));
        if($a_state != ""&&$a_state !="999"){
            $like["a_state"] = $a_state;
        }
        $capacity = trim($this->request->getGet("capacity"));
        if($capacity != ""&&$capacity !="999"){
            $like["capacity"] = $capacity;
        }

        return [
            "where" => $where,
            "like" => $like
        ];
    }

    public function getPDList()
    {
        $condition = $this->condition();
        $where = $condition["where"];
        $like = $condition["like"];
        $data = [
            'data'  =>$this->PersonsModel->
            select("pid,name,CASE a_state	WHEN '0' THEN '未生成账号'  WHEN '1' THEN '已生成账号'  WHEN '2' THEN '账号已停用'  END a_state ,CONCAT(short_name,' ',dname) dname",false)
                ->join('dep_aic','dep_aic.did=persons.dep','left')
                ->where('capacity','1')
                ->where($where)
                ->like($like)
                ->paginate(8),
            "code" => 0,
            'count' => $this->PersonsModel->where('capacity','1')
                ->where($where)->like($like)->countAllResults()
        ];
        echo json_encode($data);
    }
    public function getPMList()
    {
        $condition = $this->condition();
        $where = $condition["where"];
        $like = $condition["like"];
        $data = [
            'data'  =>$this->PersonsModel->
            select("pid,name,CASE a_state	WHEN '0' THEN '未关联账号'  WHEN '1' THEN '已关联账号'  WHEN '2' THEN '账号已停用'  END a_state ,CONCAT(short_name,' ',dname) dname",'false')
                ->join('dep_aic','dep_aic.did=persons.dep','left')
                ->where('capacity','2')
                ->where($where)
                ->like($like)
                ->paginate(8),
            "code" => 0,
            'count' => $this->PersonsModel
                ->where('capacity','2')
                ->where($where)
                ->like($like)->countAllResults()
        ];
        echo json_encode($data);
    }
    public function getPAList()
    {
        $condition = $this->condition();
        $where = $condition["where"];
        $like = $condition["like"];
        $data = [
            'data'  =>$this->PersonsModel->
            select("pid,name,short_name, dname",false)
                ->join('dep_aic','dep_aic.did=persons.dep','left')
                ->where('a_state','0')
                ->where($where)
                ->like($like)
                ->paginate(8),
            "code" => 0,
            'count' => $this->PersonsModel ->where('a_state','0')->countAllResults()
        ];
        echo json_encode($data);
    }
//    public function upState()
//    {
//
//        $data['id']=$id;
//        $cif= $this->PersonsModel->save($data);
//    }

    public function getPList()
    {
        //返回人员信息，含人名name，部门dep，是否生成账号a_state 0未生成账号，1已生成账号，2账号已停用
        $list = $this->PersonsModel->getList("pid,name,CASE a_state	WHEN '0' THEN ’未关联账号'  WHEN '1' THEN '已关联账号'  WHEN '2' THEN '账号已停用'  END a_state,CONCAT(short_name,' ',dname)");
        echo json_encode($list);

    }

    function  eform(){
        $id=$this->request->getPost('id');
//        var_dump($id);
//        exit();
        if ($_POST){
            $validation =  \Config\Services::validation();
                $validation->setRules([
                    'name' => [
                        'label'  => 'name',
                        'rules'  => 'trim|required',
                        'errors' => [
                            'required' => 'All accounts must have {field} provided'
                        ]
                    ],
                    'p_state' => [
                        'label'  => 'p_state',
                        'rules'  => 'required|integer',
                        'errors' => [
                            'required' => 'All accounts must have {field} provided'
                        ]
                    ],
                    'capacity' => [
                        'label'  => 'capacity',
                        'rules'  => 'required|integer',
                        'errors' => [
                            'required' => 'All accounts must have {field} provided'
                        ]
                    ],
                    'dep' => [
                        'label'  => 'dep',
                        'rules'  => 'required|integer',
                        'errors' => [
                            'required' => 'All accounts must have {field} provided'
                        ]
                    ],
                    'tel' => [
                        'label'  => 'tel',
                        'rules'  => 'required',
                        'errors' => [
                            'required' => 'All accounts must have {field} provided'
                        ]
                    ]
                ]);

            $vt= $validation->withRequest($this->request)->run();
            $errors = $validation->getErrors();
            if ($vt == FALSE){
                $msg['status']="failed";
                $msg['txt']="操作失败";
                $msg['error']=$errors;
                exit( json_encode($msg));
            }

            $data = $this->request->getPost(array('name','p_state','capacity','dep','tel'));
            $cif=0;
            if($id){
                $data["update_at"] =date("Y-m-d H:i:s");
                $cif=$this->PersonsModel->upCfy($id,$data);
            }else{
                $data["create_at"] =date("Y-m-d H:i:s");
                $cif=$this->PersonsModel->inCfy($data);
            }
            if ($cif){
                $msg['status']="success";
                $msg['txt']="操作成功！";
            }
        }

        echo json_encode($msg);
    }

    function form(){
//        helper('mycms_helper');
        $id=$this->request->getGet('pid');

        $data=[];
        if($id){
            $list =$this->PersonsModel->getPFList('pid,dname,persons.name pname,p_state,a_state,persons.create_at,tel,capacity,dep_aic.short_name aname,dep',$id);
            $data['list']=$list;
//            $data['alist']=$list['alist'];


        }

        return view('SysAdmin\Views\persons_form',$data);
    }

    public function deleteCat(){
        $id=$this->request->getPostGet('id');
        $dnum=$this->DepartmentModel->delCfy($id);
        $data=[];
        if ($dnum){
            $data=[
                'status'=>'success',
                'msg'=>$dnum
            ];
        }else{
            $data=[
                'status'=>'failed',
                'msg'=>'删除失败'
            ];
        }
        exit(json_encode($data));
    }

//--------------------------------------------------------------------

}
