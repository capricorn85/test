<?php namespace SysAdmin\Controllers;
use SysAdmin\Models\NavModel;

class Nav extends BaseController
{

    public function __construct(){
        parent::__construct();
        $this->nav_mold=[];
        $nav_id=251;
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
    public function index()
    {
        $NavModel = new NavModel();
        $menuList=$NavModel->getNav('id,label,n_type,sort_order,status,pid,target,link_url');

        $menuList = $this->buildMenuChild(0, $menuList);
        $data = [
            'list'  => $menuList,
            'title' => '前台栏目',
            'nav_mold' =>$this->nav_mold
        ];
        return view('SysAdmin\Views\nav', $data);

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
        $NavModel = new NavModel();
        if ($_POST){
            $validation =  \Config\Services::validation();
            if ($id){
                $validation->setRules([
                    'label' => [
                        'label'  => 'label',
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
                    'n_type' => [
                        'label'  => 'n_type',

                        'rules'  => 'required',
                        'errors' => [
                            'min_length' => 'Your {field} is too short. You want to get hacked?'
                        ]
                    ]
//                    ,
//                    'column_ab' => [
//                        'label'  => 'column_ab',
//                        'rules'  => 'required',
//                        'errors' => [
//                            'min_length' => 'Your {field} is too short. You want to get hacked?'
//                        ]
//                    ]
                ]);

            }else{
                $validation->setRules([
                    'label' => [
                        'label'  => 'label',
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
                    'n_type' => [
                        'label'  => 'n_type',
                        'rules'  => 'required',
                        'errors' => [
                            'min_length' => 'Your {field} is too short. You want to get hacked?'
                        ]
                    ]
//                    ,
//                    'column_ab' => [
//                        'label'  => 'column_ab',
//                        'rules'  => 'required',
//                        'errors' => [
//                            'min_length' => 'Your {field} is too short. You want to get hacked?'
//                        ]
//                    ]
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
            $n_type=$this->request->getPost('n_type');
            $data = $this->request->getPost(array('label','sort_order','status','thumb','child','pid','link_url','target'));

            $data['n_type']=$n_type;
            $data["content"]=$this->request->getPost("editorValue");
            $cif=0;
            if($id){
                $cif=$NavModel->upNav($id,$data);
            }else{
                $cif=$NavModel->inNav($data);
            }
            if ($cif){
                $msg['status']="success";
                $msg['txt']="操作成功！";
            }
        }

        echo json_encode($msg);

    }

    function form(){
        $NavModel = new NavModel();
        $id=$this->request->getGet('id');
        $cat_list = $NavModel->getNav('id,label,thumb,n_type,pid,status,sort_order,target');
        $list=[];
        if($id){
            $list = $NavModel->getNavOne('id,label,thumb,n_type,pid,status,sort_order,target,content',$id);
            $data['list']=$list;
        }
//        dd($list);
        $data['cat_list']=$cat_list;
        return view('SysAdmin\Views\nav_form',$data);
    }

    public function deleteNav(){
        $NavModel = new NavModel();
        $id=$this->request->getPostGet('id');
        $dnum=$NavModel->delNav($id);
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
