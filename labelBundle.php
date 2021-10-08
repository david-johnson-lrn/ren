<?php
require_once 'sdk/src/LearnositySdk/autoload.php';

use LearnositySdk\Request\Init;
use LearnositySdk\Utils\Uuid;

$consumer_key = 'downloaddemo4o7M';
$consumer_secret = '74c5fd430cf1242a527f6223aebd42d30464be22';

$session_id = Uuid::generate();

$security = [
    'consumer_key' => $consumer_key,
    'domain'       => 'localhost'
];
$request = [
    'user_id'              => '12345',
    'session_id'           => $session_id,
    'name'                 => 'Learnosity',
    'activity_id'          => 'item_activity_demo',
    'activity_template_id' => 'demo-activity-1',
    "config" => [
        "title" => "This is my Learnosity Assessment Player",
        "subtitle" => "It uses an Activity created with Author API and displays it in Assess mode",
        "labelBundle" => [ // full list of available label bundle config choices here: https://reference.learnosity.com/assess-api/assess-api-i18n#labelBundle
            'itemCountOf' => '/'
        ]
    ]
];

$Init = new Init('items', $security, $consumer_secret, $request);
$signedRequest = $Init->generate();

?>
<!------------------------------------------------------------------------------------------------------------------------------->

<div id="learnosity_assess"></div>

<script src="//items.learnosity.com?v2021.2.LTS"></script>

<script>
    var itemsApp = LearnosityItems.init(<?php echo $signedRequest; ?>, {
        readyListener: function() {
            console.log('ReadyListener fired');
            console.log(window.LearnosityAssess.init())

        }
    });
</script>