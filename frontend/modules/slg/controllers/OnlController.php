<?php
/**
 * Created by PhpStorm.
 * Date: 16/7/12
 * Time: 22:56
 * @author: xuguoliang <1044748759@qq.com>
 */
namespace frontend\modules\slg\controllers;

use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\ContentNegotiator;
use yii\filters\RateLimiter;
use yii\filters\VerbFilter;
use yii\rest\ActiveController;
use yii\web\Response;

class OnlController extends ActiveController
{
    public $modelClass = 'frontend\modules\slg\models\runtime\Online';

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                    'application/xml' => Response::FORMAT_XML,
                ],
            ],
            'verbFilter' => [
                'class' => VerbFilter::className(),
                'actions' => $this->verbs(),
            ],
            'authenticator' => [
                'class' => CompositeAuth::className(),
            ],
            'rateLimiter' => [
                'class' => RateLimiter::className(),
            ]
        ];
    }


    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'minute' => [
                'class' => 'restAction\onl\MinuteAction',
                'modelClass'  => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'hour' => [
                'class' => 'restAction\onl\HourAction',
                'modelClass'  => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'day' => [
                'class' => 'restAction\onl\DayAction',
                'modelClass'  => $this->modelClass,
                'checkAccess' => [$this, 'checkAccess'],
            ],
            'options' => [
                'class' => 'yii\rest\OptionsAction',
            ]
        ];
    }
}
