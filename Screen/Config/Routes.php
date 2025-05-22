<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('login', ['namespace' => 'SysAdmin\Controllers'], function($routes)//定义files接口路由
{
    $routes->post('/', 'Login::index');
    $routes->get('/', 'Login::index');
    $routes->get('Denied', 'Login::Denied');
    $routes->get('logout', 'Login::logout');

});
//web接口
$routes->group('api', ['namespace' => 'Api\Controllers'], function($routes)//定义board接口路由
{
    $routes->get('navHomebs', 'Home::NavCateBS');
    $routes->get('navHomejg', 'Home::NavCateJG');
    $routes->get('category/(:segment)', 'Home::infoCate/$1');
});

$routes->group('xccmssys', ['namespace' => 'SysAdmin\Controllers'], function($routes){


    $routes->get('/', 'Home::index');
    $routes->get('Sys_guide', 'Home::Sys_guide');
    $routes->get('getSystemInit', 'Home::getSystemInit');

    $routes->get('olog', 'OPLOG::index');
    $routes->get('pwdReset', 'Home::pwdReset');
    $routes->post('pwdReset', 'Home::pwdReset');
    $routes->group('Swipers', function($routes)//权限
    {
        $routes->get('/', 'Swipers::index');
        $routes->post('deleteSwiper', 'Swipers::deleteSwiper');
        $routes->post('eform', 'Swipers::eform');
        $routes->get('form', 'Swipers::form');
    });

    $routes->group('sysCategory', function($routes)//权限
    {
        $routes->get('/', 'sysCategory::index');
        $routes->post('deleteCat', 'sysCategory::deleteCat');
        $routes->post('eform', 'sysCategory::eform');
        $routes->get('form', 'sysCategory::form');
    });
    $routes->group('Admin', function($routes)//权限
    {
        $routes->get('/', 'Admin::index');
        $routes->post('adminDelete', 'Admin::adminDelete');
        $routes->get('adminForm', 'Admin::adminForm');
        $routes->post('AdminEForm', 'Admin::AdminEForm');
        $routes->post('pwdReset', 'Admin::pwdReset');
    });
    $routes->group('Department', function($routes)
    {
        $routes->get('/', 'Department::index');
        $routes->get('FilesClassify', 'Department::index');
        $routes->post('stopDep', 'Department::stopDep');
        $routes->post('eform', 'Department::eform');
        $routes->get('form', 'Department::form');
        $routes->get('getDlist', 'Department::getDlist');

    });
    $routes->group('Site', function($routes)
    {
        $routes->get('/', 'Site::index');
        $routes->post('upInfo', 'Site::upInfo');
    });
    $routes->group('Role', function($routes)//权限
    {
        $routes->get('/', 'Role::index');
        $routes->get('roleForm', 'Role::roleForm');
        $routes->post('RoleEForm', 'Role::roleEForm');
        $routes->post('authRoleForm', 'Role::authRoleForm');
        $routes->get('auth_role', 'Role::auth_role');
        $routes->post('roleDelete', 'Role::roleDelete');
    });
    $routes->group('Authority', function($routes)
    {
        $routes->get('/', 'Authority::index');
        $routes->get('authForm', 'Authority::authForm');
        $routes->post('AuthEForm', 'Authority::AuthEForm');
        $routes->post('authDelete', 'Authority::authDelete');
    });
    $routes->group('Persons', function($routes)
    {
        $routes->get('/', 'Persons::index');
        $routes->get('pdlist', 'Persons::getPDList');
        $routes->get('form', 'Persons::form');
        $routes->post('eform', 'Persons::eform');
        $routes->get('pmlist', 'Persons::getPMList');
        $routes->get('palist', 'Persons::getPAList');

    });
    $routes->group('nav', function($routes)//前台栏目
    {
        $routes->get('/', 'Nav::index');
        $routes->post('deleteNav', 'Nav::deleteNav');
        $routes->post('eform', 'Nav::eform');
        $routes->get('form', 'Nav::form');
    });

    $routes->group('cate', function($routes)//大屏栏目
    {
        $routes->get('/', 'Category::index');
        $routes->post('deleteCate', 'Category::deleteNav');
        $routes->post('eform', 'Category::eform');
        $routes->get('form', 'Category::form');
    });
    $routes->group('Article', function($routes)//权限
    {
        $routes->get('/', 'Article::index');
        $routes->post('deleteArt', 'Article::deleteArt');
        $routes->post('eform', 'Article::eform');
        $routes->get('form', 'Article::form');
    });
    $routes->group('imgArticle', function($routes)//权限
    {
        $routes->get('/', 'imgArticle::index');
        $routes->post('deleteArt', 'imgArticle::deleteArt');
        $routes->post('eform', 'imgArticle::eform');
        $routes->get('form', 'imgArticle::form');
    });
    $routes->group('upLoad', function($routes)//权限
    {
//        $routes->post('Annexs', 'upLoad::upLoadAnnexs');
        $routes->post('editorImg', 'upLoad::upLoadEditorOne');
        $routes->post('articleImg', 'upLoad::upLoadEditorArt');
        $routes->post('upLoadImg', 'upLoad::upLoadImg');
        $routes->post('upLoadCatImg', 'upLoad::upLoadImg/catImg');
        $routes->post('upLoadSwiperImg', 'upLoad::upLoadSwiperImg');

    });
});