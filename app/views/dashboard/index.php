<?php
$user = $data['user'];
$summary = $data['summary'];
$transactions = $data['transactions'];
$role = $_SESSION['role'];
?>

<div class="row mb-4 align-items-center" data-aos="fade-down">
    <div class="col">
        <h5 class="text-muted mb-0">Selamat datang kembali,</h5>
        <h2 class="fw-bold"><?= htmlspecialchars($user['username']) ?> <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 fs-6 align-middle ms-1"><?= strtoupper($role) ?></span></h2>
    </div>
    <div class="col-auto">
        <div class="glass-card px-4 py-3 d-flex align-items-center">
            <div class="me-3 bg-success bg-opacity-10 p-3 rounded-circle border border-success border-opacity-25 text-success">
                <i class="fa-solid fa-wallet fa-lg"></i>
            </div>
            <div>
                <span class="small text-muted d-block">Saldo Anda</span>
                <span class="fs-4 fw-bold text-white">Rp <?= number_format($user['balance'], 0, ',', '.') ?></span>
            </div>
        </div>
    </div>
</div>

<!-- Stat Cards -->
<div class="row mb-5 g-3" data-aos="fade-up">
    <div class="col-md-3 col-sm-6">
        <div class="glass-card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted fw-semibold">Total Transaksi</span>
                <div class="bg-secondary bg-opacity-10 text-muted p-2 rounded-3">
                    <i class="fa-solid fa-chart-bar"></i>
                </div>
            </div>
            <h3 class="fw-bold"><?= number_format($summary['total_trx'] ?? 0, 0, ',', '.') ?></h3>
            <p class="small text-muted mb-0">Semua status</p>
        </div>
    </div>
    
    <div class="col-md-3 col-sm-6">
        <div class="glass-card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted fw-semibold">Volume Sukses</span>
                <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-3">
                    <i class="fa-solid fa-money-bill-wave"></i>
                </div>
            </div>
            <h3 class="fw-bold">Rp <?= number_format($summary['total_volume'] ?? 0, 0, ',', '.') ?></h3>
            <p class="small text-muted mb-0">Omset kotor</p>
        </div>
    </div>

    <?php if ($role === 'admin'): ?>
    <div class="col-md-3 col-sm-6">
        <div class="glass-card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted fw-semibold">Profit Admin Fee</span>
                <div class="bg-warning bg-opacity-10 text-warning p-2 rounded-3">
                    <i class="fa-solid fa-hand-holding-dollar"></i>
                </div>
            </div>
            <h3 class="fw-bold text-warning">Rp <?= number_format($summary['total_fees'] ?? 0, 0, ',', '.') ?></h3>
            <p class="small text-muted mb-0">Keuntungan bersih</p>
        </div>
    </div>
    <?php else: ?>
    <div class="col-md-3 col-sm-6">
        <div class="glass-card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted fw-semibold">Potongan Fee</span>
                <div class="bg-danger bg-opacity-10 text-danger p-2 rounded-3">
                    <i class="fa-solid fa-percent"></i>
                </div>
            </div>
            <h3 class="fw-bold text-danger">Rp <?= number_format($summary['total_fees'] ?? 0, 0, ',', '.') ?></h3>
            <p class="small text-muted mb-0">Biaya gateway</p>
        </div>
    </div>
    <?php endif; ?>

    <div class="col-md-3 col-sm-6">
        <div class="glass-card p-4 h-100 border-success border-opacity-25">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted fw-semibold"><?= $role === 'admin' ? 'Total Disalurkan' : 'Volume Bersih' ?></span>
                <div class="bg-success bg-opacity-10 text-success p-2 rounded-3">
                    <i class="fa-solid fa-vault"></i>
                </div>
            </div>
            <h3 class="fw-bold text-success">Rp <?= number_format($summary['total_net'] ?? 0, 0, ',', '.') ?></h3>
            <p class="small text-muted mb-0">Net balance</p>
        </div>
    </div>
</div>

<!-- Transactions Table -->
<div class="glass-card p-4 mb-5" data-aos="fade-up" data-aos-delay="100">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0"><i class="fa-solid fa-list-check me-2 text-primary"></i> Riwayat Transaksi</h4>
        <a href="javascript:window.location.reload();" class="btn btn-sm btn-outline-secondary border-secondary border-opacity-25 text-white">
            <i class="fa-solid fa-arrows-rotate"></i> Refresh
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-glass align-middle mb-0">
            <thead>
                <tr>
                    <th>Waktu</th>
                    <?php if ($role === 'admin'): ?><th>Merchant</th><?php endif; ?>
                    <th>Ref ID Merchant</th>
                    <th>Trx ID YoBase</th>
                    <th class="text-end">Nominal</th>
                    <th class="text-end">Fee</th>
                    <th class="text-end">Net</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($transactions)): ?>
                    <tr>
                        <td colspan="<?= $role === 'admin' ? 8 : 7 ?>" class="text-center py-5 text-muted">
                            <i class="fa-solid fa-receipt fa-3x mb-3 opacity-25"></i>
                            <p class="mb-0">Belum ada data transaksi untuk ditampilkan.</p>
                        </td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($transactions as $trx): ?>
                        <tr>
                            <td class="text-muted" style="font-size: 0.9rem;">
                                <?= date('d M Y', strtotime($trx['created_at'])) ?><br>
                                <span class="text-opacity-50 small"><?= date('H:i:s', strtotime($trx['created_at'])) ?></span>
                            </td>
                            <?php if ($role === 'admin'): ?>
                                <td class="fw-semibold text-info"><?= htmlspecialchars($trx['username']) ?></td>
                            <?php endif; ?>
                            <td>
                                <code class="bg-dark bg-opacity-25 text-white-50 p-1 px-2 rounded"><?= htmlspecialchars($trx['ref_id_merchant']) ?></code>
                            </td>
                            <td class="small font-monospace text-muted">
                                <?= htmlspecialchars($trx['trx_id_yobase']) ?>
                            </td>
                            <td class="text-end fw-bold">Rp <?= number_format($trx['amount'], 0, ',', '.') ?></td>
                            <td class="text-end text-muted small">-Rp <?= number_format($trx['fee_admin'], 0, ',', '.') ?></td>
                            <td class="text-end text-success fw-semibold">Rp <?= number_format($trx['net_amount'], 0, ',', '.') ?></td>
                            <td class="text-center">
                                <?php if ($trx['status'] === 'PENDING'): ?>
                                    <span class="badge badge-status badge-pending">PENDING</span>
                                <?php elseif ($trx['status'] === 'SUCCESS'): ?>
                                    <span class="badge badge-status badge-success">SUCCESS</span>
                                <?php else: ?>
                                    <span class="badge badge-status badge-expired">EXPIRED</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
