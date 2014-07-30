PJOSE
=====

PHP library to implements JOSE (Javascript Object Signing and Encryption)

Documentation for JSON Web Tokens
---------------------------------

* [draft-ietf-oauth-json-web-token-25](http://tools.ietf.org/html/draft-ietf-oauth-json-web-token-25)
* [JSON Web Signature (JWS)](http://tools.ietf.org/html/draft-ietf-jose-json-web-signature-31)
* [JSON Web Encryption (JWE)](http://tools.ietf.org/html/draft-ietf-jose-json-web-encryption-31)

Features
========

* Implements JSON Web Token (JWT) and Signature (JWS)
* Supported Algorithms: HS256, HS384 and HS 512
* Verify signed tokens
* JWE (Comming soon)

Version
=======

__0.1.0__

Install
=======

### Requirements

* PHP 5.4+
* [Composer](http://getcomposer.org)

### Via composer

This tool can be installed via Composer:

    {
        "require": {
            ""mostofreddy/pjose": "*"
        }
    }

License
=======

The MIT License (MIT). Please see [License File](https://github.com/mostofreddy/pjose/blob/master/LICENSE.md) for more information.

How is it used?
===============

JWT
---

### Encoding

    try {

        $jwt = new \mostofreddy\pjose\Jwt();
        $claims = array('name' => "mosto");
        $jwt->claims($claims);
        $token = (string) $jwt;

        echo $token.PHP_EOL;

    } catch (\Exception $e) {
        echo "ERROR: ".$e->getMessage().PHP_EOL;
    }

### Decoding

    try {

        $jwt = new \mostofreddy\pjose\Jws();
        $data = $jwt->decode($token);

        var_dump($token);

    } catch (\Exception $e) {
        echo "ERROR: ".$e->getMessage().PHP_EOL;
    }

JWS
---

### Signing

    try {

        $jws = new \mostofreddy\pjose\Jws();
        $claims = array('name' => "mosto");
        $jws->claims($claims);
        $jws->sign('secret');
        $token = (string) $jws;

        echo $token.PHP_EOL;

    } catch (\Exception $e) {
        echo "ERROR: ".$e->getMessage().PHP_EOL;
    }

### Verification

    try {

        $jws = new \mostofreddy\pjose\Jws();
        $result = $jwt->verify('secret', $token);

        var_dump($result);

    } catch (\Exception $e) {
        echo "ERROR: ".$e->getMessage().PHP_EOL;
    }

Examples
========

[Example directory](https://github.com/mostofreddy/pjose/tree/master/examples)

Run Tests
=========

    php vendor/bin/phpunit -c tests/phpunit.xml 


