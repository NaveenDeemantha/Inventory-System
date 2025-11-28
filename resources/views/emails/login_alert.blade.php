@extends('emails.layout')

@section('content')
    <div style="text-align: center; margin-bottom: 24px;">
        <span class="alert-badge alert-info">Security Notification</span>
    </div>

    <p>Hello {{ $user->name }},</p>

    <p>A new login to your SmartProcure account was detected.</p>

    <table class="table">
        <tr>
            <th>Time</th>
            <td>{{ $time }}</td>
        </tr>
        <tr>
            <th>IP Address</th>
            <td>{{ $ipAddress }}</td>
        </tr>
    </table>

    <p>If this was you, you can safely ignore this email. If you did not log in, please contact the administrator immediately.</p>
@endsection
