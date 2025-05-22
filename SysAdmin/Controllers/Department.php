<?php namespace SysAdmin\Controllers;
use SysAdmin\Models\baseInfo\DepartmentModel;
class Department extends BaseController
{

    public function __construct(){
        parent::__construct();

        $nav_id=257;
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
        $this->DepartmentModel = new DepartmentModel();
    }
    public function index()
    {
        $condition = $this->condition();
        $where = $condition["where"];
        $like = $condition["like"];
        $data = [
            'list'  =>$this->DepartmentModel->select('did,dno,dname,director,persons.name pname,AIC.short_name aname,d_state,department.sort_order')
                ->join('persons','persons.pid=department.director','left')
                ->join('AIC','AIC.aid=department.org','left')
                ->where($where)
                ->like($like)
                ->orderBy('department.sort_order desc,d_state desc')
                ->paginate(15,'alist'),
            'pager' => $this->DepartmentModel->pager,
            'nav_mold' =>$this->nav_mold
        ];
        return view('SysAdmin\Views\baseInfo\department',$data);
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
            $like["name"] = $name;
        }
        $item2 = trim($this->request->getGet("licenseNo"));
        if($item2 != ""){
            $like["licenseNo"] = $item2;
        }
        return [
            "where" => $where,
            "like" => $like
        ];
    }
    public function getAlist()
    {
        $condition = $this->condition();
        $where = $condition["where"];
        $like = $condition["like"];
        $data = [
            'data'  =>$this->DepartmentModel->select('id,name,AC')
                ->where($where)
                ->like($like)
                ->orderBy('sort_order desc,id asc')
                ->paginate(8),
            "code" => 0,
            'count' => $this->DepartmentModel->countAll()
        ];
        echo json_encode($data);
    }
    public function getDlist()
    {
        $condition = $this->condition();
        $where = $condition["where"];
        $like = $condition["like"];
        $data = [
            'data'  =>$this->DepartmentModel->select('did,dno,dname,short_name')
                ->join('AIC','AIC.aid=department.org','left')
                ->where($where)
                ->like($like)
                ->orderBy('department.sort_order desc,did asc')
                ->paginate(8),
            "code" => 0,
            'count' => $this->DepartmentModel->where($where)
                ->like($like)->countAllResults()
        ];
        echo json_encode($data);
    }

    function  eform(){
        $id=$this->request->getPost('id');
        if ($_POST){
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'dno' => [
                    'label'  => 'dno',
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided'
                    ]
                ],
                'dname' => [
                    'label'  => 'dname',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided'
                    ]
                ],
                'director' => [
                    'label'  => 'director',
                    'rules'  => 'required|integer',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided'
                    ]
                ],

                'org' => [
                    'label'  => 'org',
                    'rules'  => 'required|integer',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided'
                    ]
                ],
                'sort_order' => [
                    'label'  => 'sort_order',
                    'rules'  => 'required|integer',
                    'errors' => [
                        'min_length' => 'Your {field} is too short. You want to get hacked?'
                    ]
                ],
//                'd_state' => [
//                    'label'  => 'd_state',
//                    'rules'  => 'required|integer',
//                    'errors' => [
//                        'min_length' => 'Your {field} is too short. You want to get hacked?'
//                    ]
//                ],
            ]);



            $vt= $validation->withRequest($this->request)->run();
            $errors = $validation->getErrors();
            if ($vt == FALSE){
                $msg['status']="failed";
                $msg['txt']="操作失败";
                $msg['error']=$errors;
                exit( json_encode($msg));
            }
            $data = $this->request->getPost(array('dno','dname','director','org','sort_order','d_state','notes'));
            $cif=0;
            if($id){
                $data["update_at"] =date("Y-m-d H:i:s");
                $cif=$this->DepartmentModel->upDep($id,$data);
            }else{
                $data["create_at"] =date("Y-m-d H:i:s");
                $cif=$this->DepartmentModel->inDep($data);
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
        $id=$this->request->getGet('did');
        $data['alist']=$this->DepartmentModel->getAList();
        $data['nav_mold']=$this->nav_mold;
        if($id){
            $list = $this->DepartmentModel->getList('dno,dname,director,persons.name pname,org,d_state,department.sort_order',$id);
            $data['list']=$list;

        }

        return view('SysAdmin\Views\baseInfo\dep_form',$data);
    }

    public function stopDep(){
        $id=$this->request->getPostGet('id');
        $dnum=$this->DepartmentModel->stopDep($id);
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
