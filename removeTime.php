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
        "title" => "Change Region",
        "subtitle" => "Redesign the assess UI region elements",
        'regions' => [ //Doc to changing the Assess player UI regions here: 
            //https://help.learnosity.com/hc/en-us/articles/360000758337-Customizing-the-Assessment-Player-experience-with-Regions#elements-and-buttons
            'top-right' => [
                ['type' => 'pause_button'],
                ['type' => 'itemcount_element'],
                ['type' => 'reading_timer_element']
            ],
            'right' => [
                ['type' => 'save_button'],
                ['type' => 'fullscreen_button'],
                ['type' => 'calculator_button']
            ],
            'top-left' => [
                ['type' => 'title_element'],
            ]
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
    let time = 0 //Created a time holder to update on 'time:changed'
    var itemsApp = LearnosityItems.init(<?php echo $signedRequest; ?>, {
        readyListener: function() {
            console.log('ReadyListener fired');

        }
    });
</script>