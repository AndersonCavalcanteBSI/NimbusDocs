<?php

declare(strict_types=1);

namespace App\Presentation\Controller\Admin\Auth;

class LoginController
{
    private array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * GET /admin/login
     */
    public function showLoginForm(array $vars = []): void
    {
        // Aqui no futuro vamos gerar token CSRF e mensagens de erro da sessão
        $pageTitle   = 'Login Administrativo - NimbusDocs';
        $contentView = __DIR__ . '/../../../View/admin/auth/login.php';

        // Dados que a view pode usar (por enquanto, tudo vazio)
        $viewData = [
            'errorMessage' => null,
            'oldEmail'     => '',
            'csrfToken'    => '', // depois conectamos com um helper de CSRF
        ];

        require __DIR__ . '/../../../View/admin/layouts/base.php';
    }

    /**
     * POST /admin/login
     *
     * Aqui depois vamos validar CSRF, checar credenciais no banco,
     * iniciar sessão do admin e redirecionar.
     */
    public function handleLogin(array $vars = []): void
    {
        // Por enquanto, apenas redireciona de volta para o formulário.
        header('Location: /admin/login');
        exit;
    }
}
