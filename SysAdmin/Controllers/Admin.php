<?php


namespace SysAdmin\Controllers;


use SysAdmin\Models\Admin\AdminModel;
use SysAdmin\Models\Admin\RoleModel;
use SysAdmin\Models\baseInfo\PersonsModel;

class Admin extends BaseController
{

    public function __construct(){
        parent::__construct();
        $this->nav_mold=[];
        $nav_id=266;
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
        $this->AdminModel = new AdminModel();
    }

    public  function index(){
        $aList= $this->AdminModel->getList('admin.id,username,admin.creat_date,name,short_name ,aname,lastlogintime,logintime,roleid,dname');
        $data['list']=$aList;
        $data['nav_mold']=$this->nav_mold;
        return view('SysAdmin\Views\Admin\index',$data);
    }
    function adminForm(){
        $RoleModel = new RoleModel();
        $id=$this->request->getGet('id');
        $rList=$RoleModel->select('id,rolename as title,pid')->findAll();
        $data=[];
        if($id){
            $list =  $this->AdminModel->getList('admin.id,persons.pid,username,name,admin.creat_date,lastlogintime,logintime,roleid',$id);
            $data['list']=$list;
        }
        if (isset($data['list'])){
            $scopes=explode(',',$scopes=$data['list']['roleid']);
            $rList = $this->buildMenuChild2(0, $rList,$scopes);

        }else{
            $rList = $this->buildMenuChild2(0, $rList);
        }

        $data['rList']=$rList['treelist'];
        return view('SysAdmin\Views\Admin\admin_form',$data);

    }

    function checkName(){
        $msg=[];
        $adminname=$this->request->getPost('adminname');
        $rList= $this->AdminModel->select('id')->where('username',$adminname)->first();
        if ($rList){
            $msg['status']="failed";
            $msg['txt']="用户名已存在";
        }else{
            $msg['status']="success";
            $msg['txt']="用户名可用";
        }
        echo json_encode($msg);
    }
    function AdminEForm(){
        $id=$this->request->getPost('id');
        if ($_POST){
            $validation =  \Config\Services::validation();
            if ($id){
                $validation->setRules([
                    'roleid' => [
                        'label'  => 'roleid',
                        'rules'  => 'trim|required|string',
                        'errors' => [
                            'required' => 'All accounts must have {field} provided'
                        ]
                    ],
                    'pid' => [
                        'label'  => 'pid',
                        'rules'  => 'trim|required|integer',
                        'errors' => [
                            'required' => 'All accounts must have {field} provided'
                        ]
                    ]
                ]);
            }
            else{
                $validation->setRules([
                    'username' => [
                        'label'  => 'username',
                        'rules'  => 'trim|required|integer|is_unique[admin.username]',
                        'errors' => [
                            'required' => 'All accounts must have {field} provided'
                        ]
                    ],
                    'roleid' => [
                        'label'  => 'roleid',
                        'rules'  => 'trim|required|string',
                        'errors' => [
                            'required' => 'All accounts must have {field} provided'
                        ]
                    ],
                    'pid' => [
                        'label'  => 'pid',
                        'rules'  => 'trim|required|integer',
                        'errors' => [
                            'required' => 'All accounts must have {field} provided'
                        ]
                    ],
                ]);
            }


            $vt= $validation->withRequest($this->request)->run();
            $errors = $validation->getErrors();
            if ($vt == FALSE){
                $msg['status']="failed";
                $msg['txt']="操作失败";
                $msg['error']=$errors;
                exit( json_encode($msg));
            }
            $data = $this->request->getPost(array('roleid','pid'));

            $cif=0;
            if($id){
                $data['id']=$id;
                $cif= $this->AdminModel->save($data);
            }else{
                $data['username']=$this->request->getPost('username');
//                $encrypter = \Config\Services::encrypter();
                $encoded = base64_encode( $this->encrypter->encrypt('1qaz2wsx'));
                $data['pwd']=$encoded;
                $data["creat_date"] =date("Y-m-d H:i:s");
                $cif= $this->AdminModel->save($data);
            }
            //                更新人员状态为已关联账号

            $PersonsModel = new PersonsModel();
            $PersonsModel->upCfy($data['pid'],(['a_state'=>1]));
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
    function pwdReset(){

        if ($_POST){
            $id=$this->request->getPost('id');

            $pwd=$this->makeCardPassword();
         

            $encoded = base64_encode( $this->encrypter->encrypt($pwd));
            $data['pwd']=$encoded;
            $data['id']=$id;
            $uif= $this->AdminModel->save($data);
            if ($uif){
                $msg=[
                    'status'=>'success',
                    'txt'=>"密码重置成功",
                    'pwd'=>$pwd
                ];
            }
            else{
                $msg['status']="failed";
                $msg['txt']="密码重置失败！";
            }

        } else{
            $msg['status']="failed";
            $msg['txt']="密码重置失败！";
        }
        exit( json_encode($msg));

    }
    function makeCardPassword() {

        $code = 'ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz';

        $rand = $code[rand(0,50)]

            .strtoupper(dechex(date('m')))

            .date('d').substr(time(),-5)

            .substr(microtime(),2,5)

            .sprintf('%02d',rand(0,99));

        for(

            $a = md5( $rand, true ),
            $s = '0123456789ABCDEFGHIJKLMNPQRSTUVabcdefghijklmnpqrstuvwxyz',
            $d = '',
            $f = 0;
            $f < 8;
            $g = ord( $a[ $f ] ),
            $d .= $s[ ( $g ^ ord( $a[ $f + 8 ] ) ) - $g & 0x1F ],
            $f++
        );
        return  $d;
}
    function adminDelete(){
        $id=$this->request->getPost('id');
        $dnum= $this->AdminModel->delAdmin($id);
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
    //递归获取子菜单
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