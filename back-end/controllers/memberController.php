<?php
require_once __DIR__ . '/../modules/member.php';

$pageTitle = 'Member Management';
$pageName = 'members';
$membersUrl = '/AIMS-Cooperative-Management-System/members-management';

$flashMessage = $_SESSION['flash_message'] ?? '';
unset($_SESSION['flash_message']);

$search = isset($_GET['search']) && is_string($_GET['search']) ? trim($_GET['search']) : '';
$memberType = isset($_GET['member_type']) && is_string($_GET['member_type']) ? trim($_GET['member_type']) : '';
$membershipStatus = isset($_GET['membership_status']) && is_string($_GET['membership_status']) ? trim($_GET['membership_status']) : '';
$action = isset($_GET['action']) && is_string($_GET['action']) ? $_GET['action'] : 'list';
$memberId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?: 0;
$errors = [];
$submittedMember = null;
$member = [
    'member_type' => 'Worker',
    'first_name' => '',
    'middle_name' => '',
    'last_name' => '',
    'suffix' => '',
    'date_of_birth' => '',
    'sex' => '',
    'civil_status' => '',
    'contact_number' => '',
    'personal_email' => '',
    'address' => '',
    'employee_number' => '',
    'position_title' => '',
    'department_name' => '',
    'date_joined' => '',
    'membership_status' => 'Pending',
    'government_id_type' => '',
    'government_id_number' => '',
    'government_id_expiration' => '',
];

