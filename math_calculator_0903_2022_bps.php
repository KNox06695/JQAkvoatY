<?php
// 代码生成时间: 2025-09-03 20:22:30
// 文件名: math_calculator.php
// 功能描述: 实现一个数学计算工具集，包括加、减、乘、除等基本运算

class MathCalculator {
    // 加法运算
    public function add($a, $b) {
        $this->validateInputs($a, $b);
        return $a + $b;
    }

    // 减法运算
    public function subtract($a, $b) {
        $this->validateInputs($a, $b);
        return $a - $b;
    }

    // 乘法运算
    public function multiply($a, $b) {
        $this->validateInputs($a, $b);
        return $a * $b;
    }

    // 除法运算
    public function divide($a, $b) {
        $this->validateInputs($a, $b);
        if ($b == 0) {
            throw new InvalidArgumentException('除数不能为0');
        }
        return $a / $b;
    }

    // 输入验证
    private function validateInputs($a, $b) {
        if (!is_numeric($a) || !is_numeric($b)) {
            throw new InvalidArgumentException('输入必须是数字');
        }
    }
}

// 使用示例
try {
    $calculator = new MathCalculator();
    echo $calculator->add(10, 5) . "
";
    echo $calculator->subtract(10, 5) . "
";
    echo $calculator->multiply(10, 5) . "
";
    echo $calculator->divide(10, 5) . "
";
} catch (InvalidArgumentException $e) {
    echo '错误: ' . $e->getMessage();
}
