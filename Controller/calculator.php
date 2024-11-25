<?php

class Calculator
{

    private $externalService;

    private $apiService;

    public function __construct(ExternalCalculatorService $externalService = null, $apiService = null) {
        $this->externalService = $externalService ?? new ExternalCalculatorService();
        $this->apiService = $apiService;
    }

    public function fetchDataFromAPI(string $endpoint) {
        return $this->apiService->fetch($endpoint);
    }

    public function calculateAdvancedOperation($a, $b, $c) {
        return $this->externalService->performComplexCalculation($a, $b, $c);
    }

    /**
     * @param mixed $a
     * @param mixed $b
     * 
     * @return [type]
     */
    public static function multiply(int $a,int $b): int
    {
        return $a * $b;
    }

    public static function add(int $a,int $b): int
    {
        return $a + $b;
    }

    public static function subtract(int $a,int $b): int
    {
        return $a - $b;
    }

    public static function divide(int $a,int $b): int
    {
        return $a / $b;
    }

    public static function throwExceptionCalculator(){
        throw new Exception("on divise pas par zero !");
    }

    public static function null() {
        return null;
    }

    public static function pair($number) {
        return $number % 2 === 0;
    }
}
