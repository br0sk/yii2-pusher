# yii2-pusher
A Yii2 extension for Pusher.com

This is an extension for Yii2 that makes it easy to use Pusher.

Add it to the composer file:
    
    "require": {
        "php": ">=5.4.0",
        "yiisoft/yii2": "*",
        "yiisoft/yii2-bootstrap": "*",
        "yiisoft/yii2-swiftmailer": "*",
	  	"br0sk/yii2-pusher": "0.*",
    },

You can configure it in your application `components` configuration like so:

    'pusher' => [
        'class'     => 'br0sk\pusher\Pusher',
        //Mandatory parameters
        'appId'     => 'YOUR_APP_ID',
        'appKey'    => 'YOUR_APP_KEY',
        'appsecret' => 'YOUR_APP_SECRET',
        //Optional parameter
        'options'   => ['encrypted' => true]
    ],
	
**note:** find the configuration details in your account by clicking on the app you want to use. 

An example of typical usage:

    Yii::$app->pusher->trigger( 'my-channel', 'my_event', 'hello world' );

This extension is a wrapper for [pusher-http-php](https://github.com/pusher/pusher-http-php)
