<?php

class ExternalCalculatorService {
    public function performComplexCalculation(int $a, int $b, int $c)
    {
        return $a + sqrt($b * $c);
    }

    public function performComplexSuit(int $limit) {
        $result = "";
        for ($i = 0; $i <= $limit; $i++) {
            $result .= "$i, "; // Ajout d'une virgule et d'un espace comme séparateur
        }
        return rtrim($result, ', '); // Retirer la dernière virgule et espace
    }
}
