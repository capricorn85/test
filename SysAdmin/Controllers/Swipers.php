<?php namespace SysAdmin\Controllers;


use SysAdmin\Models\baseInfo\SwiperModel;

class Swipers extends BaseController
{
    public function __construct(){
        parent::__construct();
        $this->nav_mold=[];
        $nav_id=262;
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
        $this->SwiperModel = new SwiperModel();
    }
    public function index()
    {
        $data = [
            'list'  => $this->SwiperModel->select('id,title,href,is_show,itype,sort_order')->get()->getResultArray(),
            'nav_mold' =>$this->nav_mold
        ];
        return view('SysAdmin\Views\baseInfo\swiperList',$data);
    }
    function  eform(){
        $id=$this->request->getPost('id');
        $msg['status']="failed";
        $msg['txt']="操作失败";
        if ($_POST){
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'title' => [
                    'label'  => 'title',
                    'rules'  => 'trim|required',
                    'errors' => [
                        'required' => 'All accounts must have {field} provided'
                    ]
                ],
                'is_show' => [
                    'label'  => 'is_show',
                    'rules'  => 'required',
                    'errors' => [
                        'min_length' => 'Your {field} is too short. You want to get hacked?'
                    ]
                ],

                'href' => [
                    'label'  => 'href',
                    'rules'  => 'required',
                    'errors' => [
                        'min_length' => 'Your {field} is too short. You want to get hacked?'
                    ]
                ],
                'itype' => [
                    'label'  => 'itype',
                    'rules'  => 'required',
                    'errors' => [
                        'min_length' => 'Your {field} is too short. You want to get hacked?'
                    ]
                ],
                'sort_order' => [
                    'label'  => 'sort_order',
                    'rules'  => 'required',
                    'errors' => [
                        'min_length' => 'Your {field} is too short. You want to get hacked?'
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
            $data = $this->request->getPost(array('title','href','itype','is_show','sort_order'));
            $content=$this->request->getPost("content");
            $cif=0;
            if($id){
                $data["id"] =$id ;
//                $data["updater_id"] =$_SESSION['admin']['id'] ;
//                $data["update_date"] =date("Y-m-d H:i:s");
                $cif=$this->SwiperModel->save($data);
            }else{
//                $data["creator_id"] =$_SESSION['admin']['id'] ;
//                $data["creat_date"] =date("Y-m-d H:i:s");

                $cif=$this->SwiperModel->save($data);
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
    function form(){
        $data=[];
        $id=$this->request->getGet('id');


        if($id){
            $list = $this->SwiperModel->select('id,title,itype,href,is_show,sort_order')->where('id',$id)->get()->getRowArray();
            $data['list']=$list;
        }

        return view('SysAdmin\Views\baseInfo\swiper_form',$data);
    }
//递归获取子菜单

    public function deleteSwiper(){
        $id=$this->request->getPost('id');
        $dnum= $this->SwiperModel->delSwiper($id);
        $data=[];
        if ($dnum){
//            $dnum2=$ArticleModel->delAContent($id);
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

}
