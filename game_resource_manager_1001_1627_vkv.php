<?php
// 代码生成时间: 2025-10-01 16:27:00
class GameResourceManager {

    // Database connection
    private \$db;

    // Constructor
    public function __construct() {
        // Establish database connection
        \$this->db = new DatabaseConnection();
    }

    /**
     * Add a new game resource
     *
     * @param array \$data Resource data
     * @return bool
     */
    public function addResource(\$data) {
        try {
            // Validate data
            if (empty(\$data) || !is_array(\$data)) {
                throw new Exception('Invalid resource data');
            }

            // Insert data into the database
            $query = "INSERT INTO game_resources (name, description, quantity) VALUES (:name, :description, :quantity)";
            \$stmt = \$this->db->prepare($query);
            \$stmt->bindParam(':name', \$data['name']);
            \$stmt->bindParam(':description', \$data['description']);
            \$stmt->bindParam(':quantity', \$data['quantity']);

            // Execute the query
            if (\$stmt->execute()) {
                return true;
            } else {
                throw new Exception('Failed to add resource');
            }
        } catch (Exception \$e) {
            // Handle error
            error_log(\$e->getMessage());
            return false;
        }
    }

    /**
     * Update an existing game resource
     *
     * @param int \$id Resource ID
     * @param array \$data Resource data
     * @return bool
     */
    public function updateResource(\$id, \$data) {
        try {
            // Validate data
            if (empty(\$data) || !is_array(\$data)) {
                throw new Exception('Invalid resource data');
            }

            // Update data in the database
            $query = "UPDATE game_resources SET name = :name, description = :description, quantity = :quantity WHERE id = :id";
            \$stmt = \$this->db->prepare($query);
            \$stmt->bindParam(':id', \$id);
            \$stmt->bindParam(':name', \$data['name']);
            \$stmt->bindParam(':description', \$data['description']);
            \$stmt->bindParam(':quantity', \$data['quantity']);

            // Execute the query
            if (\$stmt->execute()) {
                return true;
            } else {
                throw new Exception('Failed to update resource');
            }
        } catch (Exception \$e) {
            // Handle error
            error_log(\$e->getMessage());
            return false;
        }
    }

    /**
     * Delete a game resource
     *
     * @param int \$id Resource ID
     * @return bool
     */
    public function deleteResource(\$id) {
        try {
            // Delete data from the database
            $query = "DELETE FROM game_resources WHERE id = :id";
            \$stmt = \$this->db->prepare($query);
            \$stmt->bindParam(':id', \$id);

            // Execute the query
            if (\$stmt->execute()) {
                return true;
            } else {
                throw new Exception('Failed to delete resource');
            }
        } catch (Exception \$e) {
            // Handle error
            error_log(\$e->getMessage());
            return false;
        }
    }

    /**
     * Get a list of game resources
     *
     * @return array
     */
    public function getResources() {
        try {
            // Fetch data from the database
            $query = "SELECT * FROM game_resources";
            \$stmt = \$this->db->query($query);

            // Fetch all results
            $results = \$stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } catch (Exception \$e) {
            // Handle error
            error_log(\$e->getMessage());
            return [];
        }
    }
}

/**
 * Database Connection
 *
 * This class handles the database connection.
 */
class DatabaseConnection {

    // Database connection
    private \$pdo;

    // Constructor
    public function __construct() {
        // Establish database connection using PDO
        \$host = 'localhost';
        \$dbname = 'game_resources';
        \$user = 'root';
        \$pass = '';

        try {
            \$this->pdo = new PDO("mysql:host=\$host;dbname=\$dbname", \$user, \$pass);
            \$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException \$e) {
            error_log(\$e->getMessage());
            die('Database connection failed');
        }
    }

    // Get PDO instance
    public function getPdo() {
        return \$this->pdo;
    }

    // Prepare a query
    public function prepare(\$query) {
        return \$this->pdo->prepare(\$query);
    }

    // Query the database
    public function query(\$query) {
        return \$this->pdo->query(\$query);
    }
}
