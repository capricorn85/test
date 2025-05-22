<?php namespace SysAdmin\Controllers;

use SysAdmin\Models\Admin\OpLogModel;

class OPLOG extends BaseController
{

    public function __construct(){
        parent::__construct();
        $this->nav_mold=[];
        $nav_id=301;
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
        $this->OpLogModel = new OpLogModel();
    }
    public function index()
    {
        $condition = $this->condition();
        $where = $condition["where"];
        $like = $condition["like"];
        $data = [
            'list'  =>$this->OpLogModel->select('op_log.id,title,describ,optype,opdate,op_log.notes,persons.name')
                ->where($where)
                ->like($like)
                ->join('admin', 'admin.id = op_log.id','left')
                ->join('persons', 'persons.pid = admin.pid','left')
                ->orderBy('id desc')
                ->paginate(15,'alist'),
            'pager' => $this->OpLogModel->pager,
            'nav_mold' =>$this->nav_mold,
        ];
        return view('SysAdmin\Views\LOG',$data);
    }




    function condition(){
        $where = [];
        $like = [];
          $item2 = trim($this->request->getGet("title"));
        if($item2 != ""){
            $like["title"] = $item2;
        }
        $item3 = trim($this->request->getGet("optype"));
        if($item3 != ""){
            $like["optype"] = $item3;
        }

        return [
            "where" => $where,
            "like" => $like
        ];
    }


//--------------------------------------------------------------------

}
