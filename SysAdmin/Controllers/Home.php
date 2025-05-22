<?php
namespace SysAdmin\Controllers;

use SysAdmin\Models\sysCategory\SysCateModel;
use SysAdmin\Models\Admin\AdminModel;

class Home extends BaseController
{
    public function __construct(){
        parent::__construct();
    }

    public function index()
	{

//        echo view('FilesMS\Views\index');
        return view('SysAdmin\Views\index');
	}


    public function Sys_guide()
    {
        return view('SysAdmin\Views\home');
    }
	//-----

    public function siteInfo(){
        return view('site');
    }

    function pwdReset(){
        $id=$_SESSION['admin']['id'];
        $AdminModel = new AdminModel();
        if ($_POST){
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'old_password' => [
                    'label'  => 'old_password',
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided'
                    ]
                ],
                'password' => [
                    'label'  => 'password',
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided'
                    ]
                ],
                'again_password' => [
                    'label'  => 'again_password',
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
            $opwd=$this->request->getPost('old_password');
            $npwd=$this->request->getPost('password');

//            获取原密码
            $pwd=$AdminModel->select('pwd')->where('id',$id)->first();
             $encrypter = \Config\Services::encrypter();
            $pwd2=$encrypter->decrypt(base64_decode($pwd['pwd']));

            if ($pwd2==$opwd){
                $data['pwd']= base64_encode($encrypter->encrypt($npwd));
                $data['id']=$id;
                $uif=$AdminModel->save($data);
                if ($uif){
                    $msg=[
                        'status'=>'success',
                        'txt'=>"密码更改成功"
                    ];
                }

            }else{
                $msg['status']="failed";
                $msg['txt']="密码错误，更改密码失败！";
            }
            exit( json_encode($msg));
        }else{
            return view('SysAdmin\Views\Admin\pwd_reset');

        }


    }
    //---------------------------------------------------------------
// 获取初始化数据
    public function getSystemInit(){
        $homeInfo = [
            'title' => '首页',
            'href'  => 'xccmssys/Sys_guide',
        ];
        $logoInfo = [
            'title' => 'X维云途',
            'image' => base_url('statics/img/xlogo1.png'),
            'href'  => '#',
        ];


        $menuInfo = $this->getMenuList();
        $systemInit = [
            'homeInfo' => $homeInfo,
            'logoInfo' => $logoInfo,
            'menuInfo' => $menuInfo,
        ];
        return json_encode($systemInit);
    }

    // 获取菜单列表
    private function getMenuList(){
        $model = new SysCateModel();
        $menuList=$model->getNavAll('id,pid,title,icon,href,target');
        $menuList = $this->buildMenuChild(0, $menuList);
        return $menuList;
    }

    //递归获取子菜单
    private function buildMenuChild($pid, $menuList){
        $treeList = [];
        $premiss=$_SESSION['admin']['premiss'];
        $aid=$_SESSION['admin']['id'];
        // 假设 $admin['premiss'] 是经过加密和编码的字符串
        $encrypted_base64_json = $_SESSION['admin']['premiss'];
        $encrypter = service('encrypter');

        // 第一步：解密
        $decrypted_base64 = $encrypter->decrypt(base64_decode($encrypted_base64_json));

        // 第二步：Base64解码
        $decrypted_json = base64_decode($decrypted_base64);

        // 第三步：JSON解码
        $premiss = json_decode($decrypted_json, true); // 使用 true 得到数组而不是对象
//        var_dump($premiss);
//        exit();

        foreach ($menuList as $v) {
            if ($pid == $v['pid']) {
                $node = (array)$v;
                $child = $this->buildMenuChild($v['id'], $menuList);
                if (!empty($child)) {
                    $node['child'] = $child;
                }
                else{
//                    如为末节点，且无节点权限，则该菜单不显示
                    if (!isset($premiss[$v['id']])){
                        $node = '';
                    }
                }
                // todo 后续此处加上用户的权限判断
                if ($node){
                    $treeList[] = $node;
                }

            }
        }
        return $treeList;
    }


}
