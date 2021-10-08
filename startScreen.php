<?php
require_once 'sdk/src/LearnositySdk/autoload.php';

use LearnositySdk\Request\Init;

$consumer_key = 'downloaddemo4o7M';
$consumer_secret = '74c5fd430cf1242a527f6223aebd42d30464be22';


$security = [
    'consumer_key' => $consumer_key,
    'domain' => 'localhost'
];

$request = [
    'mode' => 'activity_edit',
    'reference' => 'changeStartScreen',
    'user' => [
        'id' => 'user'
    ]
];
$Init = new Init('author', $security, $consumer_secret, $request);

$signedRequest = $Init->generate();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div id="learnosity-author">
    </div>
</body>

<script src="//authorapi.learnosity.com?v2021.2.LTS"></script>
<script>
    var authorApp = LearnosityAuthor.init(<?php echo $signedRequest; ?>, {
        readyListener: function() {
            console.log('ReadyListener fired');
        }
    });
</script>

</html>
<!-- Control how the start screen loads by either enabling or disabling the welcome screen.  Welcome screen can also be customized -->