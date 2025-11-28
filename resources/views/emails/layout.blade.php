<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} Notification</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            background-color: #f0f4f8; /* Light Blue-Gray */
            color: #334155; /* Slate-700 */
            line-height: 1.6;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            width: 100% !important;
        }
        .wrapper {
            width: 100%;
            background-color: #f0f4f8;
            padding: 40px 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
        .header {
            background-color: #0C2B4E; /* Brand Dark */
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            color: #ffffff;
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }
        .content {
            padding: 40px;
            background-color: #ffffff;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #64748b; /* Slate-500 */
            font-size: 12px;
            background-color: #f0f4f8;
        }
        .button {
            display: inline-block;
            background-color: #1D546C; /* Brand Primary */
            color: #ffffff !important;
            padding: 12px 28px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            margin-top: 20px;
            text-align: center;
        }
        .button:hover {
            background-color: #1A3D64; /* Brand Secondary */
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
            background-color: #fff7ed;
            color: #c2410c;
            border: 1px solid #ffedd5;
        }
        .alert-info {
            background-color: #eff6ff;
            color: #1e40af;
            border: 1px solid #dbeafe;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }
        .table th {
            background-color: #f8fafc;
            color: #475569;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
            padding: 12px;
            border-bottom: 2px solid #e2e8f0;
            text-align: left;
        }
        .table td {
            padding: 12px;
            border-bottom: 1px solid #e2e8f0;
            color: #334155;
        }
        /* Dark Mode Support for Email Clients */
        @media (prefers-color-scheme: dark) {
            body, .wrapper, .footer {
                background-color: #1e293b !important; /* Slate-800 */
            }
            .container, .content {
                background-color: #0f172a !important; /* Slate-900 */
                color: #e2e8f0 !important; /* Slate-200 */
            }
            .table th {
                background-color: #1e293b !important;
                color: #94a3b8 !important;
                border-bottom-color: #334155 !important;
            }
            .table td {
                color: #e2e8f0 !important;
                border-bottom-color: #334155 !important;
            }
            .header {
                background-color: #020617 !important; /* Slate-950 */
            }
        }
    </style>
</head>
<body>
    <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
        <tr>
            <td align="center">
                <table class="container" width="100%" cellpadding="0" cellspacing="0" role="presentation">
                    <!-- Header -->
                    <tr>
                        <td class="header">
                            <h1>SmartProcure</h1>
                        </td>
                    </tr>
                    
                    <!-- Content -->
                    <tr>
                        <td class="content">
                            @yield('content')
                        </td>
                    </tr>
                </table>
                
                <!-- Footer -->
                <div class="footer">
                    <p>&copy; {{ date('Y') }} SmartProcure Solutions. All rights reserved.</p>
                    <p>123 Business Ave, Tech City, TC 90210</p>
                </div>
            </td>
        </tr>
    </table>
</body>
</html>
