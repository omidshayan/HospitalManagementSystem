<?php
/**
 * PHP STRONG OBFUSCATOR
 * Single File Encoder with UI
 * Safe for MVC / Namespace / Classes
 */

function encode_php($source)
{
    $key = random_bytes(32);

    // Compress
    $compressed = gzdeflate($source, 9);

    // XOR Encrypt
    $encrypted = '';
    for ($i = 0; $i < strlen($compressed); $i++) {
        $encrypted .= $compressed[$i] ^ $key[$i % strlen($key)];
    }

    // Encode layers
    $payload = base64_encode($encrypted);
    $keyEnc  = base64_encode($key);

    return build_loader($payload, $keyEnc);
}

function build_loader($payload, $key)
{
    return <<<PHP
<?php
/**
 * Protected PHP File
 * Runtime Decoding Only
 */

\$__p = '{$payload}';
\$__k = '{$key}';

\$__d = base64_decode(\$__p);
\$__key = base64_decode(\$__k);

\$__out = '';
for (\$__i = 0, \$__l = strlen(\$__d); \$__i < \$__l; \$__i++) {
    \$__out .= \$__d[\$__i] ^ \$__key[\$__i % strlen(\$__key)];
}

unset(\$__d, \$__k, \$__key);

/**
 * Execute decoded code
 * Keeps namespace, classes, MVC structure intact
 */
eval('?>' . gzinflate(\$__out));
PHP;
}

\$input  = \$_POST['source'] ?? '';
\$output = '';

if (!empty(\$input)) {
    \$output = encode_php(\$input);
}
?>
<!DOCTYPE html>
<html lang="fa">
<head>
<meta charset="UTF-8">
<title>PHP Strong Encoder</title>

<style>
* {
    box-sizing: border-box;
}
body {
    margin: 0;
    padding: 0;
    background: linear-gradient(135deg, #020617, #0f172a);
    font-family: Tahoma, sans-serif;
    color: #e5e7eb;
}
h1 {
    text-align: center;
    margin: 20px 0;
    font-size: 22px;
}
.container {
    display: flex;
    gap: 20px;
    padding: 20px;
    justify-content: center;
}
.editor {
    display: flex;
    flex-direction: column;
}
.editor label {
    margin-bottom: 6px;
    font-size: 13px;
    color: #94a3b8;
}
textarea {
    width: 500px;
    height: 700px;
    background: #020617;
    border: 1px solid #334155;
    color: #22c55e;
    padding: 12px;
    resize: vertical;
    font-family: Consolas, monospace;
    font-size: 13px;
    border-radius: 6px;
}
.actions {
    text-align: center;
    margin-bottom: 20px;
}
button {
    padding: 12px 40px;
    font-size: 14px;
    background: #2563eb;
    border: none;
    color: #fff;
    border-radius: 6px;
    cursor: pointer;
}
button:hover {
    background: #1d4ed8;
}
.footer {
    text-align: center;
    font-size: 12px;
    color: #64748b;
    padding-bottom: 10px;
}
</style>
</head>

<body>

<h1>PHP Strong Encoder – MVC Safe</h1>

<form method="post">
    <div class="container">
        <div class="editor">
            <label>کد PHP اصلی (MVC / Namespace / Class)</label>
            <textarea name="source" placeholder="<?php namespace App\\Controllers; ..."><?= htmlspecialchars(\$input) ?></textarea>
        </div>

        <div class="editor">
            <label>کد Encode شده (Protected)</label>
            <textarea readonly placeholder="خروجی اینجا ظاهر می‌شود..."><?= htmlspecialchars(\$output) ?></textarea>
        </div>
    </div>

    <div class="actions">
        <button type="submit">Encode</button>
    </div>
</form>

<div class="footer">
    Runtime Obfuscation • Offline • No External Dependency
</div>

</body>
</html>
