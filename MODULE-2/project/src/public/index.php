<?php

declare(strict_types=1);

// phpinfo();


echo '<pre>';
// print_r($_SERVER); // This is a superglobal variable.
echo '</pre>';

require_once '../Transaction.php';


// Classes and objects:
$transaction = new Transaction();

// Acessing a public property, in an object:
$transaction_description = $transaction->description;

// Altering a public property:
$transaction->description = 'A very cool transaction';

var_dump($transaction);


// $_SERVER will print something like this:
// Array
// (
//     [PHP_EXTRA_CONFIGURE_ARGS] => --enable-fpm --with-fpm-user=www-data --with-fpm-group=www-data --disable-cgi
//     [HOSTNAME] => b6e4d84aaf67
//     [PHP_INI_DIR] => /usr/local/etc/php
//     [HOME] => /var/www
//     [PHP_LDFLAGS] => -Wl,-O1 -pie
//     [PHP_CFLAGS] => -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64
//     [PHP_VERSION] => 8.0.2
//     [GPG_KEYS] => 1729F83938DA44E27BA0F4D3DBDB397470D12172 BFDDD28642824F8118EF77909B67A5C12229118F
//     [PHP_CPPFLAGS] => -fstack-protector-strong -fpic -fpie -O2 -D_LARGEFILE_SOURCE -D_FILE_OFFSET_BITS=64
//     [PHP_ASC_URL] => https://www.php.net/distributions/php-8.0.2.tar.xz.asc?a=1
//     [PHP_URL] => https://www.php.net/distributions/php-8.0.2.tar.xz?a=1
//     [PATH] => /usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin
//     [PHPIZE_DEPS] => autoconf 		dpkg-dev 		file 		g++ 		gcc 		libc-dev 		make 		pkg-config 		re2c
//     [PWD] => /var/www
//     [PHP_SHA256] => 84dd6e36f48c3a71ff5dceba375c1f6b34b71d4fa9e06b720780127176468ccc
//     [USER] => www-data
//     [HTTP_ACCEPT_LANGUAGE] => pt-BR,pt;q=0.9
//     [HTTP_ACCEPT_ENCODING] => gzip, deflate, br, zstd
//     [HTTP_SEC_FETCH_DEST] => document
//     [HTTP_SEC_FETCH_USER] => ?1
//     [HTTP_SEC_FETCH_MODE] => navigate
//     [HTTP_SEC_FETCH_SITE] => none
// [HTTP_ACCEPT] => text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7
//     [HTTP_USER_AGENT] => Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/127.0.0.0 Safari/537.36
//     [HTTP_UPGRADE_INSECURE_REQUESTS] => 1
//     [HTTP_SEC_CH_UA_PLATFORM] => "Windows"
//     [HTTP_SEC_CH_UA_MOBILE] => ?0
//     [HTTP_SEC_CH_UA] => "Not)A;Brand";v="99", "Google Chrome";v="127", "Chromium";v="127"
//     [HTTP_CACHE_CONTROL] => max-age=0
//     [HTTP_CONNECTION] => keep-alive
//     [HTTP_HOST] => localhost:8000
//     [SCRIPT_FILENAME] => /var/www/public/index.php
//     [REDIRECT_STATUS] => 200
//     [SERVER_NAME] => 
//     [SERVER_PORT] => 80
//     [SERVER_ADDR] => 172.18.0.3
//     [REMOTE_PORT] => 51168
//     [REMOTE_ADDR] => 172.18.0.1
//     [SERVER_SOFTWARE] => nginx/1.19.10
//     [GATEWAY_INTERFACE] => CGI/1.1
//     [REQUEST_SCHEME] => http
//     [SERVER_PROTOCOL] => HTTP/1.1
//     [DOCUMENT_ROOT] => /var/www/public
//     [DOCUMENT_URI] => /index.php
//     [REQUEST_URI] => /
//     [SCRIPT_NAME] => /index.php
//     [CONTENT_LENGTH] => 
//     [CONTENT_TYPE] => 
//     [REQUEST_METHOD] => GET
//     [QUERY_STRING] => 
//     [FCGI_ROLE] => RESPONDER
//     [PHP_SELF] => /index.php
//     [REQUEST_TIME_FLOAT] => 1722548133.5296
//     [REQUEST_TIME] => 1722548133
//     [argv] => Array
//         (
//         )

//     [argc] => 0
// )