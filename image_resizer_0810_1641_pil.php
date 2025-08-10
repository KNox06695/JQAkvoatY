<?php
// 代码生成时间: 2025-08-10 16:41:41
class ImageResizer {
# NOTE: 重要实现细节
    /**
     * Resize images in a directory.
     *
     * @param string $sourceDir The directory containing the images to resize.
# FIXME: 处理边界情况
     * @param string $targetDir The directory where resized images will be saved.
# NOTE: 重要实现细节
     * @param int $width The new width for the images.
     * @param int $height The new height for the images.
     * @param string $resizeType The type of resizing to perform (e.g., 'resize', 'cropped', etc.).
# 扩展功能模块
     * @return void
     * @throws Exception If there is an error in resizing the images.
     */
    public function resizeImages($sourceDir, $targetDir, $width, $height, $resizeType = 'resize') {
        // Check if the source directory exists.
        if (!is_dir($sourceDir)) {
            throw new Exception("Source directory does not exist: {$sourceDir}");
        }

        // Check if the target directory exists, if not create it.
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Get all image files in the source directory.
        $files = scandir($sourceDir);

        foreach ($files as $file) {
            // Skip directories and non-image files.
            if (is_dir($sourceDir . '/' . $file) || !in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])) {
                continue;
            }

            // Resize the image and save to target directory.
            $imagePath = $sourceDir . '/' . $file;
            $newImagePath = $targetDir . '/' . $file;

            $image = new Imagick($imagePath);

            switch ($resizeType) {
                case 'resize':
                    $image->resizeImage($width, $height, Imagick::FILTER_LANCZOS, 1);
                    break;
                case 'cropped':
                    $image->cropResizeImage($width, $height);
# TODO: 优化性能
                    break;
                // Add more resize types as needed.
                default:
                    throw new Exception("Unsupported resize type: {$resizeType}");
            }

            // Save the resized image.
# 优化算法效率
            $image->writeImage($newImagePath);
            $image->clear();
            $image->destroy();
# 改进用户体验
        }
    }
}

// Example usage:
try {
    $resizer = new ImageResizer();
    $resizer->resizeImages('/path/to/source', '/path/to/target', 800, 600);
} catch (Exception $e) {
    echo 'Error resizing images: ' . $e->getMessage();
# TODO: 优化性能
}
