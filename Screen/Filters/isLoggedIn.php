<?php namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use SysAdmin\Models\sysCategory\SysCateModel;


class isLoggedIn implements FilterInterface
{
    public function before(RequestInterface $request,$auth=null)
    {
        // Do something here
        $session = session();
//        var_dump($_SESSION);
//        exit();
        if(empty($_SESSION['admin'])){
            return redirect('login');
        }else {

            $CateModel = new SysCateModel();
//            $data = [
//                'list'  =>$NavModel->select('id,title,status,sort,href,icon,pid,cate_id')
//                    ->where('href!=',' ')
//                ->orderBy('id asc')->get()->getResult(),
//                'title' => '后台栏目',
//            ];

            $navData=$CateModel->select('id,title,status,sort,href,icon,pid,cate_id')
                ->where('href!=',' ')
                ->orderBy('id asc')->get()->getResult();

            if ($_SESSION['admin']['id']!=1){
//                $con =uri_string();
//                $con=(explode("/",$con));

                $uri_string = uri_string(); // 返回类似 "/controller/method/param" 的字符串
                $uri_segments = explode("/", trim($uri_string, "/")); // 分割 URI 路径
                $first_uri_segment = isset($uri_segments[0]) ? $uri_segments[0] : ''; // 获取第一个部分，默认为空字符串

                $cur_nav_id=0;
//                $matched_id = 0;
// 检查特殊值列表
                $special_values = ['Home', 'upLoad', 'sys', ''];
                if (in_array($first_uri_segment, $special_values)) {
                    // 如果 $first_uri_segment 在特殊值列表中，则直接设置 ID 为 1（但注意这通常不是正确的逻辑）
                    // 这里我们暂时按照你的要求设置，但你可能需要重新考虑这部分逻辑
                    $cur_nav_id = 1;
                } else {
                    // 遍历导航数据，寻找匹配项
                    foreach ($navData as $navItem) {
                        // 提取 href 的最后一个部分
                        $lastHrefSegment = $this->getLastSegmentFromHref($navItem->href);

                        // 进行比较（但注意，这里的比较逻辑可能不是你真正想要的）
                        if ($lastHrefSegment === $first_uri_segment) {
                            // 找到匹配项，更新 ID 值（但根据描述，这里似乎不应该走到这一步，因为特殊值已经处理过了）
                            // 不过，为了符合你的代码结构，我们还是保留这部分逻辑
                            $cur_nav_id = $navItem->id;
                            break; // 退出循环
                        }
                    }
                }

// 输出匹配到的 ID 值
//                echo "Matched ID: " . $matched_id;
//                exit();
                // 假设 $admin['premiss'] 是经过加密和编码的字符串
                $encrypted_base64_json = $_SESSION['admin']['premiss'];
                $encrypter = service('encrypter');

                // 第一步：解密
                $decrypted_base64 = $encrypter->decrypt(base64_decode($encrypted_base64_json));

                // 第二步：Base64解码
                $decrypted_json = base64_decode($decrypted_base64);

                // 第三步：JSON解码
                $original_array = json_decode($decrypted_json, true); // 使用 true 得到数组而不是对象
//                var_dump($original_array);
//                var_dump($con);
//                var_dump($cur_nav_id);
//                exit;

                if (!isset($original_array[$cur_nav_id]))
                {
                    if ($cur_nav_id!=1) {
                        return redirect('login/Denied');
                    }
                }
            }
        }
    }

   private function getLastSegmentFromHref($href) {
        // 使用 parse_url 解析 URL，然后使用 explode 分割路径部分
        $path = parse_url($href, PHP_URL_PATH);
        $segments = explode('/', trim($path, '/'));
        return end($segments); // 返回数组最后一个元素
    }
    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = NULL)
    {
        // Do something here
    }
}