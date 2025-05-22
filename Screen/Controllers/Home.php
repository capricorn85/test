<?php

namespace Screen\Controllers;

use Screen\Models\CateModel;


class Home extends BaseController
{
    public function index()
    {

//       var_dump("home");
//        $CateModel = new CateModel();
//        $cat_list = $CateModel->select("id,cat_name,column_ab")->where('is_show=1')->orderBy('sort_order desc')->limit(14)->get()->getResultArray();
//        $data["cat_list"]=$cat_list;


        return view('Screen\Views\home');
    }
    public function NavCateBS()
    {

//       var_dump("home");
        $CateModel = new CateModel();
        $cat_list = $CateModel->select("id,cat_name,column_ab,thumb")->where('is_show=1')->where('pid',15)->orderBy('sort_order desc')->limit(14)->get()->getResultArray();
        $data["cat_list"]=$cat_list;


        return view('Screen\Views\index', $data);
    }
    public function NavCateJG()
    {

//       var_dump("home");
        $CateModel = new CateModel();
        $cat_list = $CateModel->select("id,cat_name,column_ab,thumb")->where('is_show=1')->where('pid',16)->orderBy('sort_order desc')->limit(14)->get()->getResultArray();
        $data["cat_list"]=$cat_list;


        return view('Screen\Views\jgindex', $data);
    }

    public function infoCate($catemsg)
    {


        $catemsg=explode('_',$catemsg);
//         var_dump($catemsg);
//         exit();
        $CateModel = new CateModel();
        $cat_list = $CateModel->select("id,content,cat_type,cat_name,column_ab")->where('column_ab',$catemsg[0])->where('id',$catemsg[1])->get()->getRowArray();


        $data["catlist"]=$cat_list;

//        var_dump($data);
        return view('Screen\Views\scategory', $data);
    }




}
