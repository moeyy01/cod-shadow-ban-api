<?php

$cookie_string = getenv('cookie');


if (isset($_GET['apiisok'])) {
    $url = 'https://support.activision.com/api/bans/appeal?locale=zh-CN';
    
    $headers = array(
        'authority: support.activision.com',
        'accept: */*',
        'accept-language: zh-CN,zh;q=0.9,zh-TW;q=0.8,en;q=0.7',
        'cache-control: no-cache',
        "cookie: $cookie_string",
        'pragma: no-cache',
        'referer: https://support.activision.com/cn/zh/ban-appeal',
        'sec-ch-ua: "Chromium";v="116", "Not)A;Brand";v="24", "Google Chrome";v="116"',
        'sec-ch-ua-mobile: ?0',
        'sec-ch-ua-platform: "Windows"',
        'sec-fetch-dest: empty',
        'sec-fetch-mode: cors',
        'sec-fetch-site: same-origin',
        'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36',
        'x-requested-with: XMLHttpRequest'
    );
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    if ($httpCode == 200) {
        echo "接口运行正常";
    } else {
        http_response_code($httpCode);
        echo $response;
    }
    
    curl_close($ch);
} else if (isset($_GET['phpisok'])) {
    echo "PHP运行正常";
} else {
    $url = 'https://support.activision.com/api/bans/appeal?locale=zh-CN';

$headers = array(
    'authority: support.activision.com',
    'accept: */*',
    'accept-language: zh-CN,zh;q=0.9,zh-TW;q=0.8,en;q=0.7',
    'cache-control: no-cache',
    "cookie: $cookie_string",
    'pragma: no-cache',
    'referer: https://support.activision.com/cn/zh/ban-appeal',
    'sec-ch-ua: "Chromium";v="116", "Not)A;Brand";v="24", "Google Chrome";v="116"',
    'sec-ch-ua-mobile: ?0',
    'sec-ch-ua-platform: "Windows"',
    'sec-fetch-dest: empty',
    'sec-fetch-mode: cors',
    'sec-fetch-site: same-origin',
    'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36',
    'x-requested-with: XMLHttpRequest'
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

if ($httpCode == 200) {
    $jsonResponse = json_decode($response, true);
    if (!empty($jsonResponse['bans'])) {
        header('Content-Type: application/json');
        http_response_code(501);
        echo json_encode($jsonResponse['bans']);
    } else {
        header('Content-Type: text/html; charset=utf-8');
        echo '你的账号不在黑屋';
    }
} else {
    // 处理其他的 HTTP 状态码
    http_response_code($httpCode);
    echo $response;
}

curl_close($ch);
echo $response;
}
