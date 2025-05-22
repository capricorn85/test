<?php namespace SysAdmin\Controllers;

use SysAdmin\Models\ArticleModel;
use SysAdmin\Models\NavModel as CateModel;
use SysAdmin\Models\Admin\OpLogModel;

class imgArticle extends BaseController
{
    public function __construct(){
        parent::__construct();
        $this->nav_mold=[];
        $nav_id=254;
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
        $condition = $this->condition();
        $where = $condition["where"];
        $like = $condition["like"];
        $ArticleModel = new ArticleModel();
        $CateModel = new CateModel();
        $cat_list = $CateModel->select('id,label,n_type,pid,status,sort_order')->whereIn('n_type',[1,4])->get()->getResultArray();
//        $cat_list = $CateModel->select('id,cat_name,cat_type,pid,is_show,sort_order')->where('cat_type',1)->get()->getResultArray();
        $cat_list = $this->buildMenuChild(0,$cat_list);
//        var_dump($cat_list);
        $cat_list=$cat_list['my'];

        $offset=0;
        $pager = \Config\Services::pager();
        $data = [
            'list'  => $ArticleModel->select('article.id,article_title,author,label,article.sort_order,atime,article.thumb,update_date,updater_id,article.is_show')
                ->where($where)
                ->like($like)
                ->where('a_type',1)
                ->orderBy('article.sort_order desc,update_date Desc')
                ->join("nav","nav.id=article.nav_id")
                ->paginate(10,'alist'),
            'pager' => $ArticleModel->pager,
            'nav_mold' =>$this->nav_mold,
            'cat_list'=>$cat_list
        ];
        return view('SysAdmin\Views\Article\imgArticleList',$data);
    }
    function condition(){
        $where = [];
        $like = [];

        $item1 = trim($this->request->getGet("article_title"));
        if($item1 != ""){
            $like["article_title"] = $item1;
        }
        $item5 = trim($this->request->getGet("is_show"));
        if($item5 != ""){
            $where["c_article.is_show"] = $item5;
        }
        $item2 = trim($this->request->getGet("nav_id"));
        if($item2 != ""){
            $where["nav_id"] = $item2;
        }
        $item3 = trim($this->request->getGet("update_date1"));
        if($item3 != ""){
            $where["update_date >="] = $item3;
        }
        $item4 = trim($this->request->getGet("update_date2"));
        if($item4 != ""){
            $item4=date("Y-m-d H:i:s",strtotime(date("Y-m-d",strtotime($item4))."+ 23 hours 59 minutes  59 seconds "));

            $where["update_date <="] = $item4;
        }
        return [
            "where" => $where,
            "like" => $like
        ];
    }
    function  eform(){
        $id=$this->request->getPost('id');
        $ArticleModel = new ArticleModel();
        if ($_POST){
            $validation =  \Config\Services::validation();
            $validation->setRules([
                'article_title' => [
                    'label'  => 'article_title',
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
                'thumb' => [
                    'label'  => 'thumb',
                    'rules'  => 'required',
                    'errors' => [
                        'min_length' => 'Your {field} is too short. You want to get hacked?'
                    ]
                ],
                'nav_id' => [
                    'label'  => 'nav_id',
                    'rules'  => 'required',
                    'errors' => [
                        'min_length' => 'Your {field} is too short. You want to get hacked?'
                    ]
                ],
                'author' => [
                    'label'  => 'author',
                    'rules'  => 'required',
                    'errors' => [
                        'min_length' => 'Your {field} is too short. You want to get hacked?'
                    ]
                ],
                'content' => [
                    'label'  => 'content',
                    'rules'  => 'required',
                    'errors' => [
                        'min_length' => 'Your {field} is too short. You want to get hacked?'
                    ]
                ],
                'atime' => [
                    'label'  => 'atime',
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
            $data = $this->request->getPost(array('article_title','sort_order','is_show','thumb','nav_id','atime','author'));

            $content=$this->request->getPost("content");
            $data["a_type"]=1;
            $cif=0;
            $ldata=[
                'title'=>'图文文章',
                'opdate'=> date('Y-m-d H:i:s'),
                'aid'=>$_SESSION['admin']['id']
            ];
            if($id){
                $data["updater_id"] =$_SESSION['admin']['id'] ;
                $data["update_date"] =date("Y-m-d H:i:s");
                $cif=$ArticleModel->upArticle($id,$data,$content);
                $ldata['describ']='修改文章内容，文章ID：'.$id.',标题：'.$data['article_title'];
                $ldata['optype']='修改文章';
            }else{
                $data["creator_id"] =$_SESSION['admin']['id'] ;
                $data["creat_date"] =date("Y-m-d H:i:s");

                $cif=$ArticleModel->inArticle($data,$content);
                $ldata['describ']='新增文章，标题：'.$data['article_title'];
                $ldata['optype']='新增文章';
            }
            $OpLogModel = new OpLogModel();
            $OpLogModel->inOpLog($ldata);
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
        helper('mycms_helper');
        $ArticleModel = new ArticleModel();
        $id=$this->request->getGet('id');
        $CateModel = new CateModel();
        $cat_list = $CateModel->select('id,label,n_type,pid')->where('status',1)->where('n_type',1)->get()->getResultArray();

//        $cat_list = $CateModel->select('id,cat_name,cat_type,pid,is_show,sort_order')->whereIn('cat_type',[1,4])->get()->getResultArray();
//        $cat_list = $this->buildMenuChild2(0,$cat_list);
//        $cat_list=$cat_list['my'];
        $data['a_type']=1;
        if($id){
            $list = $ArticleModel->getArticle('article.id,article_title,author,label,article.sort_order,article.is_show,article_content.content,article.thumb,article.atime',$id);
            $data['list']=$list;
        }
        $data['cat_list']=$cat_list;
        return view('SysAdmin\Article\art_form',$data);
    }
//递归获取子菜单
    private function buildMenuChild2($pid, $menuList){
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
    private function buildMenuChild($pid, $menuList){
        $treeList = [];
        $myList=[];
        foreach ($menuList as $v) {
            if ($pid == $v['pid']) {
                $node = (array)$v;
                $child = $this->buildMenuChild($v['id'], $menuList);
                $myList2=$child['my'];
                if (!empty($child['child'])) {
                    $node['child'] =$child['child'];
                }else{
                    $myList2[]=['id'=>$v['id'],'label'=>$v['label'],'n_type'=>$v['n_type']];
                }
                $myList=array_merge($myList,$myList2);
                // todo 后续此处加上用户的权限判断
                $treeList[] = $node;
            }
        }
        return ['child'=>$treeList,'my'=>$myList];
//        return $myList;
    }

    public function deleteArt(){
        $ArticleModel = new ArticleModel();
        $id=$this->request->getPost('id');
        $dnum=$ArticleModel->delArticle($id);
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
