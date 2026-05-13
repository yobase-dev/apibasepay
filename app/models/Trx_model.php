<?php

class Trx_model {
    private $table = 'transactions';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getTrxById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getTrxByRefMerchant($userId, $refId) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE user_id = :user_id AND ref_id_merchant = :ref_id');
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':ref_id', $refId);
        return $this->db->single();
    }

    public function getTrxByRefOnly($refId) {
        // Looks by ref_id_merchant OR trx_id_yobase
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE ref_id_merchant = :ref_id OR trx_id_yobase = :ref_id');
        $this->db->bind(':ref_id', $refId);
        return $this->db->single();
    }

    public function getTrxByYoBaseTrxId($trxId) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE trx_id_yobase = :trx_id');
        $this->db->bind(':trx_id', $trxId);
        return $this->db->single();
    }

    public function createTransaction($data) {
        $query = "INSERT INTO " . $this->table . " (user_id, project_id, ref_id_merchant, trx_id_yobase, amount, fee_admin, net_amount, status, qr_url, payment_url) 
                  VALUES (:user_id, :project_id, :ref_id_merchant, :trx_id_yobase, :amount, :fee_admin, :net_amount, :status, :qr_url, :payment_url)";
        
        $this->db->query($query);
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':project_id', $data['project_id'] ?? null);
        $this->db->bind(':ref_id_merchant', $data['ref_id_merchant']);
        $this->db->bind(':trx_id_yobase', $data['trx_id_yobase']);
        $this->db->bind(':amount', $data['amount']);
        $this->db->bind(':fee_admin', $data['fee_admin']);
        $this->db->bind(':net_amount', $data['net_amount']);
        $this->db->bind(':status', 'PENDING');
        $this->db->bind(':qr_url', $data['qr_url'] ?? null);
        $this->db->bind(':payment_url', $data['payment_url'] ?? null);
        
        if ($this->db->execute()) {
            return $this->db->lastInsertId();
        }
        return false;
    }

    public function updateStatus($id, $status, $paidAt = null) {
        $query = 'UPDATE ' . $this->table . ' SET status = :status';
        if ($paidAt) {
            $query .= ', paid_at = :paid_at';
        }
        $query .= ' WHERE id = :id';

        $this->db->query($query);
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $id);
        if ($paidAt) {
            $this->db->bind(':paid_at', $paidAt);
        }
        return $this->db->execute();
    }

    public function getMerchantTransactions($userId) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE user_id = :user_id ORDER BY created_at DESC');
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }

    public function getAllTransactions() {
        $this->db->query('SELECT t.*, u.username FROM ' . $this->table . ' t JOIN users u ON t.user_id = u.id ORDER BY t.created_at DESC');
        return $this->db->resultSet();
    }
    
    public function getSummary($userId = null) {
        $query = "SELECT 
                    COUNT(*) as total_trx, 
                    SUM(CASE WHEN status = 'SUCCESS' THEN amount ELSE 0 END) as total_volume,
                    SUM(CASE WHEN status = 'SUCCESS' THEN fee_admin ELSE 0 END) as total_fees,
                    SUM(CASE WHEN status = 'SUCCESS' THEN net_amount ELSE 0 END) as total_net
                  FROM " . $this->table;
        if ($userId) {
            $query .= " WHERE user_id = :user_id";
            $this->db->query($query);
            $this->db->bind(':user_id', $userId);
        } else {
            $this->db->query($query);
        }
        return $this->db->single();
    }
}
