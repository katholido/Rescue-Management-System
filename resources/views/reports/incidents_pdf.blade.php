<!DOCTYPE html>
<html>
<head>
    <title>Incident Report</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { bg-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 30px; }
        .footer { position: fixed; bottom: 0; width: 100%; text-align: center; font-size: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>RESCUE SYSTEM</h1>
        <h2>INCIDENT INTEL REPORT</h2>
        <p>Generated on: {{ date('F d, Y H:i') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Location</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Reported At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($incidents as $incident)
                <tr>
                    <td>{{ $incident->id }}</td>
                    <td>{{ $incident->title }}</td>
                    <td>{{ $incident->location }}</td>
                    <td>{{ $incident->priority }}</td>
                    <td>{{ $incident->status }}</td>
                    <td>{{ $incident->reported_at ? $incident->reported_at->format('Y-m-d H:i') : 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Rescue Management System - Operational Report
    </div>
</body>
</html>
