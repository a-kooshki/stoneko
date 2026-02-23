<?php
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$rawBody = file_get_contents('php://input');
$input = json_decode($rawBody, true);

if (!is_array($input)) {
    $input = $_POST;
}

$name = trim($input['name'] ?? '');
$email = trim($input['email'] ?? '');
$phone = trim($input['phone'] ?? '');
$stoneType = trim($input['stone_type'] ?? '');
$message = trim($input['message'] ?? '');

if ($name === '' || $email === '' || $stoneType === '' || $message === '') {
    http_response_code(422);
    echo json_encode([
        'success' => false,
        'message' => 'لطفاً همه فیلدهای ضروری را کامل کنید.'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    echo json_encode([
        'success' => false,
        'message' => 'ایمیل وارد شده معتبر نیست.'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$to = 'info@ehsnestone.com';
$subject = 'New Contact Form Message - ehsnestone.com';

$body = "New message from website contact form:\n\n";
$body .= "Name: {$name}\n";
$body .= "Email: {$email}\n";
$body .= "Phone: {$phone}\n";
$body .= "Stone Type: {$stoneType}\n\n";
$body .= "Message:\n{$message}\n";

$cleanName = str_replace(["\r", "\n"], '', $name);
$cleanEmail = str_replace(["\r", "\n"], '', $email);

$headers = [];
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/plain; charset=UTF-8';
$headers[] = 'From: Ehsnestone Website <info@ehsnestone.com>';
$headers[] = "Reply-To: {$cleanName} <{$cleanEmail}>";
$headers[] = 'X-Mailer: PHP/' . phpversion();

$sent = mail($to, $subject, $body, implode("\r\n", $headers));

if (!$sent) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'ارسال ایمیل با خطا مواجه شد. لطفاً تنظیمات ایمیل هاست را بررسی کنید.'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

echo json_encode([
    'success' => true,
    'message' => 'پیام شما با موفقیت ارسال شد.'
], JSON_UNESCAPED_UNICODE);
