<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New Contact Submission</title>
</head>

<body style="margin:0; padding:0; background:#f4f6f8; font-family:system-ui, sans-serif;">

    <!-- Container -->
    <div
        style="max-width:600px; margin:40px auto; background:#ffffff; border-radius:12px; overflow:hidden; border:1px solid #e5e7eb;">

        <!-- Header -->
        <div style="background:#111827; padding:24px; color:#fff;">
            <h2 style="margin:0; font-size:20px;">New Contact Submission</h2>
            <p style="margin:6px 0 0; font-size:13px; color:#cbd5e1;">
                REDSOL Contact System Notification
            </p>
        </div>

        <!-- Body -->
        <div style="padding:24px; color:#111827;">

            <!-- Info Table -->
            <table style="width:100%; border-collapse:collapse; font-size:14px;">
                <tr>
                    <td style="padding:8px 0; font-weight:600; width:120px;">Name</td>
                    <td style="padding:8px 0;">{{ $name }}</td>
                </tr>

                <tr>
                    <td style="padding:8px 0; font-weight:600;">Email</td>
                    <td style="padding:8px 0;">{{ $email }}</td>
                </tr>

                @if(!empty($mailSubject))
                    <tr>
                        <td style="padding:8px 0; font-weight:600;">Subject</td>
                        <td style="padding:8px 0;">{{ $mailSubject }}</td>
                    </tr>
                @endif
            </table>

            <!-- Message Section -->
            <div style="margin-top:24px;">
                <h3 style="font-size:14px; margin-bottom:8px; color:#374151;">
                    Message
                </h3>
                <div
                    style="background:#f9fafb; border:1px solid #e5e7eb; padding:16px; border-radius:10px; white-space:pre-line; color:#111827;">
                    {{ $contentMessage }}
                </div>
            </div>

        </div>

        <!-- Footer -->
        <div
            style="padding:16px 24px; font-size:12px; color:#6b7280; background:#f9fafb; border-top:1px solid #e5e7eb;">
            Received via website contact form •
            {{ \Carbon\Carbon::now()->format('M j, Y g:i A') }}
        </div>

    </div>

</body>

</html>