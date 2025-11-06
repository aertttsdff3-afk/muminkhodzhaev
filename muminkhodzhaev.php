<?php
// Файл: muminkhodzhaev.php
// Вставлен токен, который вы прислали. Будьте осторожны — не публикуйте токен!
// Простой webhook-бот: отвечает на /start и делает эхо для текста.

$TOKEN = '8413209427:AAGzULqEmX0-6Zth7jjgVUUlDyuIDPOV4sU'; // <- Ваш токен

$input = file_get_contents('php://input');
if (!$input) { echo 'ok'; exit; }

$update = json_decode($input, true);
if (!$update) { echo 'ok'; exit; }

function sendTelegram($method, $params) {
    global $TOKEN;
    $url = "https://api.telegram.org/bot{$TOKEN}/{$method}";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
    $res = curl_exec($ch);
    curl_close($ch);
    return $res;
}

if (isset($update['message'])) {
    $msg = $update['message'];
    $chat_id = $msg['chat']['id'];
    $text = $msg['text'] ?? '';

    if (strpos($text, '/start') === 0) {
        $reply = "Привет! Я бот. Пришли любое сообщение, и я отвечу эхо.";
        sendTelegram('sendMessage', ['chat_id' => $chat_id, 'text' => $reply]);
        echo 'ok'; exit;
    }

    $log_line = date('Y-m-d H:i:s') . " | chat_id: {$chat_id} | text: " . ($text ?: '[no text]') . PHP_EOL;
    @file_put_contents('messages.txt', $log_line, FILE_APPEND | LOCK_EX);

    $reply = "Ты написал: " . ($text ?: '[пустое сообщение]');
    sendTelegram('sendMessage', ['chat_id' => $chat_id, 'text' => $reply]);
    echo 'ok'; exit;
}

echo 'ok';
?>