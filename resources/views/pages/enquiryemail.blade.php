<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New Enquiry</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f4f6fb;
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            width: 100%;
            padding: 40px 0;
        }

        .card {
            width: 520px;
            margin: auto;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #0066cc, #004c99);
            padding: 25px;
            text-align: center;
            color: white;
        }

        .header h2 {
            margin: 0;
            font-weight: 500;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 14px;
            opacity: .9;
        }

        .content {
            padding: 30px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }

        .label {
            color: #666;
            font-size: 14px;
        }

        .value {
            color: #222;
            font-weight: 500;
        }

        .message-box {
            margin-top: 25px;
            padding: 18px;
            background: #f8f9fc;
            border-left: 4px solid #0066cc;
            border-radius: 6px;
        }

        .footer {
            text-align: center;
            padding: 18px;
            background: #fafafa;
            font-size: 12px;
            color: #999;
        }
    </style>
</head>

<body>

    <div class="container">

        <div class="card">

            <div class="header">
                <h2>SPLECA</h2>
                <p>New Customer Enquiry</p>
            </div>

            <div class="content">

                <table class="info-table">

                    <tr>
                        <td class="label">Name</td>
                        <td class="value">{{ $enquiry['name'] }}</td>
                    </tr>

                    <tr>
                        <td class="label">Email</td>
                        <td class="value">{{ $enquiry['email'] }}</td>
                    </tr>

                    <tr>
                        <td class="label">Phone</td>
                        <td class="value">{{ $enquiry['phone'] }}</td>
                    </tr>

                    @if($enquiry['product_id'])
                        <tr>
                            <td class="label">Product</td>
                            <td class="value">{{ $enquiry['product_id'] }}</td>
                        </tr>
                    @endif

                </table>

                <div class="message-box">
                    <strong>Customer Message</strong>
                    <p style="margin-top:8px;color:#555;font-size:14px;">
                        {{ $enquiry['message'] }}
                    </p>
                </div>

            </div>

            <div class="footer">
                © {{ date('Y') }} SPLECA • All Rights Reserved
            </div>

        </div>

    </div>

</body>

</html>