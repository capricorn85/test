<?php


namespace AdminSys\Controllers;


class upLoad  extends BaseController
{

    function upLoadImg($fname='artThumb'){
        $msg=[];
        $myfiles= $this->request->getFile('file');
        if ($myfiles->isValid() && ! $myfiles->hasMoved()) {
            $newName = $myfiles->getRandomName();
            $f_folder=$fname.'/'.date('Ymd');

            $myfiles->move(ROOTPATH.'public/uploads/'.$f_folder.'/', $newName);
            $path='uploads/'.$f_folder.'/'. $newName;

            $msg=[
                'code'=>200,
                'msg'=>'上传成功',
                'imgurl'=>$path
            ];


        }else{
            $msg=[
                'code'=>0,
                'msg'=>'上传失败'
            ];
            throw new RuntimeException($myfiles->getErrorString().'('.$myfiles->getError().')');
        }
        exit(json_encode($msg));
}
    function upLoadBImg(){


        $img= $this->request->getFile('file');
//        var_dump($img);
        $msg=[];
        if ($img->isValid() && ! $img->hasMoved()) {
            $newName = $img->getRandomName();
            $img->move(ROOTPATH.'public/uploads/B/', $newName);
            $imgpath=ROOTPATH.'public\uploads\B\\'.$newName;
            $path='uploads/B/'. $newName;
            try {
                $image =\Config\Services::image()
                    ->withFile($imgpath)
                    ->resize(1200, 900, true, 'width')
                    ->text('仅用于德阳市"一业一证"综合许可证公示', [
                        'color'      => '#fff',
                        'opacity'    => 0.5,
                        'withShadow' => true,
                        'hAlign'     => 'left',
                        'vAlign'     => 'top',
                        'yAlign'     => '350',
                        'xAlign'     => '0',
                        'vangle'     => '-35',
                        'fontPath'=>ROOTPATH.'public\uploads\fonts\STXINGKA.ttf',
                        'fontSize'   =>50
                    ])
                    ->save($imgpath);
            }
            catch (CodeIgniter\Images\ImageException $e)
            {
                echo $e->getMessage();
            }
            $msg=[
                'code'=>200,
                'msg'=>'上传成功',
                'imgurl'=>$path
            ];
        }else{
            $msg=[
                'code'=>0,
                'msg'=>'上传失败'
            ];
            throw new RuntimeException($img->getErrorString().'('.$img->getError().')');
        }
        exit(json_encode($msg));
    }

