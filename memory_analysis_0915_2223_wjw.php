<?php
// 代码生成时间: 2025-09-15 22:23:17
class MemoryAnalysisController extends AppController {
    /**
     * Index method
     * @return void
     */
    public function index() {
        try {
            // Get current memory usage
            $currentMemoryUsage = memory_get_usage(true);
            // Get peak memory usage
            $peakMemoryUsage = memory_get_peak_usage(true);

            // Data to be returned as JSON
            $data = array(
                'current_usage' => $currentMemoryUsage,
                'peak_usage' => $peakMemoryUsage
            );

            // Set the response type to JSON and send the data
            $this->response->type('json');
            $this->set('data', $data);
            $this->render('json');

        } catch (Exception $e) {
            // Handle any exceptions that might occur
            $this->response->type('json');
            $this->set('error', 'Error analyzing memory usage: ' . $e->getMessage());
            $this->render('json');
        }
    }
}
