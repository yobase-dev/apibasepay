<?php
$user = $data['user'];
$projects = $data['projects'];
?>

<div class="row mb-4" data-aos="fade-down">
    <div class="col">
        <h2 class="fw-bold"><i class="fa-solid fa-folder-open me-2 text-primary"></i> Kelola Proyek Merchant</h2>
        <p class="text-muted">Buat beberapa aplikasi terpisah untuk memilah data transaksi dan mengatur versi gateway (v1, v2, v3) untuk setiap proyek Anda.</p>
    </div>
</div>

<?php if (isset($_SESSION['flash_error'])): ?>
    <div class="alert alert-danger bg-opacity-10 border-danger border-opacity-25 text-danger mb-4" role="alert" data-aos="zoom-in">
        <i class="fa-solid fa-circle-exclamation me-2"></i> <?= $_SESSION['flash_error']; unset($_SESSION['flash_error']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['flash_success'])): ?>
    <div class="alert alert-success bg-opacity-10 border-success border-opacity-25 text-success mb-4" role="alert" data-aos="zoom-in">
        <i class="fa-solid fa-circle-check me-2"></i> <?= $_SESSION['flash_success']; unset($_SESSION['flash_success']); ?>
    </div>
<?php endif; ?>

<div class="row g-4 mb-5" data-aos="fade-up">
    <!-- Buat Proyek Form -->
    <div class="col-lg-4">
        <div class="glass-card p-4 h-100">
            <h5 class="fw-bold mb-3 pb-2 border-bottom"><i class="fa-solid fa-plus-circle me-1 text-primary"></i> Buat Proyek Baru</h5>
            
            <form action="<?= BASEURL ?>/dashboard/projects" method="POST">
                <div class="mb-3">
                    <label for="proj_name" class="form-label small fw-bold text-muted">Nama Proyek / Aplikasi</label>
                    <input type="text" class="form-control form-control-dark" id="proj_name" name="name" 
                           placeholder="Contoh: Toko Online Budi" required autocomplete="off">
                </div>
                
                <div class="mb-3">
                    <label for="api_version" class="form-label small fw-bold text-muted">Versi API YoBasePay</label>
                    <select class="form-select form-control-dark" id="api_version" name="api_version" required>
                        <option value="v3" selected>YoBasePay V3 (Terbaru - QRIS & Virtual Account)</option>
                        <option value="v2">YoBasePay V2 (Stabil - QRIS Statis)</option>
                        <option value="v1">YoBasePay V1 (Legacy)</option>
                    </select>
                    <div class="form-text text-muted small">Pilih versi gateway yang ingin digunakan oleh proyek ini.</div>
                </div>

                <div class="mb-4">
                    <label for="webhook_url" class="form-label small fw-bold text-muted">Project Webhook URL (Opsional)</label>
                    <input type="url" class="form-control form-control-dark" id="webhook_url" name="webhook_url" 
                           placeholder="https://api.toko.com/callback">
                    <div class="form-text text-muted small">Khusus notifikasi webhook yang ditujukan untuk proyek ini.</div>
                </div>
                
                <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                    <i class="fa-solid fa-floppy-disk me-2"></i> Buat Proyek
                </button>
            </form>
        </div>
    </div>

    <!-- Daftar Proyek -->
    <div class="col-lg-8">
        <div class="glass-card p-4 h-100">
            <h5 class="fw-bold mb-3 pb-2 border-bottom"><i class="fa-solid fa-list me-1 text-primary"></i> Proyek Aktif Anda</h5>
            
            <?php if (empty($projects)): ?>
                <div class="text-center py-5 text-muted">
                    <i class="fa-regular fa-folder-open fa-3x mb-3 opacity-50"></i>
                    <p class="mb-0">Belum ada proyek yang dibuat. Silakan buat proyek pertama Anda.</p>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover table-glass align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Nama Proyek</th>
                                <th class="text-center">Versi</th>
                                <th>Project Key</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($projects as $proj): ?>
                                <tr>
                                    <td>
                                        <span class="fw-bold text-dark"><?= htmlspecialchars($proj['name']) ?></span><br>
                                        <small class="text-muted font-monospace text-break" style="font-size: 0.75rem;">
                                            Webhook: <?= !empty($proj['webhook_url']) ? htmlspecialchars($proj['webhook_url']) : '<em class="opacity-50">Belum diatur</em>' ?>
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 text-uppercase">
                                            <?= htmlspecialchars($proj['api_version']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2 bg-light p-1 px-2 rounded border">
                                            <code class="small font-monospace text-danger flex-grow-1" id="key-<?= $proj['id'] ?>"><?= htmlspecialchars($proj['project_key']) ?></code>
                                            <button onclick="copyKey('<?= $proj['id'] ?>')" class="btn btn-sm p-0 border-0 text-muted" title="Salin Key">
                                                <i class="fa-regular fa-copy fa-xs"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="small text-muted">
                                        <?= date('d M Y', strtotime($proj['created_at'])) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
function copyKey(id) {
    const text = document.getElementById('key-' + id).innerText;
    navigator.clipboard.writeText(text).then(() => {
        alert('Project Key berhasil disalin!');
    }).catch(err => {
        console.error('Could not copy: ', err);
    });
}
</script>