$redirectToMember = static function (int $id) use ($membersUrl): void {
    header('Location: ' . $membersUrl . '?action=view&id=' . $id);
    exit;
};

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $memberId = filter_input(INPUT_POST, 'member_id', FILTER_VALIDATE_INT) ?: 0;

    if ($action === 'create' && isset($_POST['save_member'])) {
        $submittedMember = aims_normalize_member_input($_POST);
        $member = $submittedMember;

        if ($conn === null) {
            $errors[] = 'The database is not available. Import the member schema before creating a member.';
        } else {
            $requiredFields = ['member_type', 'first_name', 'last_name', 'date_of_birth', 'sex', 'contact_number', 'personal_email', 'address'];
            foreach ($requiredFields as $field) {
                if ($submittedMember[$field] === '') {
                    $errors[] = 'Please complete all required member information.';
                    break;
                }
            }

            if (empty($errors)) {
                $submittedMember['company_email'] = aims_generate_company_email($conn, $submittedMember['first_name'], $submittedMember['last_name']);
                $createdMemberId = aims_create_member($conn, $submittedMember);

                if ($createdMemberId) {
                    $uploadErrors = [];
                    $documentTypes = ['Government ID', 'Birth Certificate', 'Employment Document', 'Supporting Document'];
                    foreach ($documentTypes as $documentType) {
                        if (!isset($_FILES[$documentType]) || $_FILES[$documentType]['error'] === UPLOAD_ERR_NO_FILE) {
                            continue;
                        }

                        $upload = aims_safe_upload_document($_FILES[$documentType], $createdMemberId);
                        if (!$upload['ok']) {
                            $uploadErrors[] = $upload['message'];
                            continue;
                        }

                        $documentId = aims_store_member_document($conn, $createdMemberId, $documentType, $upload['file_name'], $upload['stored_path'], $upload['mime_type']);
                        if ($documentId) {
                            $ocr = aims_process_ocr_document($upload['stored_path']);
                            if ($ocr['status'] === 'completed') {
                                aims_save_ocr_document($conn, $documentId, $ocr['text']);
                            }
                        } else {
                            $uploadErrors[] = $documentType . ' could not be attached to the member record.';
                        }
                    }

                    $_SESSION['flash_message'] = 'Member created successfully. The record is ready for review and account setup.';
                    if (!empty($uploadErrors)) {
                        $_SESSION['flash_message'] .= ' Document upload issues: ' . implode(' ', $uploadErrors);
                    }
                    $redirectToMember($createdMemberId);
                }

                $errors[] = 'Member could not be saved. Please review the form and try again.';
            }
        }
    }

    if ($action === 'edit' && isset($_POST['save_member'])) {
        $submittedMember = aims_normalize_member_input($_POST);
        $existingMember = $conn !== null && $memberId > 0 ? aims_get_member($conn, $memberId) : null;

        if (!$existingMember) {
            $errors[] = 'Member record could not be found.';
        } else {
            $requiredFields = ['member_type', 'first_name', 'last_name', 'date_of_birth', 'sex', 'contact_number', 'personal_email', 'address'];
            foreach ($requiredFields as $field) {
                if ($submittedMember[$field] === '') {
                    $errors[] = 'Please complete all required member information.';
                    break;
                }
            }

            $submittedMember['company_email'] = $existingMember['company_email'];
            if (empty($errors)) {
                if (aims_update_member($conn, $memberId, $submittedMember)) {
                    $_SESSION['flash_message'] = 'Member information updated successfully.';
                    $redirectToMember($memberId);
                }

                $errors[] = 'Member information could not be saved. Please try again.';
            }
        }
    }

    if ($conn !== null && isset($_POST['upload_document'])) {
        $documentType = isset($_POST['document_type']) && is_string($_POST['document_type'])
            ? trim($_POST['document_type'])
            : 'Supporting Document';

        if ($memberId > 0 && isset($_FILES['document_file']) && $_FILES['document_file']['error'] === UPLOAD_ERR_OK) {
            $upload = aims_safe_upload_document($_FILES['document_file'], $memberId);
            if ($upload['ok']) {
                $documentId = aims_store_member_document($conn, $memberId, $documentType, $upload['file_name'], $upload['stored_path'], $upload['mime_type']);
                if ($documentId) {
                    $ocr = aims_process_ocr_document($upload['stored_path']);
                    if ($ocr['status'] === 'completed') {
                        aims_save_ocr_document($conn, $documentId, $ocr['text']);
                    }
                    $_SESSION['flash_message'] = 'Document uploaded successfully.';
                } else {
                    $_SESSION['flash_message'] = 'The document could not be added to the member record.';
                }
            } else {
                $_SESSION['flash_message'] = $upload['message'];
            }
        } else {
            $_SESSION['flash_message'] = 'Choose a valid document to upload.';
        }

        $redirectToMember($memberId);
    }

    if ($conn !== null && isset($_POST['create_account'])) {
        $member = $memberId > 0 ? aims_get_member($conn, $memberId) : null;
        if ($member) {
            $companyEmail = aims_generate_company_email($conn, $member['first_name'], $member['last_name']);
            $temporaryPassword = aims_random_temp_password();
            $passwordHash = aims_hash_password($temporaryPassword);
            $accountId = aims_create_member_account($conn, $memberId, $companyEmail, $passwordHash);

            if ($accountId) {
                $result = aims_send_credentials_email($member, ['company_email' => $companyEmail], $temporaryPassword);
                $_SESSION['flash_message'] = 'Account created. ' . $result['message'];
            } else {
                $_SESSION['flash_message'] = 'The member account could not be created.';
            }
        } else {
            $_SESSION['flash_message'] = 'The member record could not be found.';
        }

        $redirectToMember($memberId);
    }

    if ($conn !== null && isset($_POST['toggle_account'])) {
        $member = $memberId > 0 ? aims_get_member($conn, $memberId) : null;
        if ($member) {
            $status = $member['account_status'] === 'Active' ? 'Inactive' : 'Active';
            if (aims_toggle_member_account($conn, $memberId, $status)) {
                $_SESSION['flash_message'] = 'Account status updated to ' . $status . '.';
            } else {
                $_SESSION['flash_message'] = 'The account status could not be updated.';
            }
        } else {
            $_SESSION['flash_message'] = 'The member record could not be found.';
        }

        $redirectToMember($memberId);
    }
}

$databaseAvailable = $conn !== null;
$members = $databaseAvailable && !in_array($action, ['view', 'edit', 'create'], true) ? aims_list_members($conn, $search, $memberType, $membershipStatus) : [];
$memberDetails = $memberId > 0 && $conn !== null ? aims_get_member($conn, $memberId) : null;
$documents = $memberId > 0 && $conn !== null ? aims_get_member_documents($conn, $memberId) : [];
$memberAccount = $memberId > 0 && $conn !== null ? aims_get_member_account($conn, $memberId) : null;

if ($action === 'create') {
    $pageTitle = 'Create Member';
    $member = $submittedMember ?? $member;
    require __DIR__ . '/../../front-end/pages/admin/create-member.php';
} elseif ($action === 'edit') {
    $pageTitle = 'Edit Member';
    $member = $submittedMember ?? $memberDetails;
    require __DIR__ . '/../../front-end/pages/admin/edit-member.php';
} elseif ($action === 'view') {
    $pageTitle = 'Member Information';
    require __DIR__ . '/../../front-end/pages/admin/member-information.php';
} else {
    require __DIR__ . '/../../front-end/pages/admin/members.php';
}