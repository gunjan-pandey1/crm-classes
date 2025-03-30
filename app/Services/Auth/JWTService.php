<?php

namespace App\Services\Auth;

use App\Exceptions\InvalidTokenException;
use App\Exceptions\TokenExpiredException;
use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTService
{
    /**
     * Decrypt token
     *
     * @return mixed
     *
     * @throws Exception
     */
    public static function decryptFileBasedToken($token)
    {
        try {
            $filePath = config('services.jwt.private_key_file_full_path');
            $jwtPassphrase = config('services.jwt.passphrase_app');
            $jwt_private_key = openssl_pkey_get_private(file_get_contents($filePath), $jwtPassphrase);
            $publicKey = openssl_pkey_get_details($jwt_private_key)['key'];
            $decodedArray = (array) JWT::decode($token, new Key($publicKey, 'RS256'));

            return $decodedArray['data'];
        } catch (ExpiredException $e) {
            throw TokenExpiredException::withMessage();
        } catch (Exception $e) {
            throw InvalidTokenException::withMessage();
        }
    }

    /**
     * Encrypt token
     *
     * @return string
     */
    public static function encryptFileBasedToken($data)
    {
        try {
            $filePath = config('services.jwt.private_key_file_full_path');
            $jwtPassphrase = config('services.jwt.passphrase_app');
            $jwt_private_key = openssl_pkey_get_private(file_get_contents($filePath), $jwtPassphrase);
            $publicKey = openssl_pkey_get_details($jwt_private_key)['key'];
            $token = JWT::encode(['data' => $data], $publicKey, 'RS256');
            return $token;
        } catch (Exception $e) {
            throw $e;
        }
    }
}
