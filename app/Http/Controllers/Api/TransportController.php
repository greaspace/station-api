<?php

namespace App\Http\Controllers\Api;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: Grea
 * Date: 2017/2/25
 * Time: 下午12:17
 */
class TransportController extends BaseController
{
    /**
     * @return array
     */
    public function orders()
    {
        $orders = [];
        for ($i=0; $i<10; $i++) {
            $order = [
                'id' => 123 + $i,
                'type' => 1, // 1，电话订单, 2,微信订单, 3, App订单
                'product' => [
                    'brand' => [
                        'id' => 2,
                        'name' => '景田',
                        'price' => 20,
                        'image' => 'http://temp.im/180x180'
                    ],
                    'amount' => 1
                ],
                'user' => [
                    'id' => $i + 100001,
                    'name' => '张三',
                    'mobile' => '13899019999',
                    'community' => '天通苑北二区',
                    'address' => '5号楼2单元301'
                ],
                'payment' => [
                    'type' => 1, // 1,货到付款, 2,微信支付, 3,支付宝
                    'total' => 20,
                    'status' => 1 // 0,未付款 1,已支付
                ],
                'transport' => [
                    'station' => '优源水站',
                    'transporter' => [
                        'name' => '王二麻子',
                        'mobile' => '18910481145'
                    ],
                    'status' => 2, // 0,已送达, 1,待配送, 2,配送中
                    'time' => time()
                ],
                'created_at' => time(),
                'transported_at' => time()
            ];
            $orders[] = $order;
        }

        return $orders;
    }

    /**
     * @param Request $request
     * @param null $id
     * @return array|void
     */
    public function finish (Request $request, $id = null) {
        $id = $id ? $id : $request->input('id');
        if ($id == null) {
            return $this->response->errorBadRequest();
        }

        $code = $request->input('code');

        $response = [];

        if ($code != '123456') {
            $response['success'] = false;
            $response['message'] = '验证码不正确';
            $response['error_code'] = 3721;
        } else {
            $response['success'] = true;
            $response['message'] = '配送成功!';
        }
        return $response;
    }

    public function push() {
        $config = config('push.jpush');
        $client = new PushClient($config['app_key'], $config['master_secret']);
        $pusher = $client->push();
        $pusher->setPlatform('all');
        $pusher->addAllAudience();
        $pusher->setNotificationAlert('Hello, JPush');

        try {
            $pusher->send();
        } catch (PushException $exception) {
            dump($exception);
        }
    }

}