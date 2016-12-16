<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2016/12/15
 * Project: Cat Visual
 */

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\BeeUserInfo;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Response;

class ApiController extends Controller {

    protected $_secret_key = 'JUCAICAT';


    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    ['actions' => ['bee_user_info'], 'allow' => true, 'roles' => ['?']],
                ],
            ],
            /*'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => ['bee_user_info' => ['post']],
            ],*/
        ];
    }

    public function actionBee_user_info() {

        $data = Yii::$app->getRequest()->post();

        /*$data = [
            'token' => md5($this->_secret_key . time()),
            'timestamp' => time(),
            'data' => [
                0 => [
                    'bee_user_id' => 1,
                    'user_code' => '30000000000000000000000000036132',
                    'full_name' => '张三',
                    'tel' => '1234567890',
                    'id_card_no' => '37050131988072150913',
                    'taobao' => 1,
                    'telcos' => 1,
                    'credit_card' => 1,
                    'user_info' => 1,
                    'id_card' => 1,
                    'order_no' => 22222,
                    'rule_status' => 1,
                    'created_time' => 21312312,
                    'email_is_have_data' => 1,
                    'first_status' => 2,
                    'order_status' => 2,
                    'is_valid' => 1,
                    'rule_list' => '无账单记录,无淘宝记录,无运营商记录,欺诈',
                    'audit_time' => 1212233334,
                    'request_time' => 234234324,
                ],

                1 => [
                    'bee_user_id' => 1,
                    'user_code' => '30000000000000000000000000036132',
                    'full_name' => '张三',
                    'tel' => '1234567890',
                    'id_card_no' => '3705031988107250913',
                    'taobao' => 1,
                    'telcos' => 1,
                    'credit_card' => 1,
                    'user_info' => 1,
                    'id_card' => 1,
                    'order_no' => 111111,
                    'rule_status' => 1,
                    'created_time' => 21312312,
                    'email_is_have_data' => 1,
                    'first_status' => 2,
                    'order_status' => 2,
                    'is_valid' => 1,
                    'rule_list' => '无账单记录,无淘宝记录,无运营商记录,欺诈',
                    'audit_time' => 1212233334,
                    'request_time' => 234234324,
                ],
            ],

        ];*/



        Yii::$app->getResponse()->format = Response::FORMAT_JSON;
        if (empty($data) || empty($data['token']) || empty($data['timestamp']) || empty($data['data'])) {
            return ['error_code' => 1, 'message' => 'fail'];
        }
        $my_token = md5($this->_secret_key . $data['timestamp']);
        if ($my_token != $data['token'] || $data['timestamp'] > (int)(time() + 300)) return ['error_code' => 1, 'message' => 'fail'];

        if (!empty($data['data']) && is_array($data['data'])) {
            foreach ($data['data'] as $v) {
                $v['created_time'] = date('Y-m-d H:i:s', $v['created_time']);
                $v['audit_time'] = date('Y-m-d H:i:s', $v['audit_time']);
                $v['request_time'] = date('Y-m-d H:i:s', $v['request_time']);

                $user_info = BeeUserInfo::findOne(['order_no' => $v['order_no']]);

                if ($user_info) {
                    $user_info->setAttributes($v);
                    $re = $user_info->save();
                    if (!$re) Yii::info("更新数据失败!---" . var_export($v, true));
                } else {
                    $model = new BeeUserInfo();
                    $model->setAttributes($v);
                    $re = $model->save();
                    if (!$re) Yii::info("更新数据失败!---" . var_export($v, true));
                }
            }
        }
        return ['error_code' => 0, 'message' => 'success'];
        // echo json_encode(['error_code' => 0, 'message' => 'success']);die;
    }
}