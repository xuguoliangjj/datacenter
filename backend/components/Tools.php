<?php
/**
 * Created by PhpStorm.
 * User: xuguoliang
 * Date: 2015/8/16
 * Time: 18:51
 * @author xuguoliang <1044748759@qq.com>
 */
namespace backend\components;
use \yii\base\Object;
use Yii;
class Tools extends Object
{
    /**
     * 创建面包屑
     */
    public static function buildBreadcrumbs($view,$currLabel='')
    {
        $menus = $view->context->leftMenu;
        $route = $view->context->route;
        $breadCrumbs = [];
        foreach ($menus[0]['items'] as $item) {
            $url = trim($item['url'][0], '/');
            if (stripos($route, $url) === 0) {
                $label = trim(strip_tags($item['label']), '&nbsp;');
                $breadCrumbs[] = ['url' => [$item['url'][0]], 'label' => $label];
                $breadCrumbs[] = $currLabel;
                break;
            }
        }
        return $breadCrumbs;
    }

    /**
     * 将路由数组按照规则分组
     * @param $routes
     * @return array
     */
    public static function serializeRoutes($routes)
    {
        $result = [];
        foreach($routes as $key => $name){
            $arr = explode('/',$key);
            array_shift($arr);
            $build_key = $arr[0] . '_' . (isset($arr[1]) ? $arr[1] : '');
            $result[$build_key][$key] = $name;
        }
        return $result;
    }

    /**
     * 获取当前登录用户拥有权限的项目
     * @return array
     */
    public static function getPrevApp()
    {
        $apps = [];
        $authManager = Yii::$app->authManager;
        foreach ($authManager->getPermissionsByUser(Yii::$app->user->id) as $name => $role) {
            if (empty($term) or strpos($name, $term) !== false) {
                if(substr($name,0,3) === 'app'){
                    $apps[] = substr($name,4,strlen($name));
                }
            }
        }
        return $apps;
    }

}