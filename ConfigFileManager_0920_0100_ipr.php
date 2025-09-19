<?php
// 代码生成时间: 2025-09-20 01:00:08
class ConfigFileManager {

    /**
     * Path to the configuration directory
     *
     * @var string
     */
    private $configDir;

    /**
     * Constructor for ConfigFileManager class
     *
     * @param string $configDir Path to the configuration directory
     */
    public function __construct($configDir) {
        $this->configDir = $configDir;
    }

    /**
     * Load a configuration file
     *
     * @param string $filename Name of the configuration file to load
     * @return array|null Configuration data or null if file not found
     */
    public function loadConfig($filename) {
        $filePath = $this->configDir . DIRECTORY_SEPARATOR . $filename;

        if (!file_exists($filePath) || !is_readable($filePath)) {
            // Handle error: Configuration file not found or not readable
            return null;
        }

        return include $filePath;
    }

    /**
     * Save a configuration file
     *
     * @param string $filename Name of the configuration file to save
     * @param array $data Configuration data to save
     * @return bool True on success, false on failure
     */
    public function saveConfig($filename, $data) {
        $filePath = $this->configDir . DIRECTORY_SEPARATOR . $filename;

        if (!is_writable($this->configDir)) {
            // Handle error: Configuration directory not writable
            return false;
        }

        // Convert the array to a PHP file format
        $configContent = "<?php
" . 'return ' . var_export($data, true) . ';';

        return file_put_contents($filePath, $configContent) !== false;
    }

    /**
     * Update a configuration file
     *
     * @param string $filename Name of the configuration file to update
     * @param array $data Configuration data to update
     * @return bool True on success, false on failure
     */
    public function updateConfig($filename, $data) {
        // Load the existing configuration data
        $configData = $this->loadConfig($filename);

        if ($configData === null) {
            // Handle error: Configuration file not found
            return false;
        }

        // Merge the new data with the existing data
        $configData = array_merge($configData, $data);

        // Save the updated configuration data
        return $this->saveConfig($filename, $configData);
    }
}
