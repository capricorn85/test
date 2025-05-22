<?php namespace SysAdmin\Controllers;

use SysAdmin\Models\sysCategory\SysCateModel;

class sysCategory extends BaseController
{

    public function __construct(){
        parent::__construct();
        $this->nav_mold=[];
        $cate_id=268;
        $encrypted_base64_json = $_SESSION['admin']['premiss'];
        $decrypted_base64 = $this->encrypter->decrypt(base64_decode($encrypted_base64_json));
        $decrypted_json = base64_decode($decrypted_base64);
        $original_array = json_decode($decrypted_json, true); // 使用 true 得到数组而不是对象
        if ($_SESSION['admin']['id']==1) {
            $this->nav_mold=[1,1,1,1];
        }
        else if (isset($original_array[$cate_id])){
            $this->nav_mold=$original_array[$cate_id];
        }
    }
    public function index()
    {
        $CateModel = new SysCateModel();
        $menuList=$CateModel->getNav('id,title,status,sort,href,icon,pid,cate_id');
        $menuList = $this->buildMenuChild(0, $menuList);
        $data = [
            'list'  => $menuList,
            'title' => '后台栏目',
            'nav_mold' =>$this->nav_mold
        ];
        return view('SysAdmin\Views\sysCategory\category', $data);
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

    function  eform(){
        $id=$this->request->getPost('id');
        $CateModel = new SysCateModel();
        if ($_POST){
            $validation =  \Config\Services::validation();
            if ($id){
                $validation->setRules([
                    'title' => [
                        'label'  => 'title',
                        'rules'  => 'trim|required',
                        'errors' => [
                            'required' => 'All accounts must have {field} provided'
                        ]
                    ],
                    'sort' => [
                        'label'  => 'sort',
                        'rules'  => 'required',
                        'errors' => [
                            'required' => 'All accounts must have {field} provided'
                        ]
                    ],
                    'cate_id' => [
                        'label'  => 'cate_id',
                        'rules'  => 'trim|required',
                        'errors' => [
                            'required' => 'All accounts must have {field} provided'
                        ]
                    ],

                    'status' => [
                        'label'  => 'status',
                        'rules'  => 'required',
                        'errors' => [
                            'min_length' => 'Your {field} is too short. You want to get hacked?'
                        ]
                    ],
                    'pid' => [
                        'label'  => 'pid',
                        'rules'  => 'required',
                        'errors' => [
                            'min_length' => 'Your {field} is too short. You want to get hacked?'
                        ]
                    ],
                ]);

            }else{
                $validation->setRules([
                    'title' => [
                        'label'  => 'title',
                        'rules'  => 'trim|required',
//                        'rules'  => 'trim|required|is_unique[category.cat_name]',
                        'errors' => [
                            'required' => 'All accounts must have {field} provided'
                        ]
                    ],
                    'sort' => [
                        'label'  => 'sort',
                        'rules'  => 'required',
                        'errors' => [
                            'required' => 'All accounts must have {field} provided'
                        ]
                    ],
                    'status' => [
                        'label'  => 'status',
                        'rules'  => 'required',
                        'errors' => [
                            'min_length' => 'Your {field} is too short. You want to get hacked?'
                        ]
                    ],
                    'pid' => [
                        'label'  => 'pid',
                        'rules'  => 'required',
                        'errors' => [
                            'min_length' => 'Your {field} is too short. You want to get hacked?'
                        ]
                    ],'cate_id' => [
                        'label'  => 'cate_id',
                        'rules'  => 'trim|required',
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
            $cat_type=$this->request->getPost('cat_type');
            $data = $this->request->getPost(array('title','sort','cate_id','status','pid','icon','href'));
            $data['target']='_self';
            $cif=0;

            if($id){
                $data['update_at']=date("Y-m-d H:i:s");
                $cif=$CateModel->upNav($id,$data);
            }else{
                $data['create_at']=date("Y-m-d H:i:s");
                $cif=$CateModel->inNav($data);
            }
            if ($cif){
                $msg['status']="success";
                $msg['txt']="操作成功！";
            }
        }

        echo json_encode($msg);

    }

    function form(){
        $CateModel = new SysCateModel();
        $id=$this->request->getGet('id');
        $cat_list = $CateModel->getNav('id,title,status,sort,cate_id,pid');

        if($id){
            $list = $CateModel->getNav('id,title,status,sort,href,cate_id,icon,pid',$id);
            $data['list']=$list;
        }
        $data['cat_list']=$cat_list;
        return view('SysAdmin\Views\sysCategory\cate_form',$data);
    }

    public function deleteCat(){
        $CateModel = new SysCateModel();
        $id=$this->request->getPostGet('id');
        $dnum=$CateModel->delNav($id);
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
