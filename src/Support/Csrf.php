<?php

declare(strict_types=1);

namespace App\Support;

final class Csrf
{
    private const KEY = '_csrf_token';
    private const TTL = 7200; // 120 min (você pode ler do .env depois)

    public static function token(): string
    {
        if (empty($_SESSION[self::KEY])) {
            $_SESSION[self::KEY] = [
                'v'   => bin2hex(random_bytes(32)),
                'ts'  => time(),
            ];
        }
        return $_SESSION[self::KEY]['v'];
    }

    public static function validate(?string $token): bool
    {
        if (empty($_SESSION[self::KEY])) {
            return false;
        }
        $data = $_SESSION[self::KEY];
        $valid = is_string($token) && hash_equals($data['v'], $token);
        $notExpired = (time() - $data['ts']) <= self::TTL;

        if ($valid && $notExpired) {
            // single-use: regen após uso
            unset($_SESSION[self::KEY]);
            return true;
        }
        return false;
    }
}
