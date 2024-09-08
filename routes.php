<?php

require_once __DIR__ . '/router.php';

// ##################################################
// ##################################################
// ##################################################

// Static GET
// In the URL -> http://localhost
// The output -> Index
get('/', 'app/views/index.php');



post('/user', 'app/api/save_user');

any('/404', 'app/views/404.php');
