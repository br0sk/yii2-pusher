# yii2-pusher
A Yii2 extension for Pusher.com

This is an extension for Yii2 that makes it easy to use Pusher.

You can configure it in your application `components` configuration like so:

    'pusher' => [
        'class' => 'br0sk\pusher\Pusher',
        /*
         * Mandatory parameters.
         */
        'appId' => 'YOUR_APP_ID',
        'appKey' => 'YOUR_APP_KEY',
        'appSecret' => 'YOUR_APP_SECRET',
        /*
         * Optional parameters.
         */
        'options' => ['encrypted' => true, 'cluster' => 'YOUR_APP_CLUSTER']
    ],

**note:** Find the configuration details in your account by clicking on the app you want to use.

An example of typical usage:

    Yii::$app->pusher->push('my-channel', 'my_event', 'hello world');

This extension is a wrapper for [pusher-http-php](https://github.com/pusher/pusher-http-php)
