<?php

function hp_show($id = -1){
    $list = array(
        array(
            "id" => 1,
            "text" => "显示",
            "icon" => "",
        ),
        array(
            "id" =>0,
            "text" => "不显示",
            "icon" => "",
        )
    );
    return list_build($id,$list,-1);
}
function hp_capacity($id = -1){
    $list = array(  array(
        "id" => 0,
        "text" => "普通",
        "icon" => "",
    ),
        array(
            "id" => 1,
            "text" => "负责人",
            "icon" => "",
        ),
        array(
            "id" =>2,
            "text" => "管理员",
            "icon" => "",
        )
    );
    return list_build($id,$list,-1);
}
function hp_p_status($id = -1){
    $list = array(
        array(
            "id" => 1,
            "text" => "在职",
            "icon" => "",
        ),
        array(
            "id" =>0,
            "text" => "离职",
            "icon" => "",
        )
    );
    return list_build($id,$list,-1);
}
function hp_status($id = -1){
    $list = array(
        array(
            "id" => 1,
            "text" => "启用",
            "icon" => "",
        ),
        array(
            "id" =>0,
            "text" => "禁用",
            "icon" => "",
        )
    );
    return list_build($id,$list,-1);
}
function hp_cate_nav($id = -1){
    $list = array(
        array(
            "id" => 1,
            "text" => "市场主体",
            "icon" => "",
        ),
        array(
            "id" =>2,
            "text" => "预警平台",
            "icon" => "",
        ),
        array(
            "id" =>3,
            "text" => "档案系统",
            "icon" => "",
        ),
        array(
            "id" =>4,
            "text" => "系统管理",
            "icon" => "",
        )
    );
    return list_build($id,$list,-1);
}
function hp_d_status($id = -1){
    $list = array(
        array(
            "id" => 1,
            "text" => "正常",
            "icon" => "",
        ),
        array(
            "id" =>0,
            "text" => "停用",
            "icon" => "",
        )
    );
    return list_build($id,$list,-1);
}
function hp_k_belong($id = -1){
    $list = array(
        array(
            "id" => 1,
            "text" => "档案盒",
            "icon" => "",
        ),
        array(
            "id" =>0,
            "text" => "档案柜",
            "icon" => "",
        )
    );
    return list_build($id,$list,-1);
}


function hp_b_status($id = -1){
    $list = array(

        array(
            "id" =>1,
            "text" => "未生成",
            "icon" => "",
        ),
        array(
            "id" =>2,
            "text" => "已生成",
            "icon" => "",
        ),
        array(
            "id" =>3,
            "text" => "已失效",
            "icon" => "",
        )
    );
    return list_build($id,$list,-1);
}
//bstyle
function hp_t_status($id = -1){
    $list = array(

        array(
            "id" =>1,
            "text" => "有效",
            "icon" => "",
        ),
        array(
            "id" =>2,
            "text" => "失效",
            "icon" => "",
        ),

        array(
            "id" =>3,
            "text" => "作废",
            "icon" => "",
        )
    );
    return list_build($id,$list,-1);
}
function hp_s_type($id = -1){
    $list = array(
        array(
            "id" => 1,
            "text" => "幻灯片",
            "icon" => "",
        ),
        array(
            "id" =>2,
            "text" => "启动页",
            "icon" => "",
        )
    );
    return list_build($id,$list,-1);
}
//bstyle


//诉求处理状态
function hp_ap_type($id = -1){
    $list = array(
        array(
            "id" => 0,
            "text" => "未处理",
            "icon" => "",
        ),
        array(
            "id" => 1,
            "text" => "待处理",
            "icon" => "",
        ),
        array(
            "id" =>2,
            "text" => "已处理",
            "icon" => "",
        )

    );
    return list_build($id,$list,-1);
}
function hp_role_type($id = -1){	$list = array(
    array(
        "id" => 1,
        "text" => "角色",
        "icon" => "",
    ),
    array(
        "id" => 2,
        "text" => "角色组",
        "icon" => "",
    ),

);
    return list_build($id,$list,-1);}
function hp_link_type($id = -1){
    $list = array(
        array(
            "id" => 1,
            "text" => "栏目",
            "icon" => "",
        ),
        array(
            "id" => 2,
            "text" => "菜单",
            "icon" => "",
        ),

    );
    return list_build($id,$list,-1);}
function hp_cate_type($id = -1){
    $list = array(
        array(
            "id" => 1,
            "text" => "图文文章",
            "icon" => "",
        ),
        array(
            "id" =>2,
            "text" => "普通文章",
            "icon" => "",
        ),
        array(
            "id" =>3,
            "text" => "单页",
            "icon" => "",
        ),
        array(
            "id" =>4,
            "text" => "栏目",
            "icon" => "",
        ),
        array(
            "id" =>5,
            "text" => "超链接",
            "icon" => "",
        )
    );
    return list_build($id,$list,-1);
}

function hp_cate_mould($mould = 'acategory'){
    $list = array(

        array(
            "mould" => 'acategory',
            "text" => "文章",
        ),

        array(
            "mould" => 'pcategory',
            "text" => "PDF",
        ),
        array(
            "mould" => 'scategory',
            "text" => "单页-普通",
        ),
        array(
            "mould" => 'c_scategory',
            "text" => "单页-产品类",
        ),
        array(
            "mould" => 'u_scategory',
            "text" => "单页-联系我们",
        ),
        array(
            "mould" => 'icategory',
            "text" => "图片列表",
        ),
    );

    foreach ($list as $key => $value) {
        if($value["mould"] == $mould){
            return $value["text"];
        }else{
            return"null";
        }

    }
}
//图片类型
function hp_i_type($id = 0){
    $list = array(
        array(
            "id" => 1,
            "text" => "首页幻灯片",
            "icon" => "",
        ),
        array(
            "id" => 2,
            "text" => "LOGO",
            "icon" => "",
        )

    );
    return list_build($id,$list,0);
}
//身份
function hp_c_type($id = 0){
    $list = array(
        array(
            "id" => 1,
            "text" => "护渔员",
            "icon" => "",
        ),
        array(
            "id" => 2,
            "text" => "执法人员",
            "icon" => "",
        )

    );
    return list_build($id,$list,0);
}
function hp_a_status($id = -1){
    $list = array(  array(
        "id" => 0,
        "text" => "未关联账号",
        "icon" => "",
    ),
        array(
            "id" => 1,
            "text" => "已关联账号",
            "icon" => "",
        ),
//        array(
//            "id" =>2,
//            "text" => "账号停用",
//            "icon" => "",
//        )
    );
    return list_build($id,$list,-1);
}
function list_build($id, $list, $x) {
    if ($id != $x) {
        foreach ($list as $key => $value) {
            if ($value["id"] == $id) {
                return $value["text"];
            }
        }
        return "未知类型";
    } else {
        return $list;
    }
    return array(); // 如果没有找到匹配的id且id不等于x，也返回空数组（可选）
}


