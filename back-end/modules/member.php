<?php

require_once __DIR__ . '/../config/connection.php';
require_once __DIR__ . '/../services/ocrService.php';

function aims_member_id_value(string $firstName, string $lastName): string
{
    $base = strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $firstName), 0, 3) ?: 'MEM');
    $surName = strtoupper(substr(preg_replace('/[^A-Za-z]/', '', $lastName), 0, 3) ?: 'BER');
    $suffix = str_pad((string) random_int(100, 999), 3, '0', STR_PAD_LEFT);

    return $base . $surName . '-' . $suffix;
}

function aims_generate_member_code(mysqli $conn): string
{
    do {
        $code = aims_member_id_value('Member', 'System');
        $stmt = $conn->prepare('SELECT member_id FROM members WHERE member_code = ? LIMIT 1');
        $stmt->bind_param('s', $code);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return $code;
        }
    } while (true);
}

function aims_generate_company_email(mysqli $conn, string $firstName, string $lastName): string
{
    $domain = aims_config('COMPANY_EMAIL_DOMAIN', 'example.com');
    $base = strtolower(trim($firstName . '.' . $lastName));
    $base = preg_replace('/[^a-z0-9.]/', '', $base);
    $base = preg_replace('/\.+/', '.', $base);
    $base = trim($base, '.');

    if ($base === '') {
        $base = 'member';
    }

    $email = $base . '@' . $domain;
    $candidate = $email;
    $counter = 2;

    while (true) {
        $stmt = $conn->prepare('SELECT account_id FROM accounts WHERE company_email = ? LIMIT 1');
        $stmt->bind_param('s', $candidate);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return $candidate;
        }

        $candidate = $base . $counter . '@' . $domain;
        $counter++;
    }
}

function aims_normalize_member_input(array $input): array
{
    return [
        'member_type' => trim($input['member_type'] ?? 'Worker'),
        'first_name' => trim($input['first_name'] ?? ''),
        'middle_name' => trim($input['middle_name'] ?? ''),
        'last_name' => trim($input['last_name'] ?? ''),
        'suffix' => trim($input['suffix'] ?? ''),
        'date_of_birth' => trim($input['date_of_birth'] ?? ''),
        'sex' => trim($input['sex'] ?? ''),
        'civil_status' => trim($input['civil_status'] ?? ''),
        'contact_number' => trim($input['contact_number'] ?? ''),
        'personal_email' => trim($input['personal_email'] ?? ''),
        'address' => trim($input['address'] ?? ''),
        'employee_number' => trim($input['employee_number'] ?? ''),
        'position_title' => trim($input['position_title'] ?? ''),
        'department_name' => trim($input['department_name'] ?? ''),
        'date_joined' => trim($input['date_joined'] ?? ''),
        'membership_status' => trim($input['membership_status'] ?? 'Active'),
        'government_id_type' => trim($input['government_id_type'] ?? ''),
        'government_id_number' => trim($input['government_id_number'] ?? ''),
        'government_id_expiration' => trim($input['government_id_expiration'] ?? ''),
        'company_email' => trim($input['company_email'] ?? ''),
    ];
}

function aims_member_record_exists(mysqli $conn, string $memberCode): bool
{
    $stmt = $conn->prepare('SELECT member_id FROM members WHERE member_code = ? LIMIT 1');
    $stmt->bind_param('s', $memberCode);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->num_rows > 0;
}

function aims_create_member(mysqli $conn, array $data): ?int
{
    $member = aims_normalize_member_input($data);
    $memberCode = aims_generate_member_code($conn);

    $stmt = $conn->prepare('INSERT INTO members (member_code, member_type, first_name, middle_name, last_name, suffix, date_of_birth, sex, civil_status, contact_number, personal_email, address, employee_number, position_title, department_name, date_joined, membership_status, government_id_type, government_id_number, government_id_expiration, company_email, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW())');

    $stmt->bind_param(
        'sssssssssssssssssssss',
        $memberCode,
        $member['member_type'],
        $member['first_name'],
        $member['middle_name'],
        $member['last_name'],
        $member['suffix'],
        $member['date_of_birth'],
        $member['sex'],
        $member['civil_status'],
        $member['contact_number'],
        $member['personal_email'],
        $member['address'],
        $member['employee_number'],
        $member['position_title'],
        $member['department_name'],
        $member['date_joined'],
        $member['membership_status'],
        $member['government_id_type'],
        $member['government_id_number'],
        $member['government_id_expiration'],
        $member['company_email']
    );

    if (!$stmt->execute()) {
        return null;
    }

    $memberId = $conn->insert_id;
    return $memberId;
}

