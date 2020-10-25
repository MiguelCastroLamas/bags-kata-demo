<?php

require_once __DIR__ . '/../vendor/autoload.php';

$html = <<<EOT
<html>
<head>
    <title>Bags kata demo</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .center {
            margin: 0 auto;
            width: 50%;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="center">
        <p style="text-align: center;">
            Visit <a href="https://katalyst.codurance.com/bags" target="_blank"><i>Kata</i></a>
        </p>
    </div>
</body>
</html>
EOT;

echo $html;
