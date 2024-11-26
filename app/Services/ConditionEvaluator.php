<?php

namespace App\Services;

use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class ConditionEvaluator
{
    protected ExpressionLanguage $expressionLanguage;

    public function __construct()
    {
        $this->expressionLanguage = new ExpressionLanguage();
    }

    /**
     * Evalúa una condición basada en los datos proporcionados.
     *
     * @param string $condition
     * @param array $data
     * @return bool
     */
    public function evaluate(string $condition, array $data): bool
    {
        try {
            return $this->expressionLanguage->evaluate($condition, $data);
        } catch (\Exception $e) {
            // Manejar errores de evaluación
            return false;
        }
    }
}
