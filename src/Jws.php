<?php
/**
 * Base64Url
 *
 * PHP version 5.4+
 *
 * Copyright (c) 2014 Federico Lozada Mosto <mosto.federico@gmail.com>
 * For the full copyright and license information, please view the LICENSE file that was distributed
 * with this source code.
 *
 * @category  Pjose
 * @package   Pjose
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2014 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
namespace mostofreddy\pjose;

/**
 * Base64Url
 *
 * @category  Pjose
 * @package   Pjose
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2014 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
class Jws extends Jwt
{
    protected $validAlgs = ['HS256', 'HS384', 'HS512'];
    /**
     * Sign generator
     *
     * @param  string $privatekey private key to sign
     * @param  string $alg        algorithm to encode
     * @return string
     */
    public function sign($privatekey, $alg = 'HS256')
    {
        $this->isValidAlg($alg);
        $this->header['alg'] = $alg;
        $this->sign = $this->signedToken($privatekey);
    }
    /**
     * Verify token
     *
     * @param  string     $privatekey private key to sign
     * @param  string     $jwt        token
     * @throws \Exception if invalid token
     * @return bool
     */
    public function verify($privatekey, $jwt)
    {
        $aux = $this->decode($jwt);

        $this->header = $aux['header'];
        $this->claims = $aux['claims'];
        $this->sign = $aux['sign'];

        return $this->sign === $this->compact($this->signedToken($privatekey));
    }

    /**
     * Validate algorithm
     *
     * @param  string           $alg algorithm
     * @throws \DomainException if unknow algorithm
     * @return boolean
     */
    protected function isValidAlg($alg)
    {
        if (!in_array($alg, $this->validAlgs)) {
            throw new \DomainException('Unknown algorithm: '.$alg);
        }

        return true;
    }
    /**
     * Sign generator
     *
     * @param string $privatekey private key
     *
     * @return string
     */
    private function signedToken($privatekey)
    {
        $sign = $this->compact($this->header).".".$this->compact($this->claims);
        switch ($this->header['alg']) {
            case 'HS256':
                return hash_hmac('sha256', $sign, $privatekey, true);
                break;
            case 'HS384':
                return hash_hmac('sha384', $sign, $privatekey, true);
                break;
            case 'HS512':
                return hash_hmac('sha512', $sign, $privatekey, true);
                break;
            default:
                throw new \DomainException('Unknown algorithm');
        }
    }
}
