<?php
/**
 * Created by PhpStorm.
 * Author: ZhiPeng
 * Date: 2016/12/15
 * Project: Cat Visual
 */

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;


class BeeUserInfo extends ActiveRecord
{

    public static function  getDb() {
        return Yii::$app->msg_aliyun;
    }


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{jucaicat_bi.api_bee_user_credit_info_detail}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'bee_user_id', 'user_code', 'full_name', 'tel', 'id_card_no', 'taobao', 'telcos', 'credit_card', 'user_info', 'id_card', 'order_no', 'rule_status', 'created_time', 'email_is_have_data', 'first_status', 'order_status', 'is_valid', 'rule_list', 'audit_time', 'request_time'], 'safe']
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'bee_user_id' => 'bee_user_id',
            'user_code' => 'user_code',
            'full_name' => 'full_name',
            'tel' => 'tel',
            'id_card_no' => 'id_card_no',
            'taobao' => 'taobao',
            'telcos' => 'telcos',
            'credit_card' => 'credit_card',
            'user_info' => 'user_info',
            'id_card' => 'id_card',
            'order_no' => 'order_no',
            'rule_status' => 'rule_status',
            'created_time' => 'created_time',
            'email_is_have_data' => 'email_is_have_data',
            'first_status' => 'first_status',
            'order_status' => 'order_status',
            'is_valid' => 'is_valid',
            'rule_list' => 'rule_list',
            'audit_time' => 'audit_time',
            'request_time' => 'request_time',
        ];
    }
}