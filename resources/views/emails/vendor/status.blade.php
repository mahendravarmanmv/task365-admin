<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Vendor Status</title>
</head>
<body>
    <p>Dear {{ $vendor->name }},</p>

    @if($status === 'approved')
        <p>Congratulations! Your vendor account has been <strong>approved</strong>.</p>
        <p>You can now access the dashboard and begin using the services.</p>
    @elseif($status === 'blocked')
        <p>Your vendor account has been <strong>temporarily blocked</strong>.</p>
        <p>Please contact admin if you believe this is a mistake.</p>
    @else
        <p>This is a status update regarding your vendor account.</p>
    @endif

    <p>Thank you,<br>
    TASK365 (a product of Lorhan Spot Earn Pvt Ltd)</p>

    <hr>
    <small style="font-size: 12px; color: #666;">
        <strong>Disclaimer:</strong><br>
        This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed.
        If you have received this email in error, please notify the sender immediately and delete it from your system.
        Any unauthorized review, use, disclosure, copying, distribution, or taking action based on its contents is strictly prohibited and may be unlawful.
        <br><br>
        TASK365 (a product of Lorhan Spot Earn Pvt Ltd) accepts no liability for the content of this email or for any damage caused by any virus or malware transmitted by this email.
        <br><br>
        All email communications are subject to monitoring by TASK365 in accordance with applicable laws.
        The views or opinions presented in this email do not necessarily represent those of the company unless explicitly stated.
        <br><br>
        For support or further information, please contact us at <a href="mailto:support@task365.in">support@task365.in</a> or visit 
        <a href="https://www.task365.in" target="_blank">www.task365.in</a>.
        <br><br>
        This communication and any dispute arising from it are subject to Indian laws and the jurisdiction of courts located in Hyderabad, Telangana, India.
    </small>
</body>
</html>
