<?php
// 代码生成时间: 2025-08-31 07:52:28
class AccessControl {

    /**
     * @var array $permissions Array of permissions a user has.
     */
    private $permissions = [];

    /**
     * Constructor
     *
     * @param array $permissions Permissions to be assigned to the object.
     */
    public function __construct(array $permissions) {
        $this->permissions = $permissions;
    }

    /**
     * Check if the user has the required permission.
     *
     * @param string $action The action to check permission for.
     * @return bool True if permission granted, false otherwise.
     */
    public function canPerformAction($action) {
        // Check if the action is set in the permissions array.
        return in_array($action, $this->permissions);
    }

    /**
     * Add a new permission to the permissions array.
     *
     * @param string $permission The permission to add.
     */
    public function addPermission($permission) {
        if (!in_array($permission, $this->permissions)) {
            $this->permissions[] = $permission;
        }
    }

    /**
     * Remove a permission from the permissions array.
     *
     * @param string $permission The permission to remove.
     */
    public function removePermission($permission) {
        if (($key = array_search($permission, $this->permissions)) !== false) {
            unset($this->permissions[$key]);
        }
    }

    /**
     * Get all permissions.
     *
     * @return array The list of permissions.
     */
    public function getPermissions() {
        return $this->permissions;
    }
}

// Example usage:
try {
    $permissions = ['edit', 'delete', 'view'];
    $accessControl = new AccessControl($permissions);
    if ($accessControl->canPerformAction('edit')) {
        echo 'Permission granted to edit.';
    } else {
        echo 'Permission denied.';
    }
} catch (Exception $e) {
    // Handle any exceptions that may occur.
    echo 'An error occurred: ' . $e->getMessage();
}
