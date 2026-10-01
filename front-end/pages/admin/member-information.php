<?php ob_start(); ?>

<div class="mb-4">
	<nav aria-label="breadcrumb" class="mb-1">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="/AIMS-Cooperative-Management-System/admin-dashboard">Dashboard</a></li>
			<li class="breadcrumb-item"><a href="/AIMS-Cooperative-Management-System/members-management">Member Management</a></li>
			<li class="breadcrumb-item active">Member Information</li>
		</ol>
	</nav>
	<h4 class="fw-bold mb-1">Member Information</h4>
</div>

<?php if ($flashMessage !== ''): ?>
	<div class="alert alert-success"><?= htmlspecialchars($flashMessage) ?></div>
<?php endif; ?>

<?php if (!$databaseAvailable): ?>
	<div class="alert alert-warning">Database connection is not available. Import the SQL schema at <strong>back-end/config/member-management-schema.sql</strong> and configure the database connection settings.</div>
<?php elseif (!$memberDetails): ?>
	<div class="alert alert-warning">Member record not found.</div>
	<a href="/AIMS-Cooperative-Management-System/members-management" class="btn btn-outline-secondary">Back to Members</a>
<?php else: ?>
	<div class="card border-0 shadow-sm mb-4">
		<div class="card-header bg-white py-3">
			<div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
				<h5 class="mb-0 fw-semibold"><i class="bi bi-person-vcard me-2"></i><?= htmlspecialchars($memberDetails['first_name'] . ' ' . $memberDetails['last_name']) ?></h5>
				<div class="d-flex gap-2">
					<a href="/AIMS-Cooperative-Management-System/members-management?action=edit&id=<?= (int) $memberDetails['member_id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
					<a href="/AIMS-Cooperative-Management-System/members-management" class="btn btn-sm btn-outline-secondary">Back</a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="row g-4">
				<div class="col-12 col-lg-6">
					<h6 class="fw-semibold text-uppercase text-muted">Profile</h6>
					<dl class="row mb-0">
						<dt class="col-sm-4">Member ID</dt><dd class="col-sm-8"><?= htmlspecialchars($memberDetails['member_code']) ?></dd>
						<dt class="col-sm-4">Type</dt><dd class="col-sm-8"><?= htmlspecialchars($memberDetails['member_type']) ?></dd>
						<dt class="col-sm-4">Name</dt><dd class="col-sm-8"><?= htmlspecialchars($memberDetails['first_name'] . ' ' . ($memberDetails['middle_name'] ? $memberDetails['middle_name'] . ' ' : '') . $memberDetails['last_name']) ?></dd>
						<dt class="col-sm-4">DOB</dt><dd class="col-sm-8"><?= htmlspecialchars($memberDetails['date_of_birth']) ?></dd>
						<dt class="col-sm-4">Contact</dt><dd class="col-sm-8"><?= htmlspecialchars($memberDetails['contact_number']) ?></dd>
						<dt class="col-sm-4">Email</dt><dd class="col-sm-8"><?= htmlspecialchars($memberDetails['personal_email']) ?></dd>
						<dt class="col-sm-4">Address</dt><dd class="col-sm-8"><?= htmlspecialchars($memberDetails['address']) ?></dd>
					</dl>
				</div>
				<div class="col-12 col-lg-6">
					<h6 class="fw-semibold text-uppercase text-muted">AMCOOP Information</h6>
					<dl class="row mb-0">
						<dt class="col-sm-4">Employee No.</dt><dd class="col-sm-8"><?= htmlspecialchars($memberDetails['employee_number']) ?></dd>
						<dt class="col-sm-4">Position</dt><dd class="col-sm-8"><?= htmlspecialchars($memberDetails['position_title']) ?></dd>
						<dt class="col-sm-4">Department</dt><dd class="col-sm-8"><?= htmlspecialchars($memberDetails['department_name']) ?></dd>
						<dt class="col-sm-4">Date Joined</dt><dd class="col-sm-8"><?= htmlspecialchars($memberDetails['date_joined']) ?></dd>
						<dt class="col-sm-4">Membership</dt><dd class="col-sm-8"><?= htmlspecialchars($memberDetails['membership_status']) ?></dd>
						<dt class="col-sm-4">ID Type</dt><dd class="col-sm-8"><?= htmlspecialchars($memberDetails['government_id_type']) ?></dd>
						<dt class="col-sm-4">ID Number</dt><dd class="col-sm-8"><?= htmlspecialchars($memberDetails['government_id_number']) ?></dd>
					</dl>
				</div>
			</div>
		</div>
	</div>

	<div class="card border-0 shadow-sm mb-4">
		<div class="card-header bg-white py-3">
			<h5 class="mb-0 fw-semibold"><i class="bi bi-file-earmark-arrow-up me-2"></i>Documents</h5>
		</div>
		<div class="card-body">
			<form method="POST" enctype="multipart/form-data" class="row g-3">
				<input type="hidden" name="member_id" value="<?= (int) $memberDetails['member_id'] ?>">
				<div class="col-12 col-md-4">
					<label class="form-label">Document Type</label>
					<select name="document_type" class="form-select">
						<option>Government ID</option>
						<option>Birth Certificate</option>
						<option>Employment Document</option>
						<option>Supporting Document</option>
					</select>
				</div>
				<div class="col-12 col-md-5">
					<label class="form-label">File</label>
					<input type="file" name="document_file" class="form-control" accept=".jpg,.jpeg,.png,.pdf" required>
				</div>
				<div class="col-12 col-md-3 d-flex align-items-end">
					<button type="submit" name="upload_document" value="1" class="btn btn-primary w-100">Upload</button>
				</div>
			</form>
			<div class="table-responsive mt-4">
				<table class="table align-middle">
					<thead>
						<tr><th>Type</th><th>File</th><th>OCR Status</th><th>Verification</th></tr>
					</thead>
					<tbody>
						<?php if (empty($documents)): ?>
							<tr><td colspan="4" class="text-muted">No documents uploaded yet.</td></tr>
						<?php else: ?>
							<?php foreach ($documents as $document): ?>
								<tr>
									<td><?= htmlspecialchars($document['document_type']) ?></td>
									<td><a href="/AIMS-Cooperative-Management-System/<?= htmlspecialchars(str_replace('D:\\Gerald\\xampp\\htdocs\\AIMS-Cooperative-Management-System\\', '', $document['file_path'])) ?>" target="_blank" rel="noopener noreferrer"><?= htmlspecialchars($document['file_name']) ?></a></td>
									<td><?= htmlspecialchars($document['ocr_status']) ?></td>
									<td><?= htmlspecialchars($document['verification_status']) ?></td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<div class="card border-0 shadow-sm mb-4">
		<div class="card-header bg-white py-3">
			<h5 class="mb-0 fw-semibold"><i class="bi bi-person-lock me-2"></i>Account</h5>
		</div>
		<div class="card-body">
			<?php if ($memberAccount): ?>
				<dl class="row mb-0">
					<dt class="col-sm-3">Company Email</dt><dd class="col-sm-9"><?= htmlspecialchars($memberAccount['company_email']) ?></dd>
					<dt class="col-sm-3">Account Status</dt><dd class="col-sm-9"><?= htmlspecialchars($memberAccount['account_status']) ?></dd>
					<dt class="col-sm-3">Created</dt><dd class="col-sm-9"><?= htmlspecialchars($memberAccount['created_at']) ?></dd>
				</dl>
				<form method="POST" class="mt-3">
					<input type="hidden" name="member_id" value="<?= (int) $memberDetails['member_id'] ?>">
					<button type="submit" name="toggle_account" value="1" class="btn btn-outline-secondary">
						<?= $memberAccount['account_status'] === 'Active' ? 'Deactivate Account' : 'Activate Account' ?>
					</button>
				</form>
			<?php else: ?>
				<form method="POST">
					<input type="hidden" name="member_id" value="<?= (int) $memberDetails['member_id'] ?>">
					<button type="submit" name="create_account" value="1" class="btn btn-success"><i class="bi bi-envelope-check me-1"></i>Create Company Account</button>
				</form>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>

<?php
$pageContent = ob_get_clean();
include __DIR__ . '/../../layouts/staff.php';
