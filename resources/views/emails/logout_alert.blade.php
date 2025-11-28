@extends('emails.layout')

@section('content')
    <div style="text-align: center; margin-bottom: 24px;">
        <span class="alert-badge alert-info">Session Ended</span>
    </div>

    <p>Hello {{ $user->name }},</p>

    <p>You have successfully logged out of your SmartProcure account.</p>

    <table class="table">
        <tr>
            <th>Time</th>
            <td>{{ $time }}</td>
        </tr>
    </table>

    <div style="text-align: center;">
        <a href="{{ route('login') }}" class="button">Log In Again</a>
    </div>
@endsection
