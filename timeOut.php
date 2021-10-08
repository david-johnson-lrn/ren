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
        "title" => "Timed Player",
        "subtitle" => "Default set for 5 seconds to finish all items in activity",
        'regions' => "main"
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

            var submitSettings = {
                show_submit_ui: true,
                show_submit_confirmation: false //settings to prevent user from choosing to submit
            }


            itemsApp.on('time:change', function() {
                time = itemsApp.getTime();
                if (time === 5) { //at 5 seconds automatically submit activity
                    alert("times Up!")
                    itemsApp.submit(submitSettings);
                    console.log("Test Submitted")
                }
            });


        }
    });
</script>