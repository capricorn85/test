<?php
namespace SysAdmin\Models;

class LoginModel extends \CodeIgniter\Model
{
    protected $table = 'admin';
    protected $allowedFields = ['username','pwd','lastlogintime','logintime'];

    public function identifyID($username,$pwd){
        $admin=[];
        $admin = $this->where('username',$username)->first();
        if ($admin){
            $encrypter = service('encrypter');
            $pwd2= $encrypter->decrypt(base64_decode($admin['pwd']));
            //加载私钥
            $privateKey = file_get_contents(WRITEPATH . 'keys/private.pem');
            // 解密密码
            openssl_private_decrypt(base64_decode($pwd), $decryptedPassword, openssl_pkey_get_private($privateKey));



            if ($decryptedPassword==$pwd2){
                $admin['pwd']='';
                $roleid=explode(',',$admin["roleid"]);
                $db      = \Config\Database::connect();
                $builder = $db->table('role_auth');
//                $builderA = $db->table('a_authority');
//                $AA=$builderA->select('id,AC,name')->where('id',$admin["AA"])->get()->getRowArray();
                $premiss=$builder->select('scopes,mold')->join('authority','authority.id=role_auth.aid')->whereIn('rid',$roleid)->orderBy('mold','desc')->get()->getResult();
//                $MM=$this->db->getLastQuery();
//dd($MM);
//                处理 权限
                $p=[];
                foreach($premiss as $v){
                    $scopes=explode(',',$v->scopes);
                    foreach ($scopes as $v2){
                                switch ($v->mold){
                            case 8:
                                $p[$v2][0]=1;
                                break;
                            case 9:
                                $p[$v2][1]=1;
                                break;
                            case 10:
                                $p[$v2][3]=1;
                                break;
                            case 11:
                                $p[$v2][1]=1;
                                $p[$v2][3]=1;
                                break;
                            case 12:
                                $p[$v2][2]=1;
                                break;
                            case 13:
                                $p[$v2][1]=1;
                                $p[$v2][2]=1;
                                break;
                            case 14:
                                $p[$v2][2]=1;
                                $p[$v2][3]=1;
                                break;
                            case 15:
                                $p[$v2][1]=1;
                                $p[$v2][2]=1;
                                $p[$v2][3]=1;
                            default:
                                break;
                        } 
//
                    }
                }
                $p=json_encode($p);
                $p= base64_encode($encrypter->encrypt(base64_encode($p)));

                $admin['premiss']=$p;
//                $admin['AA']=$AA;
                return ['status'=>'success','admin'=>$admin];
            }else{
                return  ['status'=>'failed'];
            }
        }
        else{
            return  ['status'=>'failed'];
        }

//       return ['pt'=>$pwd1,'pwd'=>$pwd];
//        $encoded = bin2hex(\Config\Encryption::createKey(32));
//        return $encoded;

    }
    public function upAdmin($id,$login_data){
        $uid=[];
        if ($login_data){
            $this->set($login_data)->where('id',$id)->update();
        }

        return $uid;
    }
    public function getPre(){

    }
}