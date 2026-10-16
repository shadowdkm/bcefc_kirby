<?php

/**
 * Template for site/config/server.php — copy it on the LIVE SERVER only
 * (the real file is git-ignored). See guides/content-workflow.md.
 */
return [
    'thathoff.git-content.disable'          => false,
    'thathoff.git-content.cronHooksEnabled' => true,
    // Long random string; also used in the GitHub webhook URL.
    'thathoff.git-content.cronHooksSecret'  => 'CHANGE-ME',
];
