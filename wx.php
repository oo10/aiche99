﻿<?php
error_reporting(0);
require_once "jssdk.php";
$jssdk = new JSSDK("wxbf7d9c664397f1c6", "1e1e00eec732b7af38931ae5fbc1f339");//yourAppID，yourAppSecret
$signPackage = $jssdk->GetSignPackage();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title></title>
    <style>
        html,body{
            height: 100%;
            font-family: 'Microsoft JhengHei Light','Microsoft JhengHei','Microsoft YaHei Light','Microsoft YaHei',sans-serif;max-width: 640px;
        }
        button{
            width: 100%;
            border: 0;
            outline: 0;
            -webkit-appearance: none;
            background-color: #04be02;
            display: block;
            margin-top: 20px;
            margin-left: auto;
            margin-right: auto;
            padding:0 14px;
            font-size: 18px;
            text-align: center;
            text-decoration: none;
            overflow: visible;
            height: 42px;
            border-radius: 5px;
            -moz-border-radius: 5px;
            -webkit-border-radius: 5px;
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            color: #ffffff;
            line-height: 42px;
            -webkit-tap-highlight-color: rgba(255, 255, 255, 0);
            /*position: relative;*/
            /*top: 50%;*/
            /*transform: translateY(-50%);*/
        }
    </style>
</head>
<body>
<button onclick="QRtest()">扫一扫<small>(直接处理)</small></button>
<button onclick="QRtest2()">扫一扫<small>(返回值)</small></button>
<button onclick="MAPtest()">获取位置信息</button>
<button onclick="REtext1()">开始录音</button>
<button onclick="REtext2()">暂停录音</button>
<!--<button onclick="REtext3()">播放录音</button>-->
<button onclick="wx.closeWindow();">关闭窗口</button>

</body>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
    // 注意：所有的JS接口只能在公众号绑定的域名下调用，公众号开发者需要先登录微信公众平台进入“公众号设置”的“功能设置”里填写“JS接口安全域名”。
    // 如果发现在 Android 不能分享自定义内容，请到官网下载最新的包覆盖安装，Android 自定义分享接口需升级至 6.0.2.58 版本及以上。
    // 完整 JS-SDK 文档地址：http://mp.weixin.qq.com/wiki/7/aaa137b55fb2e0456bf8dd9148dd613f.html
    wx.config({
        appId: '<?php echo $signPackage["appId"];?>',
        timestamp: <?php echo $signPackage["timestamp"];?>,
        nonceStr: '<?php echo $signPackage["nonceStr"];?>',
        signature: '<?php echo $signPackage["signature"];?>',
        jsApiList: [        'checkJsApi',
            'onMenuShareTimeline',
            'onMenuShareAppMessage',
            'onMenuShareQQ',
            'onMenuShareWeibo',
            'onMenuShareQZone',
            'hideMenuItems',
            'showMenuItems',
            'hideAllNonBaseMenuItem',
            'showAllNonBaseMenuItem',
            'translateVoice',
            'startRecord',
            'stopRecord',
            'onVoiceRecordEnd',
            'playVoice',
            'onVoicePlayEnd',
            'pauseVoice',
            'stopVoice',
            'uploadVoice',
            'downloadVoice',
            'chooseImage',
            'previewImage',
            'uploadImage',
            'downloadImage',
            'getNetworkType',
            'openLocation',
            'getLocation',
            'hideOptionMenu',
            'showOptionMenu',
            'closeWindow',
            'scanQRCode',
            'chooseWXPay',
            'openProductSpecificView',
            'addCard',
            'chooseCard',
            'openCard'
            // 所有要调用的 API 都要加到这个列表中
        ]
    });
    wx.ready(function () {
    // 在这里调用 API

    });

    // 9.1.1 扫描二维码并返回结果
    function QRtest() {
        wx.scanQRCode();
        alert("调用扫一扫接口");
    };
    function QRtest2() {
        wx.scanQRCode({
            needResult: 1,
            desc: 'scanQRCode desc',
            success: function (res) {
                alert(JSON.stringify(res));
            }
        });
    };
    // 7.2 获取当前地理位置
    function MAPtest() {
        wx.getLocation({
            success: function (res) {
                alert(JSON.stringify(res));
            },
            cancel: function (res) {
                alert('用户拒绝授权获取地理位置');
            }
        });
    };
    // 4 音频接口
    // 4.2 开始录音
    function REtext1() {
        wx.startRecord({
            cancel: function () {
                alert('用户拒绝授权录音');
            }
        });
    };

    // 4.3 停止录音
     function REtext2() {
        wx.stopRecord({
            success: function (res) {
                voice.localId = res.localId;
            },
            fail: function (res) {
                alert(JSON.stringify(res));
            }
        });
    };

    // 4.4 监听录音自动停止
    wx.onVoiceRecordEnd({
        complete: function (res) {
            voice.localId = res.localId;
            alert('录音时间已超过一分钟');
        }
    });

    // 4.5 播放音频
    function REtext3() {
        if (voice.localId == '') {
            alert('请先使用 startRecord 接口录制一段声音');
            return;
        }
        wx.playVoice({
            localId: voice.localId
        });
    };
    // 8.7 关闭当前窗口
    function close() {
    };

    wx.error(function (res) {
        alert(res.errMsg);
    });
</script>
</html>