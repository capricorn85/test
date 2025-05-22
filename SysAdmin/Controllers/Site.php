<?php


namespace SysAdmin\Controllers;


use SysAdmin\Models\Admin\SiteModel;


class Site extends BaseController
{

    public function __construct(){
        parent::__construct();
        $this->encrypter = \Config\Services::encrypter();
        $this->nav_mold=[];
        if (isset($_SESSION['admin']['premiss'][261])){
            $this->nav_mold=$_SESSION['admin']['premiss'][261];
        }
        $this->SiteModel = new SiteModel();
    }
    public  function index(){

        $aList=$this->SiteModel->getData('id,site_name,tel,address,keywords,description,content');
        $data['list']=$aList;
        $data['nav_mold']=$this->nav_mold;
        return view('SysAdmin\Views\site',$data);
    }
    public function upInfo(){
        if ($_POST){
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'site_name' => [
                    'label'  => 'site_name',
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided'
                    ]
                ],'tel' => [
                    'label'  => 'tel',
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided'
                    ]
                ],'address' => [
                    'label'  => 'address',
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided'
                    ]
                ],'keywords' => [
                    'label'  => 'keywords',
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided'
                    ]
                ],'description' => [
                    'label'  => 'description',
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided'
                    ]
                ],
            ]);
            $vt= $validation->withRequest($this->request)->run();
            $errors = $validation->getErrors();
            if ($vt == FALSE){
                $msg['status']="failed";
                $msg['txt']="操作失败";
                $msg['error']=$errors;
                exit( json_encode($msg));
            }
            $data=$this->request->getPost(['site_name','tel','address','keywords','description']);
            $data['content']=$this->request->getPost("content");
            if ($data){
                $data['id']=1;
                $uif=$this->SiteModel->save($data);
                if ($uif){
                    $msg=[
                        'status'=>'success',
                        'txt'=>"网站信息更改成功"
                    ];
                }
            }else{
                $msg['status']="failed";
                $msg['txt']="更改信息失败！";
            }

        }else{
            $msg['status']="failed";
            $msg['txt']="更改信息失败！";


        }
        exit( json_encode($msg));
    }


}