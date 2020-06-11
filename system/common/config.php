<?php
return [
    'database' => [
        'host' => 'localhost',
        'name' => 'somedb',
        'user' => 'someuser',
        'pass' => 'somepass'
    ],
    'account' => [
      'key' => "4HE3Oq2KP5xppYYph+Wey+W5xOxaz2HQeB03OrIS0i54Hq2x76Z+6fq0DVtslV4pJoh+YFm40INkdVc0Olbsoy/JEWeWSu/f5qODUwCIF3k=",
      //openssl_random_pseudo_bytes();
      'ivlen' => 10,
      //openssl_cipher_iv_length($cipher="AES-128-CBC");
      'cipher' => "AES-128-CBC",
      'iv' => "3473281991-schol"
    ]
];
?>
