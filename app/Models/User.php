<?php

namespace App\Models;

class User
{
    private int $id;
    private string $login;
    private string $name;
    private string $cpfCnpj;
    private string $email;

    public function __construct(int $id, string $login, string $name, string $cpfCnpj, string $email)
    {
        $this->id = $id;
        $this->login = $login;
        $this->name = $name;
        $this->cpfCnpj = $cpfCnpj;
        $this->email = $email;
    }

}
