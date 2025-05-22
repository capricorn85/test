<?php
namespace SysAdmin\Controllers;
//if ( ! defined('BASEPATH')) exit('No direct script access allowed');
use SysAdmin\Models\LoginModel;
class Login extends BaseController {

//登录用户
    public function index()
    {

        $data=[];
//        var_dump($_SESSION);
        if(!empty($_SESSION['admin'])){
            return redirect('xccmssys');
        }
        if($_POST){
            //验证登录
            $pwd=$this->request->getPostGet('pwd');
            $username=$this->request->getPostGet('username');
            $LoginModel = new LoginModel();
            $msg=$LoginModel->identifyID($username,$pwd);


            if ($msg&&$msg['status']=='success'){
                $admin=$msg['admin'];
                if($admin){
                    $logintime=date('Y-m-d H:i:s',time());
                    $login_data["logintime"]=$logintime;
                    $login_data["lastlogintime"]=$admin['logintime'];
                    $LoginModel->upAdmin($admin['id'],$login_data);
                    $_SESSION['admin'] = $admin;
                    $_SESSION['admin']['cur_nav_id']='';
                    return redirect('xccmssys');

                }
            }else{
                $data['login_msg']='登录失败，用户名或密码错误';
//                dd($data);
                return view('SysAdmin\login', $data);
            }
        }else{
//            dd($data);
            return view('SysAdmin\login', $data);
        }

    }
//
    public function Denied(){
         unset($_SESSION['admin']);
        return view('denied.html');
    }
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
    public function logout(){
        unset($_SESSION['admin']);
        return redirect('login');
    }
    private  function findP($pre,$list){
        global $rs;
        $pp=array();
        $rs=array();
        foreach ($list as $row){
            if ($pre==$row['id']){
                if ($pp==""){
                    $pp=$row['parent_id'];
                }else{
                    array_push($pp,$row['parent_id']);
                }
                if ($row['parent_id']!=0){
                    $this->findP($row['parent_id'],$list);
                }

                if ($rs==""){
                    $rs=$pp;

                }else{
                    $rs=array_merge($rs,$pp);
                }
            }
        }
        return $rs;
    }
}
