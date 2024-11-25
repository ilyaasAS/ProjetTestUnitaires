<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . "/../Controller/calculator.php";
require_once __DIR__ . '/../Controller/ExternalCalculatorService.php';
require_once __DIR__ . '/../Controller/APIService.php';

/**
 * @group simpletests
 */
class CalculatorTest extends TestCase
{
    private $calculator;

    protected function setUp(): void
    {
        $this->calculator = new Calculator();
    }

    /**
     * @group simpleTests
     * @group additionGroup
     */
    public function testAdd(): void
    {
        $result = $this->calculator->add(2, 3);
        $this->assertEquals(5, $result);
    }

    /**
     * @group simpleTests
     * @group multiplicationGroup
     */
    public function testMultiply(): void
    {
        $result = $this->calculator->multiply(2, 3);
        $this->assertEquals(6, $result);
    }

    /**
     * @group simpleTests
     * @group subtractionGroup
     */
    public function testSubtract()
    {
        $result = $this->calculator->subtract(8, 4);
        $this->assertEquals(4, $result);
    }

    /**
     * @group simpleTests
     * @group divisionGroup
     */
    public function testDivide()
    {
        $result = $this->calculator->divide(8, 2);
        $this->assertNotNull($result);
        $this->assertTrue(is_int($result));
    }

    /**
     * @group exceptionTests
     */
    public function testThrowManualException()
    {
        $this->expectExceptionMessage("on divise pas par zero !");
        $this->calculator->throwExceptionCalculator();
    }

    /**
     * @group simpleTests
     * @group nullGroup
     */
    public function testNull()
    {
        $result = $this->calculator->null();
        $this->assertNull($result);
    }

    /**
     * @group simpleTests
     * @group pairGroup
     */
    public function testPair()
    {
        $result = $this->calculator->pair(4);
        $this->assertTrue($result);
    }

    /**
     * @group divisionTests
     * @dataProvider divisionProvider
     */
    public function testDivideGroup(int $a, int $b, int $expected)
    {
        if ($b === 0) {
            $this->expectException(DivisionByZeroError::class);
            $this->expectExceptionMessage("Division by zero");
        }
        $result = $this->calculator->divide($a, $b);
        $this->assertEquals($expected, $result);
    }

    public static function divisionProvider()
    {
        return [
            [12, 4, 3],
            [44, 2, 22],
            [6, 0, 0]
        ];
    }

    /**
     * @group additionTests
     * @group additionGroup
     * @dataProvider additionProvider
     */
    public function testAddGroup($a, $b, $expected)
    {
        $result = $this->calculator->add($a, $b);
        $this->assertEquals($expected, $result);
    }

    public static function additionProvider()
    {
        return [
            [1, 2, 3],
            [0, 0, 0],
            [-1, 1, 0],
            [12, 85, 97],
            [3, 3, 6],
        ];
    }

    /**
     * @group subtractionTests
     * @dataProvider substractionProvider
     */
    public function testSubGroup($a, $b, $expected)
    {
        $result = $this->calculator->subtract($a, $b);
        $this->assertEquals($expected, $result);
    }

    public static function substractionProvider()
    {
        return [
            [8, 2, 6],
            [16, 2, 14],
            [30, 2, 28],
        ];
    }

    /**
     * @group complexOperationTests
     */
    public function testCalculatedComplexOperation()
    {
        $externalServiceMock = $this->createMock(ExternalCalculatorService::class);

        $externalServiceMock
            ->expects($this->once())
            ->method('performComplexCalculation')
            ->with(1, 9, 9)
            ->willReturn(42);

        $calculator = new Calculator($externalServiceMock);
        $result = $calculator->calculateAdvancedOperation(1, 9, 9);
        $this->assertEquals(42, $result);
        unset($calculator);
    }

    /**
     * @group apiTests
     */
    public function testFetchDataFromAPI()
    {
        $mockapiservice = $this->createMock(APIService::class);
        $mockapiservice
            ->method("fetch")
            ->with("/posts")
            ->willReturn(["data" => "value"]);

        $calculator = new Calculator(apiService: $mockapiservice);
        $result = $calculator->fetchDataFromAPI("/posts");
        $this->assertEquals(["data" => "value"], $result);
    }

    protected function tearDown(): void
    {
        unset($this->calculator);
    }
}
