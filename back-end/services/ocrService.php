<?php

function aims_detect_id_type(string $ocrText): string
{
    $normalized = strtolower(trim($ocrText));

    if ($normalized === '') {
        return 'Unidentified';
    }

    $patterns = [
        'PhilHealth' => ['philhealth', 'phic'],
        'Driver\'s License' => ['driver\s*license', 'license'],
        'Passport' => ['passport'],
        'UMID' => ['umid'],
        'TIN' => ['tin', 'tax identification'],
        'SSS' => ['sss'],
        'Government ID' => ['government id', 'government'],
    ];

    foreach ($patterns as $label => $keywords) {
        foreach ($keywords as $keyword) {
            if (preg_match('/' . $keyword . '/i', $normalized)) {
                return $label;
            }
        }
    }

    return 'Unidentified';
}

function aims_extract_possible_id_number(string $ocrText): ?string
{
    $text = trim($ocrText);
    if ($text === '') {
        return null;
    }

    preg_match_all('/(?:[A-Z0-9][A-Z0-9\-\s]{8,}[A-Z0-9])/', strtoupper($text), $matches);
    $candidates = [];

    foreach ($matches[0] as $match) {
        $candidate = preg_replace('/\s+/', '', $match);
        $candidate = preg_replace('/[^A-Z0-9-]/', '', $candidate);

        if (strlen($candidate) >= 8) {
            $candidates[] = $candidate;
        }
    }

    if (!empty($candidates)) {
        return $candidates[0];
    }

    return null;
}

function aims_extract_possible_birth_date(string $ocrText): ?string
{
    $patterns = [
        '/\b(\d{4}-\d{2}-\d{2}|\d{2}-\d{2}-\d{4}|\d{2}\/\d{2}\/\d{4})\b/i',
        '/\b(\d{2}\s+[A-Z]{3,9}\s+\d{4})\b/i',
    ];

    foreach ($patterns as $pattern) {
        if (preg_match($pattern, $ocrText, $match)) {
            return $match[1];
        }
    }

    return null;
}

function aims_extract_possible_name(string $ocrText): ?string
{
    $lines = preg_split('/\r\n|\n|\r/', $ocrText);
    $candidate = null;

    foreach ($lines as $line) {
        $clean = trim($line);
        if (preg_match('/\b[A-Z][A-Z\s\.,\'-]{4,}/', $clean) && !preg_match('/^(ID|NUMBER|EXPIRY|VALID|DATE|ADDRESS)/i', $clean)) {
            $candidate = $clean;
            break;
        }
    }

    return $candidate ?: null;
}

function aims_process_ocr_document(string $filePath): array
{
    if (!is_file($filePath)) {
        return [
            'status' => 'failed',
            'message' => 'Document file was not found.',
            'text' => '',
            'fields' => [],
        ];
    }

    $ocrProvider = getenv('OCR_PROVIDER') ?: 'tesseract';
    $ocrEnabled = filter_var(getenv('OCR_ENABLED') ?: 'false', FILTER_VALIDATE_BOOLEAN);

    if (!$ocrEnabled) {
        return [
            'status' => 'not_configured',
            'message' => 'OCR is not configured for this environment. Set OCR_ENABLED=true and configure the provider.',
            'text' => '',
            'fields' => [],
        ];
    }

    $text = '';

    if ($ocrProvider === 'tesseract') {
        $tesseractBin = getenv('TESSERACT_BIN') ?: 'tesseract';
        $command = escapeshellarg($tesseractBin) . ' ' . escapeshellarg($filePath) . ' stdout 2>/dev/null';
        $text = shell_exec($command);
        $text = is_string($text) ? $text : '';
    } elseif ($ocrProvider === 'paperless') {
        $apiUrl = getenv('PAPERLESS_API_URL');
        if (empty($apiUrl)) {
            return [
                'status' => 'not_configured',
                'message' => 'Paperless API is not configured.',
                'text' => '',
                'fields' => [],
            ];
        }

        $curl = curl_init($apiUrl);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, ['file' => new CURLFile($filePath)]);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        $text = is_string($response) ? $response : '';
    }

    if ($text === '' || trim($text) === '') {
        return [
            'status' => 'failed',
            'message' => 'No OCR text was produced. Please review the uploaded document manually.',
            'text' => '',
            'fields' => [],
        ];
    }

    $fields = [
        'id_type' => aims_detect_id_type($text),
        'id_number' => aims_extract_possible_id_number($text),
        'date_of_birth' => aims_extract_possible_birth_date($text),
        'full_name' => aims_extract_possible_name($text),
    ];

    return [
        'status' => 'completed',
        'message' => 'OCR extraction completed successfully. Please verify the detected details.',
        'text' => $text,
        'fields' => $fields,
    ];
}