    function upLoadTImg(){


        $img= $this->request->getFile('file');
//        var_dump($img);
        $msg=[];
        if ($img->isValid() && ! $img->hasMoved()) {
            $newName = $img->getRandomName();
            $img->move(ROOTPATH.'public/uploads/T/', $newName);
            $imgpath=ROOTPATH.'public\uploads\T\\'.$newName;
            $path='uploads/T/'. $newName;
            try {
                $image =\Config\Services::image()
                    ->withFile($imgpath)
                    ->resize(1000, 1400, true, 'width')
                    ->text('仅用于德阳市"一业一证"综合许可证公示', [
                        'color'      => '#fff',
                        'opacity'    => 0.5,
                        'withShadow' => true,
                        'hAlign'     => 'left',
                        'vAlign'     => 'top',
                        'vangle'     => '-35',
                        'yAlign'     => '130',
                        'xAlign'     => '350',
                        'fontPath'=>ROOTPATH.'public\uploads\fonts\STXINGKA.ttf',
                        'fontSize'   =>50
                    ])
                    ->save($imgpath);
            }
            catch (CodeIgniter\Images\ImageException $e)
            {
                echo $e->getMessage();
            }
            $msg=[
                'code'=>200,
                'msg'=>'上传成功',
                'imgurl'=>$path
            ];
        }else{
            $msg=[
                'code'=>0,
                'msg'=>'上传失败'
            ];
            throw new RuntimeException($img->getErrorString().'('.$img->getError().')');
        }
        exit(json_encode($msg));
    }
    function upLoadCatImg(){

        $img= $this->request->getFile('file');
        $msg=[];
        if ($img->isValid() && ! $img->hasMoved()) {
            $newName = $img->getRandomName();
            $img->move(ROOTPATH.'public/uploads/catIcon/', $newName);
            $path='uploads/catIcon/'. $newName;


            $msg=[
                'code'=>200,
                'msg'=>'上传成功',
                'imgurl'=>$path
            ];
        }else{
            $msg=[
                'code'=>0,
                'msg'=>'上传失败'
            ];
            throw new RuntimeException($img->getErrorString().'('.$img->getError().')');
        }
        exit(json_encode($msg));
    }
    function upLoadSwiperImg(){

        $img= $this->request->getFile('file');
        $msg=[];
        if ($img->isValid() && ! $img->hasMoved()) {
            $newName = $img->getRandomName();
            $img->move(ROOTPATH.'public/uploads/swiper/', $newName);
            $path='uploads/swiper/'. $newName;


            $msg=[
                'code'=>200,
                'msg'=>'上传成功',
                'imgurl'=>$path
            ];
        }else{
            $msg=[
                'code'=>0,
                'msg'=>'上传失败'
            ];
            throw new RuntimeException($img->getErrorString().'('.$img->getError().')');
        }
        exit(json_encode($msg));
    }
    function upLoadEditorImg(){
        $msg=[];
        $files= $this->request->getFiles();
        if ($files){
            $i=0;
            $u=0;
            foreach ($files as $k=>$item){
                $i++;
                if ($item->isValid() && ! $item->hasMoved()) {
                    $newName = $item->getRandomName();
                    $item->move(ROOTPATH.'public/uploads/editor/', $newName);
                    $path='uploads/editor/'. $newName;
                    $u++;
                    $msg['img'][]=[
                        'msg'=>'图片'.$k.'上传成功',
                        'imgurl'=>$path
                    ];
                }else{
                    $msg['img'][]=[
                        'msg'=>'图片'.$k.'上传失败'
                    ];
                    throw new RuntimeException($item->getErrorString().'('.$item->getError().')');
                }

            }
            if ($i==$u){
                $msg['code']=200;
            }else if ($i>0&&$i<$u){
                $msg['code']=100;
            }else{
                $msg['code']=0;
            }
        }else{
            $msg['code']=0;
        }
        exit(json_encode($msg));
    }
    function upLoadAnnex(){
        $msg=[];
        $myfiles= $this->request->getFile('file');

        if ($myfiles->isValid() && ! $myfiles->hasMoved()) {
            $newName = $myfiles->getRandomName();
            $f_folder=date('Ymd');

            $myfiles->move(ROOTPATH.'public/uploads/'.$f_folder.'/', $newName);
            $path='uploads/'.$f_folder.'/'. $newName;

            $msg=[
                'code'=>200,
                'msg'=>'上传成功',
                'fileHref'=>$path
            ];
        }else{
            $msg=[
                'code'=>0,
                'msg'=>'上传失败'
            ];
            throw new RuntimeException($myfiles->getErrorString().'('.$myfiles->getError().')');
        }
        exit(json_encode($msg));
    }
    function upLoadEditorOne(){
        $msg=[];
        $myfiles= $this->request->getFile('file');
        if ($myfiles->isValid() && ! $myfiles->hasMoved()) {
            $newName = $myfiles->getRandomName();
            $f_folder='editor/'.date('Ymd');

            $myfiles->move(ROOTPATH.'public/uploads/'.$f_folder.'/', $newName);
            $path='uploads/'.$f_folder.'/'. $newName;

            $msg=[
                'errno'=>0,
                'data'=>[
                    'url'=> base_url().'/'.$path, // 图片 src ，必须
                    'alt'=> '上传成功', // 图片 src ，必须
                    'href'=> $path, // 图片的链接，非必须
                ],
            ];


        }else{
            $msg=[
                'code'=>100,
                'msg'=>'上传失败'
            ];
            throw new RuntimeException($myfiles->getErrorString().'('.$myfiles->getError().')');
        }
        exit(json_encode($msg));
    }
    function upLoadEditorArt(){
        $msg=[];
        $myfiles= $this->request->getFile('file');
        if ($myfiles->isValid() && ! $myfiles->hasMoved()) {
            $newName = $myfiles->getRandomName();
            $f_folder='article/'.date('Ymd');

            $myfiles->move(ROOTPATH.'public/uploads/'.$f_folder.'/', $newName);
            $path='uploads/'.$f_folder.'/'. $newName;

            $msg=[
                'errno'=>0,
                'data'=>[
                    'url'=> base_url().'/'.$path, // 图片 src ，必须
                    'alt'=> '上传成功', // 图片 src ，必须
                    'href'=> $path, // 图片的链接，非必须
                ],
            ];


        }else{
            $msg=[
                'code'=>100,
                'msg'=>'上传失败'
            ];
            throw new RuntimeException($myfiles->getErrorString().'('.$myfiles->getError().')');
        }
        exit(json_encode($msg));
    }
    function upLoadAnnexs(){
        $msg=[];
        $files= $this->request->getFiles();
        var_dump($files);

        if ($files){
            $i=0;
            $u=0;
            foreach ($files as $k=>$item){
                $i++;
                if ($item->isValid() && ! $item->hasMoved()) {
                   ;
//                    var_dump( $item->getBasename());
                    $newName = $item->getRandomName();
//                    var_dump($newName);

                    $item->move(ROOTPATH.'public/uploads/editor/', $newName);
                    $path='uploads/editor/'. $newName;
                    $u++;
                    $msg['img'][]=[
                        'msg'=>'图片'.$k.'上传成功',
                        'imgurl'=>$path
                    ];
                }else{
                    $msg['img'][]=[
                        'msg'=>'图片'.$k.'上传失败'
                    ];
                    throw new RuntimeException($item->getErrorString().'('.$item->getError().')');
                }

            }
            if ($i==$u){
                $msg['code']=200;
            }else if ($i>0&&$i<$u){
                $msg['code']=100;
            }else{
                $msg['code']=0;
            }
        }else{
            $msg['code']=0;
        }
        exit(json_encode($msg));
    }
}