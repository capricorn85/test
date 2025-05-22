<?php
namespace Screen\Models;

class ArticleModel extends \CodeIgniter\Model
{
    protected $table = 'article';
    protected $allowedFields = ['cat_id','article_title','author','thumb','sort_order','update_date','creator_id','creat_date','updater_id','is_show','thumb','atime','issue_date','a_type'];
//    public $pager = \Config\Services::pager();

    public  function pager(){
        return $pager = \Config\Services::pager();

    }
    public function getList($sarray,$offset,$cid = false,$lnum=2)
    {
        if ($cid)
        {
            $list=$this->select($sarray)->where('cat_id',$cid)->join("category","category.id=article.cat_id")->orderBy('article.sort_order desc,update_date Desc')->findAll($lnum,$offset);
            return $list;
        }else{
            return $this->select($sarray)->join("category","category.id=article.cat_id")->orderBy('article.sort_order desc,update_date Desc')->paginate($lnum,$offset);
        }
    }
    public function getArticle($sarray,$id=false){
        if ($id)
        {
            return $this->select($sarray)->join("category","category.id=article.cat_id")->join("article_content","article_content.art_id=article.id")->where('article.id',$id)->first();

        }else{
            return false;

        }
    }
    public function upArticle($id=false,$data,$content){
        if ($id&&$data){

            $this->set($data)->where('id',$id)->update();

            $db      = \Config\Database::connect();
            $builder = $db->table('article_content');
//                更新文章内容
            $list=$builder->set('content',$content)->where('art_id',$id)->update();
            return $list;
        }else{
            return false;
        }
    }
    public function inArticle($data,$content=false){
        $aid=$this->insert($data);

        $db      = \Config\Database::connect();
        $builder = $db->table('article_content');
//                更新文章内容
//
        $data = array(
            'art_id' =>$aid,
            'content'  => $content
        );
        $list=$builder->insert($data);
        return $list;
    }
//    public function delAContent($cid = false){
//        if ($cid){
//            $cid=explode(',',$cid);
//            if (count($cid)>1){
//
//                    $table = 'article_content';
//                    $this->whereIn('art_id',$cid)->delete();
//
//            }else{
//                $table = 'article_content';
//                $this->where('art_id',$cid)->delete();
//
//            }
//
//
//            return $cid;
//        }else{
//            return false;
//        }
//    }

    public function delArticle($cid = false)
    {
        if ($cid){
            $cid=explode(',',$cid);
            if (count($cid)){
                    $this->whereIn('id',$cid)->delete();
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }

    }
}