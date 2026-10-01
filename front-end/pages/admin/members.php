<?php ob_start(); ?>

<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <nav aria-label="breadcrumb" class="mb-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/AIMS-Cooperative-Management-System/admin-dashboard">Dashboard</a></li>
                    <li class="breadcrumb-item active">Member Management</li>
                </ol>
            </nav>
            <h4 class="fw-bold mb-1">Member Management</h4>
            <span class="text-muted">Manage members, view details, and handle documents.</span>
        </div>
        <a href="/AIMS-Cooperative-Management-System/create-member" class="btn btn-primary"><i class="bi bi-person-plus me-1"></i>Add Member</a>
    </div>
</div>

<?php if ($flashMessage !== ''): ?>
    <div class="alert alert-success"><?= htmlspecialchars($flashMessage) ?></div>
<?php endif; ?>

<?php if (!$databaseAvailable): ?>
    <div class="alert alert-warning">Database connection is not available. Import the SQL schema at <strong>back-end/config/member-management-schema.sql</strong> and configure the database connection settings.</div>
<?php else: ?>
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <form method="GET" class="row g-2 align-items-end">
                    <div class="col-12 col-md-5">
                        <label class="form-label">Search</label>
                        <input type="text" name="search" class="form-control" value="<?= htmlspecialchars($search) ?>" placeholder="Name, ID, email, phone">
                    </div>
                    <div class="col-12 col-md-3">
                        <label class="form-label">Member Type</label>
                        <select name="member_type" class="form-select">
                            <option value="">All</option>
                            <option value="Worker" <?= $memberType === 'Worker' ? 'selected' : '' ?>>Worker</option>
                            <option value="Staff" <?= $memberType === 'Staff' ? 'selected' : '' ?>>Staff</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-3">
                        <label class="form-label">Membership Status</label>
                        <select name="membership_status" class="form-select">
                            <option value="">All</option>
                            <option value="Active" <?= $membershipStatus === 'Active' ? 'selected' : '' ?>>Active</option>
                            <option value="Pending" <?= $membershipStatus === 'Pending' ? 'selected' : '' ?>>Pending</option>
                            <option value="Probationary" <?= $membershipStatus === 'Probationary' ? 'selected' : '' ?>>Probationary</option>
                            <option value="Inactive" <?= $membershipStatus === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-1 d-grid">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Member ID</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Contact</th>
                                <th>Membership</th>
                                <th>Account</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($members)): ?>
                                <tr><td colspan="7" class="text-center text-muted py-4">No member records found.</td></tr>
                            <?php else: ?>
                                <?php foreach ($members as $memberRow): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($memberRow['member_code']) ?></td>
                                        <td><?= htmlspecialchars($memberRow['first_name'] . ' ' . $memberRow['last_name']) ?></td>
                                        <td><?= htmlspecialchars($memberRow['member_type']) ?></td>
                                        <td><?= htmlspecialchars($memberRow['contact_number']) ?></td>
                                        <td><span class="badge text-bg-light text-dark"><?= htmlspecialchars($memberRow['membership_status']) ?></span></td>
                                        <td><span class="badge <?= $memberRow['account_status'] === 'Active' ? 'text-bg-success' : 'text-bg-secondary' ?>"><?= htmlspecialchars($memberRow['account_status']) ?></span></td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="/AIMS-Cooperative-Management-System/members-management?action=view&id=<?= (int) $memberRow['member_id'] ?>" class="btn btn-outline-primary">View</a>
                                                <a href="/AIMS-Cooperative-Management-System/members-management?action=edit&id=<?= (int) $memberRow['member_id'] ?>" class="btn btn-outline-secondary">Edit</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
<?php endif; ?>

<?php
$pageContent = ob_get_clean();
include __DIR__ . '/../../layouts/staff.php';
