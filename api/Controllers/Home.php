<?php

namespace Api\Controllers;

use Api\Models\CateModel;


class Home extends BaseController
{
//    public function index()
//    {
//
//
//
//
//        return view('home');
//    }
    public function NavCateBS()
    {


        $CateModel = new CateModel();
        $cat_list = $CateModel->select("id,cat_name,column_ab,thumb")->where('is_show=1')->where('pid',15)->orderBy('sort_order desc,id asc')->get()->getResultArray();
        if ($cat_list)$data= [
            'status'=>200,
            'msg'=>'查询—成功',
            'list'=>$cat_list,
        ];
        else
            $data= [
                'status'=>100,
                'msg'=>'查询失败'];


        return json_encode($data);

//        return view('index', $data);
    }
    public function NavCateJG()
    {


        $CateModel = new CateModel();
        $cat_list = $CateModel->select("id,cat_name,column_ab,thumb")->where('is_show=1')->where('pid',16)->orderBy('sort_order desc,id asc')->get()->getResultArray();
        if ($cat_list)$data= [
            'status'=>200,
            'msg'=>'查询—成功',
            'list'=>$cat_list,
        ];
        else
            $data= [
                'status'=>100,
                'msg'=>'查询失败'];


        return json_encode($data);

//        return view('index', $data);
    }

    public function infoCate($catemsg)
    {


        $catemsg=explode('_',$catemsg);
//         var_dump($catemsg);
//         exit();
        $CateModel = new CateModel();
        $cat_list = $CateModel->select("id,content,cat_type,cat_name,column_ab,thumb")->where('column_ab',$catemsg[0])->where('id',$catemsg[1])->get()->getRowArray();

        if ($cat_list)$data= [
            'status'=>200,
            'msg'=>'查询—成功',
            'list'=>$cat_list,
        ];
        else
            $data= [
                'status'=>100,
                'msg'=>'查询失败'];


        return json_encode($data);
    }




}