function aims_update_member(mysqli $conn, int $memberId, array $data): bool
{
    $member = aims_normalize_member_input($data);

    $stmt = $conn->prepare('UPDATE members SET member_type = ?, first_name = ?, middle_name = ?, last_name = ?, suffix = ?, date_of_birth = ?, sex = ?, civil_status = ?, contact_number = ?, personal_email = ?, address = ?, employee_number = ?, position_title = ?, department_name = ?, date_joined = ?, membership_status = ?, government_id_type = ?, government_id_number = ?, government_id_expiration = ?, company_email = ?, updated_at = NOW() WHERE member_id = ?');

    $stmt->bind_param(
        'ssssssssssssssssssssi',
        $member['member_type'],
        $member['first_name'],
        $member['middle_name'],
        $member['last_name'],
        $member['suffix'],
        $member['date_of_birth'],
        $member['sex'],
        $member['civil_status'],
        $member['contact_number'],
        $member['personal_email'],
        $member['address'],
        $member['employee_number'],
        $member['position_title'],
        $member['department_name'],
        $member['date_joined'],
        $member['membership_status'],
        $member['government_id_type'],
        $member['government_id_number'],
        $member['government_id_expiration'],
        $member['company_email'],
        $memberId
    );

    return $stmt->execute();
}

function aims_get_member(mysqli $conn, int $memberId): ?array
{
    $stmt = $conn->prepare('SELECT * FROM members WHERE member_id = ? LIMIT 1');
    $stmt->bind_param('i', $memberId);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc() ?: null;
}

function aims_list_members(mysqli $conn, string $search = '', string $memberType = '', string $status = ''): array
{
    $sql = 'SELECT * FROM members WHERE 1=1';
    $params = [];
    $types = '';

    if ($search !== '') {
        $sql .= ' AND (first_name LIKE ? OR last_name LIKE ? OR member_code LIKE ? OR personal_email LIKE ? OR contact_number LIKE ?)';
        $likeSearch = '%' . $search . '%';
        $params[] = $likeSearch;
        $params[] = $likeSearch;
        $params[] = $likeSearch;
        $params[] = $likeSearch;
        $params[] = $likeSearch;
        $types .= 'sssss';
    }

    if ($memberType !== '') {
        $sql .= ' AND member_type = ?';
        $params[] = $memberType;
        $types .= 's';
    }

    if ($status !== '') {
        $sql .= ' AND membership_status = ?';
        $params[] = $status;
        $types .= 's';
    }

    $sql .= ' ORDER BY created_at DESC';

    $stmt = $conn->prepare($sql);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
}

function aims_store_member_document(mysqli $conn, int $memberId, string $documentType, string $fileName, string $storedPath, string $mimeType): ?int
{
    $stmt = $conn->prepare('INSERT INTO member_documents (member_id, document_type, file_name, file_path, mime_type, upload_date, ocr_status, verification_status) VALUES (?, ?, ?, ?, ?, NOW(), "Pending", "Unverified")');
    $stmt->bind_param('issss', $memberId, $documentType, $fileName, $storedPath, $mimeType);
    if (!$stmt->execute()) {
        return null;
    }

    return $conn->insert_id;
}

function aims_get_member_documents(mysqli $conn, int $memberId): array
{
    $stmt = $conn->prepare('SELECT * FROM member_documents WHERE member_id = ? ORDER BY upload_date DESC');
    $stmt->bind_param('i', $memberId);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
}

function aims_save_ocr_document(mysqli $conn, int $documentId, string $ocrText): bool
{
    $stmt = $conn->prepare('UPDATE member_documents SET ocr_status = "Completed", ocr_text = ?, verification_status = "Unverified" WHERE document_id = ?');
    $stmt->bind_param('si', $ocrText, $documentId);

    return $stmt->execute();
}

function aims_create_member_account(mysqli $conn, int $memberId, string $companyEmail, string $passwordHash): ?int
{
    $status = 'Pending';
    $stmt = $conn->prepare('INSERT INTO accounts (member_id, company_email, password_hash, account_status, created_at) VALUES (?, ?, ?, ?, NOW())');
    $stmt->bind_param('isss', $memberId, $companyEmail, $passwordHash, $status);
    if (!$stmt->execute()) {
        return null;
    }

    $stmt = $conn->prepare('UPDATE members SET account_status = "Pending", company_email = ?, updated_at = NOW() WHERE member_id = ?');
    $stmt->bind_param('si', $companyEmail, $memberId);
    $stmt->execute();

    return $conn->insert_id;
}

function aims_get_member_account(mysqli $conn, int $memberId): ?array
{
    $stmt = $conn->prepare('SELECT * FROM accounts WHERE member_id = ? LIMIT 1');
    $stmt->bind_param('i', $memberId);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc() ?: null;
}

