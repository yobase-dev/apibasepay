<?php

class Project_model {
    private $table = 'projects';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getProjectsByUserId($userId) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE user_id = :user_id ORDER BY created_at DESC');
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }

    public function getProjectById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getProjectByKey($key) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE project_key = :project_key');
        $this->db->bind(':project_key', $key);
        return $this->db->single();
    }

    public function createProject($userId, $name, $apiVersion, $webhookUrl = null) {
        // Unique project key generation
        $projectKey = 'PRJ_' . strtoupper(bin2hex(random_bytes(12)));

        $this->db->query('INSERT INTO ' . $this->table . ' (user_id, name, api_version, project_key, webhook_url) VALUES (:user_id, :name, :api_version, :project_key, :webhook_url)');
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':name', $name);
        $this->db->bind(':api_version', $apiVersion);
        $this->db->bind(':project_key', $projectKey);
        $this->db->bind(':webhook_url', $webhookUrl);

        return $this->db->execute();
    }

    public function deleteProject($id, $userId) {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id = :id AND user_id = :user_id');
        $this->db->bind(':id', $id);
        $this->db->bind(':user_id', $userId);
        return $this->db->execute();
    }
}
