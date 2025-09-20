<?php
// 代码生成时间: 2025-09-21 02:23:33
class ExcelGenerator {

    /**
     * 导出Excel文件
     * @param array $data 要导出的数据
     * @param string $filename 导出文件的名称
     * @return void
     */
    public function exportExcel(array $data, string $filename): void {
        try {
            // 检查数据是否为空
            if (empty($data)) {
                throw new Exception('Data is empty, cannot export to Excel.');
            }

            // 设置Excel文件的标题
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $sheet->setTitle('Data Export');

            // 设置表头
            $headerRow = 1;
            foreach (array_keys(reset($data)) as $columnKey) {
                $sheet->setCellValueByColumnAndRow($headerRow, array_search($columnKey, array_keys(reset($data))) + 1, $columnKey);
            }

            // 填充数据
            $rowNumber = 2;
            foreach ($data as $rowData) {
                foreach ($rowData as $columnKey => $columnValue) {
                    $sheet->setCellValueByColumnAndRow($rowNumber, array_search($columnKey, array_keys(reset($data))) + 1, $columnValue);
                }
                $rowNumber++;
            }

            // 保存Excel文件
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->save($filename);

            echo "Excel file has been generated successfully.";
        } catch (Exception $e) {
            // 错误处理
            echo "Error: " . $e->getMessage();
        }
    }

    /**
     * 生成示例数据
     * @return array
     */
    private function generateSampleData(): array {
        return [
            ['Name' => 'John Doe', 'Age' => 30, 'Job' => 'Developer'],
            ['Name' => 'Jane Doe', 'Age' => 25, 'Job' => 'Designer'],
            // Add more sample data as needed
        ];
    }
}

// 使用示例
$excelGenerator = new ExcelGenerator();
$data = $excelGenerator->generateSampleData();
$filename = 'sample_data.xlsx';
$excelGenerator->exportExcel($data, $filename);
