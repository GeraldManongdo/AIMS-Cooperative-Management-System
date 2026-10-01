<?php ob_start(); ?>

<div class="mb-4">
    <nav aria-label="breadcrumb" class="mb-1">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/AIMS-Cooperative-Management-System/admin-dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="/AIMS-Cooperative-Management-System/members-management">Members</a></li>
            <li class="breadcrumb-item active">Register Member</li>
        </ol>
    </nav>

    <h4 class="fw-bold mb-1">Register New Member</h4>
    <p class="text-muted mb-0">Register a cooperative member and capture the information required for later CBU, loan, and project processing.</p>
</div>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form action="/AIMS-Cooperative-Management-System/create-member" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-semibold"><i class="bi bi-person me-2"></i>Personal Information</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-12 col-md-3">
                    <label class="form-label">Member Type <span class="text-danger">*</span></label>
                    <select name="member_type" class="form-select" required>
                        <option value="Worker" <?= $member['member_type'] === 'Worker' ? 'selected' : '' ?>>Worker</option>
                        <option value="Staff" <?= $member['member_type'] === 'Staff' ? 'selected' : '' ?>>Staff</option>
                    </select>
                </div>
                <div class="col-12 col-md-3">
                    <label class="form-label">First Name <span class="text-danger">*</span></label>
                    <input type="text" name="first_name" class="form-control" value="<?= htmlspecialchars($member['first_name']) ?>" required>
                </div>
                <div class="col-12 col-md-3">
                    <label class="form-label">Middle Name</label>
                    <input type="text" name="middle_name" class="form-control" value="<?= htmlspecialchars($member['middle_name']) ?>">
                </div>
                <div class="col-12 col-md-3">
                    <label class="form-label">Last Name <span class="text-danger">*</span></label>
                    <input type="text" name="last_name" class="form-control" value="<?= htmlspecialchars($member['last_name']) ?>" required>
                </div>
                <div class="col-12 col-md-2">
                    <label class="form-label">Suffix</label>
                    <input type="text" name="suffix" class="form-control" value="<?= htmlspecialchars($member['suffix']) ?>">
                </div>
                <div class="col-12 col-md-2">
                    <label class="form-label">Date of Birth <span class="text-danger">*</span></label>
                    <input type="date" name="date_of_birth" class="form-control" value="<?= htmlspecialchars($member['date_of_birth']) ?>" required>
                </div>
                <div class="col-12 col-md-2">
                    <label class="form-label">Sex <span class="text-danger">*</span></label>
                    <select name="sex" class="form-select" required>
                        <option value="" disabled <?= $member['sex'] === '' ? 'selected' : '' ?>>Select</option>
                        <option value="Male" <?= $member['sex'] === 'Male' ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= $member['sex'] === 'Female' ? 'selected' : '' ?>>Female</option>
                    </select>
                </div>
                <div class="col-12 col-md-3">
                    <label class="form-label">Civil Status</label>
                    <select name="civil_status" class="form-select">
                        <option value="">Select</option>
                        <option value="Single" <?= $member['civil_status'] === 'Single' ? 'selected' : '' ?>>Single</option>
                        <option value="Married" <?= $member['civil_status'] === 'Married' ? 'selected' : '' ?>>Married</option>
                        <option value="Widowed" <?= $member['civil_status'] === 'Widowed' ? 'selected' : '' ?>>Widowed</option>
                    </select>
                </div>
                <div class="col-12 col-md-3">
                    <label class="form-label">Contact Number <span class="text-danger">*</span></label>
                    <input type="tel" name="contact_number" class="form-control" value="<?= htmlspecialchars($member['contact_number']) ?>" required>
                </div>
                <div class="col-12 col-md-4">
                    <label class="form-label">Personal Email <span class="text-danger">*</span></label>
                    <input type="email" name="personal_email" class="form-control" value="<?= htmlspecialchars($member['personal_email']) ?>" required>
                </div>
                <div class="col-12">
                    <label class="form-label">Address <span class="text-danger">*</span></label>
                    <textarea name="address" class="form-control" rows="3" required><?= htmlspecialchars($member['address']) ?></textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-semibold"><i class="bi bi-briefcase me-2"></i>Employment / AMCOOP Information</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-12 col-md-3">
                    <label class="form-label">Employee / Worker Number</label>
                    <input type="text" name="employee_number" class="form-control" value="<?= htmlspecialchars($member['employee_number']) ?>">
                </div>
                <div class="col-12 col-md-3">
                    <label class="form-label">Position / Job Title</label>
                    <input type="text" name="position_title" class="form-control" value="<?= htmlspecialchars($member['position_title']) ?>">
                </div>
                <div class="col-12 col-md-3">
                    <label class="form-label">Department</label>
                    <input type="text" name="department_name" class="form-control" value="<?= htmlspecialchars($member['department_name']) ?>">
                </div>
                <div class="col-12 col-md-3">
                    <label class="form-label">Date Joined</label>
                    <input type="date" name="date_joined" class="form-control" value="<?= htmlspecialchars($member['date_joined']) ?>">
                </div>
                <div class="col-12 col-md-3">
                    <label class="form-label">Membership Status</label>
                    <select name="membership_status" class="form-select">
                        <option value="Pending" <?= $member['membership_status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="Active" <?= $member['membership_status'] === 'Active' ? 'selected' : '' ?>>Active</option>
                        <option value="Probationary" <?= $member['membership_status'] === 'Probationary' ? 'selected' : '' ?>>Probationary</option>
                        <option value="Inactive" <?= $member['membership_status'] === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 fw-semibold"><i class="bi bi-file-earmark-text me-2"></i>Government ID / Documents</h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-12 col-md-3">
                    <label class="form-label">ID Type</label>
                    <input type="text" name="government_id_type" class="form-control" value="<?= htmlspecialchars($member['government_id_type']) ?>">
                </div>
                <div class="col-12 col-md-3">
                    <label class="form-label">ID Number</label>
                    <input type="text" name="government_id_number" class="form-control" value="<?= htmlspecialchars($member['government_id_number']) ?>">
                </div>
                <div class="col-12 col-md-3">
                    <label class="form-label">Expiration Date</label>
                    <input type="date" name="government_id_expiration" class="form-control" value="<?= htmlspecialchars($member['government_id_expiration']) ?>">
                </div>
                <div class="col-12 col-md-3">
                    <label class="form-label">Government ID File</label>
                    <input type="file" name="Government ID" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                </div>
                <div class="col-12 col-md-3">
                    <label class="form-label">Birth Certificate</label>
                    <input type="file" name="Birth Certificate" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                </div>
                <div class="col-12 col-md-3">
                    <label class="form-label">Employment Document</label>
                    <input type="file" name="Employment Document" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                </div>
                <div class="col-12 col-md-3">
                    <label class="form-label">Supporting Document</label>
                    <input type="file" name="Supporting Document" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-end gap-2">
        <a href="/AIMS-Cooperative-Management-System/members-management" class="btn btn-outline-secondary">Cancel</a>
        <button type="submit" name="save_member" value="1" class="btn btn-primary"><i class="bi bi-person-plus me-1"></i>Create Member</button>
    </div>
</form>

<?php
$pageContent = ob_get_clean();
include __DIR__ . '/../../layouts/staff.php';
