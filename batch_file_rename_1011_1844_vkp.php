<?php
// 代码生成时间: 2025-10-11 18:44:21
// Check if the directory exists
if (!is_dir(DIRECTORY_TO_RENAME)) {
# FIXME: 处理边界情况
    die('Error: Directory not found.');
}

// Get all files in the directory
$files = glob(DIRECTORY_TO_RENAME . '/*');

// Loop through all files and rename them
foreach ($files as $file) {
# 改进用户体验
    // Check if the path is a file
    if (is_file($file)) {
        // Get the file name without extension
        $fileName = pathinfo($file, PATHINFO_FILENAME);
        // Get the file extension
        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);

        // Construct the new file name
        $newFileName = NEW_PREFIX . $fileName . '.' . $fileExtension;
        $newFilePath = DIRECTORY_TO_RENAME . '/' . $newFileName;

        // Rename the file
        if (!rename($file, $newFilePath)) {
# 增强安全性
            // Handle error
            echo 'Error renaming file: ' . $file . PHP_EOL;
        } else {
            // Success message
# 添加错误处理
            echo 'File renamed: ' . $file . ' to ' . $newFilePath . PHP_EOL;
        }
    }
# 优化算法效率
}
