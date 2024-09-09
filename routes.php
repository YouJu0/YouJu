<?php

require_once __DIR__ . '/router.php';


get('/swiper', 'node_modules/swiper/swiper-bundle.min.css');
get('/preline', 'node_modules/preline/dist/preline.css');
style('/style', 'app/style/main.css');



get('/', 'app/views/index.php');
get('/login', 'app/views/auth/login.php');
get('/register', 'app/views/auth/register.php');
get('/chat', 'app/views/chat/index.php');





post('/controller/login', 'app/controllers/auth/module.login.php');
post('/controller/register', 'app/controllers/auth/module.register.php');
post('/controller/logout', 'app/controllers/session/module.close.php');


any('/404', 'app/views/404.php');
