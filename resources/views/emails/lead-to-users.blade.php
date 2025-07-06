<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>New Lead Generated from Your Task365.in "Buy Now" Link</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <p>Dear {{ ucfirst($vendor_name ?? 'Vendor') }},</p>

	<p>We’re pleased to inform you that a new lead has been generated for your category on our website <a href="https://task365.in" target="_blank">Task365.in</a>.</p>

    <p>
        <strong>Buy Now:</strong> 
        @php
    $publicLeadUrl = 'https://task365.in/leads/' . $lead->id;
@endphp

<a href="{{ $publicLeadUrl }}" target="_blank">{{ $publicLeadUrl }}</a>
    </p>

    <p>This indicates that a user has shown interest in your service/product category and interacted with your link. Please feel free to follow up directly based on your internal process.</p>

    <p>For any support or queries, feel free to reach out to us.</p>

    <p>
        Best regards,<br>
        <strong>Team Task365</strong><br>
        +91-8790399660<br>
        <a href="mailto:support@task365.in">support@task365.in</a><br>
        <a href="https://www.task365.in" target="_blank">www.task365.in</a>
    </p>

    @include('emails.disclaimer')
</body>
</html>
