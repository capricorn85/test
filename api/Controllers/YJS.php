<?php namespace Api\Controllers;


class YJS extends BaseController
{
  

    public function index()
	{
        

        return 'yjs';
	}

    public function Contact(){

        return view('Api\Views\contact');
    }

    public  function Category($cate=""){
        if ($cate=="") {

            return view('Api\Views\yjs');
        }
        // 企业变更 企业注销    企业迁移    个转企 歇业  开办餐饮店
        // qybg    qyzx    qyqy    gzq xy  kbcyd
        $c_img="";
       switch ($cate) {
            case 'qybg':
                $c_img='qybg';
//Material

                break;
            case 'qyzx':
                $c_img='qyzx';
                break;
            case 'qyqy':
                $c_img='qyqy';
                break;
            case 'gzq': 
//                echo "个转企待更新";
               $c_img='gzq';
                break;
                    case 'xy':
                        $c_img='xy';
                        break;
            case 'kbcyd':
//                echo "开办餐饮店待更新";
                $c_img='kbcyd';
                break;
            default:
                $c_img='404';
                break;
        }
        $data=[
            'c_img'=>$c_img,
            'cate'=>$cate
        ];

        return view('Api\Views\catemodel',$data);
    }

    // 获取菜单列表
    private function getMenuList(){
        $model = new NavModel();
        $menuList=$model->getNav('id,pid,title,icon,href,target');

        $menuList = $this->buildMenuChild(0, $menuList);
        return $menuList;
    }

   


}
