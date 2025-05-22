<?php


namespace SysAdmin\Models\Admin;


class SiteModel extends \CodeIgniter\Model
{
    protected $table = 'site';
    protected $allowedFields = ['site_name','tel','address','keywords','description','serial_num','sn_date','content','wswitch'];
    public function getData($sarray,$id=false){
            return $this->select($sarray)->first();
    }

//    public function getSNO($sarray,$id=false){
//        return $this->select($sarray)->first();
//    }
    public function getSNO($data){
        //            先获取当前流水号，如为当日流水号自增1，否则重置为1， 得出的serial_num为当前编号

        $this->db->transBegin();
        $seriaList=$this->select('serial_num,sn_date')->where('id',1)->first();
        $sn_date=date_create($seriaList['sn_date']) ;
        $data=array();
        if (date("Y-m-d")==date_format($sn_date,"Y-m-d")){
            $data=['serial_num'=>$seriaList['serial_num']+1,'sn_date'=>date("Y-m-d H:i:s")];
        }else{
            $data=['serial_num'=>1,'sn_date'=>date("Y-m-d H:i:s")];
        }
        $this->set($data)->where('id',1)->update();
        if ($this->db->transStatus() === FALSE)
        {
            $this->db->transRollback();
        }
        else
        {
            $this->db->transCommit();
        }
        return $data['serial_num'];
    }
}