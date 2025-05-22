<?php


namespace SysAdmin\Controllers;
use SysAdmin\Models\Admin\AuthModel;
use SysAdmin\Models\Admin\RoleAuthModel;
use SysAdmin\Models\Admin\RoleModel;

class Role extends BaseController
{
    public function __construct(){
        parent::__construct();
        $this->nav_mold=[];
        $nav_id=264;
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

    }

    function roleEForm(){
        $id=$this->request->getPost('id');
        $RoleModel = new RoleModel();
        if ($_POST){
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'rolename' => [
                    'label'  => 'rolename',
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided'
                    ]
                ],
                'descri' => [
                    'label'  => 'descri',
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided'
                    ]
                ],'pid' => [
                    'label'  => 'pid',
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided'
                    ]
                ],'rstyle' => [
                    'label'  => 'rstyle',
                    'rules'  => 'trim|required',
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
            $data = $this->request->getPost(array('rolename','descri','pid','rstyle'));
            $cif=0;
            if($id){
                $cif=$RoleModel->upRole($id,$data);
            }else{
                $cif=$RoleModel->inRole($data);
            }
            if ($cif){
                $msg['status']="success";
                $msg['txt']="操作成功！";
            }else{
                $msg['status']="failed";
                $msg['txt']="操作失败！";
                $msg['error']=$cif;
            }
        }

        echo json_encode($msg);
    }

    function index()
    {
        $RoleModel = new RoleModel();
        $menuList=$RoleModel->getList('role.id,role.rolename,r.rolename as pname,role.descri,role.pid,role.rstyle');

        $menuList = $this->buildMenuChild(0, $menuList);
        $data = [
            'list'  => $menuList,
            'title' => '角色管理',
        ];
        $data['nav_mold']=$this->nav_mold;
        return view('SysAdmin\Views\Admin\role',$data);
    }
    function roleForm(){

        $RoleModel = new RoleModel();
        $id=$this->request->getGet('id');
        $pList=$RoleModel->getPlist('id,rolename,pid,descri');

        $pList = $this->buildMenuChild(0, $pList);
        if($id){
            $list = $RoleModel->getList('role.id,role.rolename,role.pid,role.descri,role.rstyle',$id);
            $data['list']=$list;
//            判断是否有子元素，若有子元素，rstyle只能为2，角色组类别
            $ifChild=$RoleModel->ifChild($id);
            if ($ifChild) $data['ifChild']=$ifChild;

        }

        $data['pList']=$pList;
        return view('SysAdmin\Views\Admin\role_form',$data);

    }
    function roleDelete(){
        $RoleModel = new RoleModel();
        $id=$this->request->getPost('id');
        $dnum=$RoleModel->delRole($id);
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


    //按序返回数组中的id值
    function findId($idArray = false){
        $ids=[];
        if ($idArray){
            foreach ($idArray as $k=>$value){
                $ids[$k]=$value['id'];
            }
        }
        return $ids;
    }


    function auth_role(){
        $id=$this->request->getGet('id');
        $AuthModel = new AuthModel();
        $authList=$AuthModel->getList('id,auth_name,scopes,descri');
        $RoleAuthModel = new RoleAuthModel();
        foreach ($authList as $k=>$v){
            $aList=$RoleAuthModel->getList('id,aid,mold',$id,$v['id']);
            if ($aList) $authList[$k]['mold']=$aList['mold'];
        }
        $data['authList']=$authList;
        return view('SysAdmin\Views\Admin\auth_role',$data);

    }

    function authRoleForm(){
        $id=$this->request->getPost('id');
        $msg=['status'=>"failed",'txt'=>"操作失败！"];
        if ($_POST){
            $auth=$this->request->getPost('auth');
//            处理值
            $authRoleValue=[];
            foreach ($auth as $k=>$v){
//                var_dump($v);
                $ar['rid']=$id;
                $ar['aid']=$k;
                $anum=0;
                foreach ($v as $k=>$v2){
                    $anum=$anum+$v2;
//                    switch ($k){
//                        case 'add':
//                            $anum=$anum+1;
//                            break;
//                        case 'del':
//                            $anum=$anum+2;
//                            break;
//                        case 'ins':
//                            $anum=$anum+4;
//                            break;
//                        default:
//                            $anum=$anum+0;
//                            break;
//                    }
                }
                $ar['mold']=$anum;
                $authRoleValue[]=$ar;
            }
//            var_dump($authRoleValue);
            $RoleAuthModel = new RoleAuthModel();
            $otype=$RoleAuthModel->upAuthRole($authRoleValue,$id);
            if ($otype){
                $msg['status']="success";
                $msg['txt']="操作成功！";
            }

        }
        echo json_encode($msg);
    }
    //递归获取子菜单
    private function buildMenuChild($pid, $menuList){
        $treeList = [];
        foreach ($menuList as $v) {
            if ($pid == $v['pid']) {
                $node = (array)$v;
                $child = $this->buildMenuChild($v['id'], $menuList);
                if (!empty($child)) {
                    $node['child'] = $child;
                }
                // todo 后续此处加上用户的权限判断
                $treeList[] = $node;
            }
        }
        return $treeList;
    }
    private function buildMenuChild2($pid, $menuList,$scopes=[]){
        $treeList = [];
        $cstatus=0;
        foreach ($menuList as $v) {
            if ($pid == $v['pid']) {
                $node = (array)$v;
                if ($scopes){
                    if (in_array($v['id'],$scopes)){
                        $node['checked']=1;
                        $cstatus=1;
                    }
                }
                $child = $this->buildMenuChild2($v['id'], $menuList,$scopes);
                if (!empty($child['treelist'])) {//
                    $node['children'] = $child['treelist'];
                    if ($child['cstatus'])$node['spread']=1;
                }
                // todo 后续此处加上用户的权限判断
                $treeList[] = $node;
            }
        }
        return ['treelist'=>$treeList,'cstatus'=>$cstatus];
    }

}