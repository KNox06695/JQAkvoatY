<?php
// 代码生成时间: 2025-08-28 14:27:46
class NetworkConnectionChecker {

    /**
     * Checks if a given host is reachable.
     *
     * @param string $host The host to check.
     * @param int $port The port to check.
     * @param int $timeout The timeout for the connection in seconds.
     * @return bool Returns true if the host is reachable, false otherwise.
     */
    public function checkHost($host, $port = 80, $timeout = 10) {
        try {
            // Attempt to open a socket connection to the host.
            $connection = @fsockopen($host, $port, $errno, $errstr, $timeout);
            
            // If the connection is successful, close it and return true.
            if ($connection) {
                fclose($connection);
                return true;
            } else {
                // Connection failed, return false.
                return false;
            }
        } catch (Exception $e) {
            // Handle any exceptions that occur.
            error_log('Error checking host: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Checks if the internet connection is active.
     *
     * @return bool Returns true if the internet connection is active, false otherwise.
     */
    public function checkInternetConnection() {
        return $this->checkHost('www.google.com', 80);
    }
}

// Usage example:
// $checker = new NetworkConnectionChecker();
// if ($checker->checkInternetConnection()) {
//     echo 'Internet connection is active.';
// } else {
//     echo 'No internet connection.';
// }