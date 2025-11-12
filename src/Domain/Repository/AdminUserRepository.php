<?php

declare(strict_types=1);

namespace App\Domain\Repository;

interface AdminUserRepository
{
    public function findActiveByEmail(string $email): ?array;
    public function updateLastLogin(int $id, string $provider): void;
}
