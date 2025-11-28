<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} Notification</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f3f4f6;
            color: #374151;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #4f46e5; /* Indigo-600 */
            padding: 24px;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }
        .content {
            background-color: #ffffff;
            padding: 32px;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .footer {
            text-align: center;
            margin-top: 24px;
            color: #6b7280;
            font-size: 14px;
        }
        .button {
            display: inline-block;
            background-color: #4f46e5;
            color: #ffffff;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            margin-top: 16px;
        }
        .alert-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        .alert-warning {
            background-color: #fef3c7;
            color: #92400e;
        }
        .alert-info {
            background-color: #dbeafe;
            color: #1e40af;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 16px;
        }
        .table th, .table td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }
        .table th {
            background-color: #f9fafb;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>SmartProcure</h1>
        </div>
        <div class="content">
            @yield('content')
        </div>
        <div class="footer">
            &copy; {{ date('Y') }} SmartProcure Solutions. All rights reserved.
        </div>
    </div>
</body>
</html>
