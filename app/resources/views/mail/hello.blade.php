


<!DOCTYPE html>
<html>
<head>
    <title>Your Report</title>
</head>
<body>
    <p>Here is your report. Please find the attached PDF:</p>
    <a href="{{ $message->embed($pdfPath) }}" download>Download Report PDF</a>
</body>
</html>
