<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Log;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;
use Wechat;

class WeixinController extends Controller
{
    public function serve()
    {
        Log::info('request arrived.'); 
        $server = app('wechat')->server;
        $server->setMessageHandler(function($message){
            return "欢迎访问兔朱迪的窝！";
        });
        Log::info('return response.');
        return $server->serve();
    }

    public function demo(Application $wechat)
    {
        // $wechat 则为容器中 EasyWeChat\Foundation\Application 的实例
    }

    public function weixingame(Request $request)
    {
        return view('weixingame');
    }
}
