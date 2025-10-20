<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Receipt</title>
    <style>
        /* Fixed canvas width for wkhtmltoimage and printers */
        html, body {
            margin: 0;
            padding: 0;
            background: #fff; /* white background for thermal receipts */
            color: #000; /* enforce monochrome */
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Helvetica Neue", Arial, sans-serif;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        body {
            padding-top: 100px;
            padding-bottom: 100px;
        }

        .receipt {
            width: 640px;
            max-width: 640px;
            margin: 0 auto;
            padding: 24px;
            box-sizing: border-box;
            filter: grayscale(100%); /* ensure greyscale even if any color sneaks in */
        }

        .header {
            background-color: #000;
            color: white;
            text-align: center;
            margin-bottom: 20px;
        }

        .brand {
            font-weight: 900;
            font-size: 42px;
            letter-spacing: 2px;
            margin-bottom: 12px;
        }

        .meta {
            font-size: 30px;
            font-weight: bold;
        }

        .divider {
            border: 0;
            border-top: 3px dashed #000;
            margin: 20px 0;
            visibility: hidden;
        }

        .section-title {
            font-size: 35px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: .1em;
            color: #000;
            margin: 16px 0 8px;
        }

        .row {
            font-size: 30px;
            line-height: 1.6;
            margin-bottom: 16px;
        }

        .muted {
            color: #000;
            font-weight: 600;
        }

        .mono {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        }

        .footer {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #000;
            margin-top: 24px;
        }

        .wrap {
            font-weight: bold;
            white-space: pre-wrap;
            word-wrap: break-word;
        }
    </style>
</head>
<body style="width:640px; text-align:center; padding-right: 155px">
<div style="display:inline-block; text-align:left;">
    <div class="receipt">
        <div class="header">
            <div class="brand">TICKET</div>
            <div class="meta">
                {{-- Timestamp --}}
                {{ optional($receipt->created_at)->format('Y-m-d H:i') }}
            </div>
        </div>

        <div class="row">
            <div class="section-title">Title</div>
            <div class="wrap">{{ $receipt->title }}</div>
        </div>

        <div class="row">
            <div class="section-title">Description</div>
            <div class="wrap muted">{{ $receipt->description }}</div>
        </div>

        <div class="footer">
            Generated at {{ now()->format('Y-m-d H:i') }}
        </div>
    </div>
</div>
</body>
</html>
