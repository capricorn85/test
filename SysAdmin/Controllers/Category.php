<?php namespace SysAdmin\Controllers;

use SysAdmin\Models\CategoryModel as CateModel;

class Category extends BaseController
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
        $this->CateModel = new CateModel();
    }
    public function index()
    {
        helper('mycms_helper');
        $menuList= $this->CateModel->getCate('id,cat_name,cat_type,sort_order,is_show,pid');

        $menuList = $this->buildMenuChild(0, $menuList);
        $data = [
            'list'  => $menuList,
            'title' => '前台栏目',
            'nav_mold' =>$this->nav_mold
        ];
        return view('SysAdmin\Views\Category\category', $data);
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
        if ($_POST){
            $validation =  \Config\Services::validation();
            if ($id){
                $validation->setRules([
                    'cat_name' => [
                        'label'  => 'cat_name',
                        'rules'  => 'trim|required',
                        'errors' => [
                            'required' => 'All accounts must have {field} provided'
                        ]
                    ],
                    'sort_order' => [
                        'label'  => 'sort_order',
                        'rules'  => 'required',
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
                    'pid' => [
                        'label'  => 'pid',
                        'rules'  => 'required',
                        'errors' => [
                            'min_length' => 'Your {field} is too short. You want to get hacked?'
                        ]
                    ],
                    'cat_type' => [
                        'label'  => 'cat_type',

                        'rules'  => 'required',
                        'errors' => [
                            'min_length' => 'Your {field} is too short. You want to get hacked?'
                        ]
                    ]
                    ,
                    'column_ab' => [
                        'label'  => 'column_ab',
                        'rules'  => 'required',
                        'errors' => [
                            'min_length' => 'Your {field} is too short. You want to get hacked?'
                        ]
                    ]
                ]);

            }else{
                $validation->setRules([
                    'cat_name' => [
                        'label'  => 'cat_name',
                        'rules'  => 'trim|required',
//                        'rules'  => 'trim|required|is_unique[category.cat_name]',
                        'errors' => [
                            'required' => 'All accounts must have {field} provided'
                        ]
                    ],
                    'sort_order' => [
                        'label'  => 'sort_order',
                        'rules'  => 'required',
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
                    'pid' => [
                        'label'  => 'pid',
                        'rules'  => 'required',
                        'errors' => [
                            'min_length' => 'Your {field} is too short. You want to get hacked?'
                        ]
                    ],
                    'cat_type' => [
                        'label'  => 'cat_type',
                        'rules'  => 'required',
                        'errors' => [
                            'min_length' => 'Your {field} is too short. You want to get hacked?'
                        ]
                    ]
                    ,
                    'column_ab' => [
                        'label'  => 'column_ab',
                        'rules'  => 'required',
                        'errors' => [
                            'min_length' => 'Your {field} is too short. You want to get hacked?'
                        ]
                    ]
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
            $data = $this->request->getPost(array('cat_name','sort_order','is_show','column_ab','pid'));
            $data['thumb']=$this->request->getPost('thumb');
            $data['cat_type']=$cat_type;
            $data["content"]=$this->request->getPost("editorValue");
            $cif=0;
            if($id){
                $data["update_at"] =date("Y-m-d H:i:s");
                $cif= $this->CateModel->upNav($id,$data);
            }else{
                $data["create_at"] =date("Y-m-d H:i:s");
                $cif= $this->CateModel->inNav($data);
            }
            if ($cif){
                $msg['status']="success";
                $msg['txt']="操作成功！";
            }
        }

        echo json_encode($msg);

    }

    function form(){
        helper('mycms_helper');
        $id=$this->request->getGet('id');
        $cat_list =  $this->CateModel->getCate('id,cat_name,cat_type,pid,is_show,sort_order');
        if($id){
            $list =  $this->CateModel->getCate('id,cat_name,cat_type,pid,is_show,sort_order,content,column_ab,thumb',$id);
            $data['list']=$list;
        }
        $data['cat_list']=$cat_list;
        return view('SysAdmin\Views\Category\cate_form',$data);
    }

    public function deleteCat(){
        $id=$this->request->getPostGet('id');
        $dnum= $this->CateModel->delNav($id);
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