function aims_toggle_member_account(mysqli $conn, int $memberId, string $accountStatus): bool
{
    $stmt = $conn->prepare('UPDATE accounts SET account_status = ? WHERE member_id = ?');
    $stmt->bind_param('si', $accountStatus, $memberId);
    return $stmt->execute();
}

function aims_safe_upload_document(array $file, int $memberId): array
{
    if (!isset($file['name']) || $file['error'] !== UPLOAD_ERR_OK) {
        return ['ok' => false, 'message' => 'No valid uploaded file was received.'];
    }

    $allowedMime = ['image/jpeg', 'image/png', 'application/pdf', 'image/jpg'];
    $maxSize = 5 * 1024 * 1024;

    if ($file['size'] > $maxSize) {
        return ['ok' => false, 'message' => 'The uploaded file exceeds the 5MB limit.'];
    }

    $mimeType = mime_content_type($file['tmp_name']) ?: $file['type'];
    if (!in_array($mimeType, $allowedMime, true)) {
        return ['ok' => false, 'message' => 'Only JPEG, PNG, and PDF files are allowed.'];
    }

    $safeName = preg_replace('/[^A-Za-z0-9._-]/', '_', $file['name']);
    $folder = __DIR__ . '/../../storage/members/' . $memberId;
    if (!is_dir($folder) && !mkdir($folder, 0775, true) && !is_dir($folder)) {
        return ['ok' => false, 'message' => 'The document storage directory could not be created.'];
    }

    $fileName = uniqid('doc_', true) . '_' . $safeName;
    $targetPath = $folder . '/' . $fileName;

    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        return ['ok' => false, 'message' => 'The file could not be saved to storage.'];
    }

    return ['ok' => true, 'file_name' => $fileName, 'stored_path' => $targetPath, 'mime_type' => $mimeType];
}

function aims_send_credentials_email(array $member, array $account, string $temporaryPassword): array
{
    $mailHost = aims_config('MAIL_HOST', '');
    $mailPort = (int) aims_config('MAIL_PORT', 587);
    $mailUsername = aims_config('MAIL_USERNAME', '');
    $mailPassword = aims_config('MAIL_PASSWORD', '');
    $mailEncryption = aims_config('MAIL_ENCRYPTION', 'tls');
    $mailFromAddress = aims_config('MAIL_FROM_ADDRESS', 'noreply@example.com');
    $mailFromName = aims_config('MAIL_FROM_NAME', 'AIMS AMCOOP');

    if ($mailHost === '' || $mailUsername === '') {
        return ['status' => 'not_configured', 'message' => 'PHPMailer is not configured. Set MAIL_HOST and MAIL_USERNAME before sending credentials.'];
    }

    if (!file_exists(__DIR__ . '/../../vendor/autoload.php')) {
        return ['status' => 'not_configured', 'message' => 'PHPMailer is not installed in the project dependencies.'];
    }

    require_once __DIR__ . '/../../vendor/autoload.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();
    $mail->Host = $mailHost;
    $mail->SMTPAuth = true;
    $mail->Username = $mailUsername;
    $mail->Password = $mailPassword;
    $mail->SMTPSecure = $mailEncryption;
    $mail->Port = $mailPort;
    $mail->setFrom($mailFromAddress, $mailFromName);
    $mail->addAddress($member['personal_email'], $member['first_name'] . ' ' . $member['last_name']);
    $mail->Subject = 'AIMS Account Credentials';

    $loginUrl = aims_config('APP_BASE_URL', 'http://localhost/Aims');
    $body = "Hello {$member['first_name']} {$member['last_name']},\n\n";
    $body .= "Your AIMS cooperative account has been created.\n\n";
    $body .= "System Email: {$account['company_email']}\n";
    $body .= "Temporary Password: {$temporaryPassword}\n";
    $body .= "Login URL: {$loginUrl}\n\n";
    $body .= "Please change this password after your first login.\n";
    $body .= "Keep this information secure and do not share it with others.\n";
    $mail->Body = $body;
    $mail->AltBody = strip_tags($body);

    if (!$mail->send()) {
        return ['status' => 'failed', 'message' => 'Failed to send credentials email: ' . $mail->ErrorInfo];
    }

    return ['status' => 'sent', 'message' => 'Credentials email sent successfully.'];
}

function aims_random_temp_password(): string
{
    $bytes = random_bytes(10);
    return strtoupper(substr(bin2hex($bytes), 0, 6)) . '!';
}

function aims_hash_password(string $password): string
{
    return password_hash($password, PASSWORD_DEFAULT);
}
