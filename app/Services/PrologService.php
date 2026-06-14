<?php

namespace App\Services;

class PrologService
{
    protected string $rutaArchivo;

    public function __construct()
    {
        $this->rutaArchivo = base_path('prolog/juego.pl');
    }

    public function consultar(string $goal): array
    {
        $goal = str_replace('"', '\\"', $goal);
        $cmd = "swipl -g \"consult('{$this->rutaArchivo}')\" "
             . "-g \"{$goal}\" "
             . "-g halt 2>/dev/null";

        $output = shell_exec($cmd);
        return $output ? explode("\n", trim($output)) : [];
    }
}