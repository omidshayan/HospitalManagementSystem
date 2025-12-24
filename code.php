<?php
if (!isset($_GET['file'])) {
    die("لطفا نام فایل PHP ورودی را با پارامتر file ارسال کنید. مثلا ?file=test.php");
}

$inputFile = $_GET['file'];

if (!file_exists($inputFile)) {
    die("فایل '{$inputFile}' وجود ندارد.");
}

$code = file_get_contents($inputFile);

function clean_code($code) {
    $code = preg_replace('/^\s*<\?php\s*/i', '', $code);
    $code = preg_replace('/\?>\s*$/i', '', $code);

    $code = preg_replace('!//.*!', '', $code);
    $code = preg_replace('!/\*.*?\*/!s', '', $code);
    $code = preg_replace('/^\s+|\s+$/m', '', $code);
    $code = preg_replace('/\s+/', ' ', $code);

    return trim($code);
}

function xor_encrypt($string, $key) {
    $out = '';
    for ($i = 0; $i < strlen($string); $i++) {
        $out .= $string[$i] ^ $key[$i % strlen($key)];
    }
    return $out;
}

function split_string($string, $length = 5) {
    return str_split($string, $length);
}

$cleaned_code = clean_code($code);

$key = 'mysecretkey';
$key_parts = str_split($key, 3);

$encrypted_code = xor_encrypt($cleaned_code, $key);

$encoded_code = base64_encode($encrypted_code);

$parts = split_string($encoded_code, 5);

$parts_array_code = "['" . implode("','", $parts) . "']";
$key_array_code = "['" . implode("','", $key_parts) . "']";

$base64_decode_parts = "['b','a','s','e','6','4','_','d','e','c','o','d','e']";

$final_code = <<<PHP
<?php
\$key = implode('', {$key_array_code});
\$parts = {$parts_array_code};
\$code = implode('', \$parts);
\$code = implode('', {$base64_decode_parts})(\$code);
\$out = '';
for (\$i = 0; \$i < strlen(\$code); \$i++) {
    \$out .= \$code[\$i] ^ \$key[\$i % strlen(\$key)];
}
eval(\$out);
?>
PHP;

$outputFile = 'output.php';
file_put_contents($outputFile, $final_code);

echo "کد فایل '{$inputFile}' با موفقیت obfuscate و در '{$outputFile}' ذخیره شد.";

// code.php?file=test.php