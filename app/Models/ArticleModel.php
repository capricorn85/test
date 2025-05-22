<?php
namespace App\Models;

class ArticleModel extends \CodeIgniter\Model
{
    protected $table = 'article';
//    public $pager = \Config\Services::pager();

    public  function pager(){
        return $pager = \Config\Services::pager();

    }
    public function getList($sarray,$offset,$cid = false,$lnum=2)
    {
        if ($cid)
        {
            $list=$this->select($sarray)->where('nav_id',$cid)->join("nav","nav.id=article.nav_id")->orderBy('article.sort_order desc,update_date Desc')->findAll($lnum,$offset);
            return $list;
        }else{
            return $this->select($sarray)->join("nav","nav.id=article.nav_id")->orderBy('article.sort_order desc,update_date Desc')->paginate($lnum,$offset);
        }
    }
    public function getArticle($sarray,$id=false){
        if ($id)
        {
            return $this->select($sarray)->join("nav","nav.id=article.nav_id")->join("article_content","article_content.art_id=article.id")->where('is_show',1)->where('article.id',$id)->first();

        }else{
            return false;

        }
    }

}