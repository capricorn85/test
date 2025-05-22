<?php

namespace App\Controllers;
use App\Models\SwiperModel;
use App\Models\NavModel;
use App\Models\ArticleModel;

class Home extends BaseController
{
    public function index(): string
    {
        $SwiperModel = new SwiperModel();
//        取logo 轮播图
        $swiper_list =$SwiperModel->getSwiperList('title,href','is_show=1','is_show=1');
        $data['swiper_list']=$swiper_list;
//        取菜单栏
        $NavModel = new NavModel();
        $cat_list = $NavModel->select("id,label,link_url,n_type,target,pid,thumb")->where('status=1')->orderBy('sort_order desc')->limit(14)->get()->getResultArray();

        $cat_list = $this->buildMenuChild(0, $cat_list);
        $data["cat_list"]=$cat_list;
//        dd($data);
        return view('index',$data);
    }

    public function  category($cid=1){
        if ($cid){
            $ArticleModel = new ArticleModel();
            $NavModel = new NavModel();
            $SwiperModel = new SwiperModel();
//            获取栏目类别，如为链接跳转类型，则显示出错。
            $n_current = $NavModel->select("id,link_url,label,n_type,target,pid")->where('id',$cid)->where('status=1')->get()->getRow();
            if (empty($n_current)){
                throw new \CodeIgniter\Exceptions\PageNotFoundException('页面未找到');
            }else{
                if ($n_current->n_type==5){
                    throw new \CodeIgniter\Exceptions\PageNotFoundException('页面未找到');
                }
            }


            $swiper_list =$SwiperModel->getSwiperList('title,href','is_show=1','is_show=1');
            $data = [
                'list'  => $ArticleModel->select('article.id,article_title,author,article.sort_order,atime,update_date,updater_id,article.is_show')
                    ->where('nav_id',$cid)
                    ->orderBy('article.sort_order desc,update_date Desc')
                    ->paginate(10,'alist'),
                'pager' => $ArticleModel->pager,

            ];

                $cat_list = $NavModel->select("id,link_url,label,n_type,target,pid")->where('status=1')->orderBy('sort_order desc,id asc')->limit(14)->get()->getResultArray();
                $cur_cat=$this->buildHierarchy($cat_list, $cid);
            if (!empty($cur_cat)){
                $cur_cat = array_reverse($cur_cat);
                $lastElement = end($cur_cat);
                $data["cur_cat"]=$cur_cat;
                $data["c_cat"]=$lastElement;
                $cat_list = $this->buildMenuChild(0, $cat_list);
                $data["cat_list"]=$cat_list;
                $data['swiper_list']=$swiper_list;
//        dd($data);
                return view('list',$data);
            }
        }
        throw new \CodeIgniter\Exceptions\PageNotFoundException('页面未找到');
    }
    public function  article($aid=1){
        $ArticleModel = new ArticleModel();
        $NavModel = new NavModel();
        $SwiperModel = new SwiperModel();
        $swiper_list =$SwiperModel->getSwiperList('title,href','is_show=1','is_show=1');
        $article='';
        if ($aid){
            $article=$ArticleModel->getArticle('article.id,article_title,author,atime,article_content.content,nav_id',$aid);

            if (!empty($article)){
                $cat_list = $NavModel->select("id,label,n_type,link_url,target,pid")->where('status=1')->orderBy('sort_order desc,id asc')->limit(14)->get()->getResultArray();
                $cur_cat=$this->buildHierarchy($cat_list, $article['nav_id']);
                $cur_cat = array_reverse($cur_cat);
                $lastElement = end($cur_cat);
                $data["cur_cat"]=$cur_cat;
                $data["c_cat"]=$lastElement;
                $cat_list = $this->buildMenuChild(0, $cat_list);
                $data["cat_list"]=$cat_list;
                $data['swiper_list']=$swiper_list;
                $data['article']=$article;
                return view('detail',$data);
            }
        }
        throw new \CodeIgniter\Exceptions\PageNotFoundException('页面未找到');

//        dd($data);


    }
    // 递归查找 Label
    // 递归构建层级路径
    private function buildHierarchy($categories, $id, $level = 0, $hierarchy = [])
    {
        foreach ($categories as $category) {
            if ($category['id'] == $id) {
                // 将当前分类添加到层级路径中
                $hierarchy[$level] = ['label' => $category['label'], 'cid' => $category['id']];

                // 如果 pid 为 0，返回构建的层级路径
                if ($category['pid'] == 0) {
                    return $hierarchy;
                } else {
                    // 否则递归查找 pid 对应的分类，并增加层级
                    return $this->buildHierarchy($categories, $category['pid'], $level + 1, $hierarchy);
                }
            }
        }
        return null; // 如果未找到，返回 null
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
}
