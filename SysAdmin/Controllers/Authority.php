<?php
namespace SysAdmin\Controllers;
use SysAdmin\Models\sysCategory\SysCateModel;
use SysAdmin\Models\Admin\AuthModel;
use SysAdmin\Models\Admin\RoleAuthModel;

class Authority extends BaseController
{

    public function __construct(){
        parent::__construct();
        $this->nav_mold=[];
        $nav_id=265;
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

    function index()
    {
        $AuthModel = new AuthModel();
        $authList=$AuthModel->getList('id,auth_name,scopes,descri');
        $model = new SysCateModel();
        $menuList=$model->getNav('id,pid,title,icon,target');
        $ids=$this->findId($menuList);
//        将权限表信息进行处理，将权限范围转换为对应的菜单名称
        foreach ($authList as $k=>$item){
            $scopes=explode(',',$item['scopes']);
            $sname='';
            if ($scopes){
                foreach ($scopes as $item2){
                    $sid= array_search($item2,$ids);
                    if ($sid){
                        if ($sname)$sname=$sname.','.$menuList[$sid]['title'];
                        else $sname=$menuList[$sid]['title'];
                    }
                }
            }
            $authList[$k]['sname']=$sname;
        }
//        var_dump($_SESSION['admin']);
//        exit();
        $data = [
            'list'  => $authList,
            'title' => '权限管理',
            'nav_mold' =>$this->nav_mold
        ];
        return view('SysAdmin\Views\Admin\authority',$data);
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
    function authForm(){
        $AuthModel = new AuthModel();
        $id=$this->request->getGet('id');
        $model = new SysCateModel();
        $navList=$model->getNav('id,pid,title,icon,target');
        $data=[];
        if($id){
            $list = $AuthModel->getList('id,auth_name,scopes,descri',$id);
            $data['list']=$list;
        }
        if (isset($data['list'])){
            $scopes=explode(',',$scopes=$data['list']['scopes']);
            $navList = $this->buildMenuChild2(0, $navList,$scopes);
        }else{
            $navList = $this->buildMenuChild2(0, $navList);
        }
        $nav_list=$navList['treelist'];

        $ids = array_column($navList, 'id');

//        var_dump($navList);
//        $bdata=['id' => 9999, 'title' => "大数据看板",'icon'=>'view','checked'=>in_array(9999, $ids)];
//        var_dump($bdata);

//        array_push($nav_list, $bdata);



        $data['nav_list']=$nav_list;

//        var_dump($data);
        return view('SysAdmin\Views\Admin\auth_form',$data);
    }

    function authDelete(){
        $AuthModel = new AuthModel();
        $id=$this->request->getPost('id');
        $dnum=$AuthModel->delAuth($id);
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

    function authEForm(){
        $id=$this->request->getPost('id');
        $AuthModel = new AuthModel();
        if ($_POST){
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'auth_name' => [
                    'label'  => 'auth_name',
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided'
                    ]
                ],
                'descri' => [
                    'label'  => 'descri',
                    'rules'  => 'trim|required|string',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided'
                    ]
                ],'scopes' => [
                    'label'  => 'scopes',
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
            $data = $this->request->getPost(array('auth_name','descri','scopes'));
            $cif=0;
            if($id){
                $cif=$AuthModel->upAuth($data,$id);
            }else{
                $cif=$AuthModel->inAuth($data);
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
        return view('SysAdmin/Views/Admin/auth_role',$data);
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