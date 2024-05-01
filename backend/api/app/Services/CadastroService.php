<?php

namespace App\Services;

use App\Models\Models\Cadastro;

class CadastroService
{
    private $repo;

    public function __construct(Cadastro $model)
    {
        $this->repo = $model;
    }

    public function store(array $data)
    {
        $this->repo->create($data);
    }

    public function getList()
    {
        return $this->repo->all(); 
    }

    public function get($id)
    {
        return $this->repo->findOrFail($id);
    }
}