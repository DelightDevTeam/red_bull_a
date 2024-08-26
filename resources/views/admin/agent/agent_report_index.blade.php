<!DOCTYPE html>
<html>
<head>
    <title>Agent Monthly Report</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .summary {
            background-color: #ffffe0;
            font-weight: bold;
        }
        .qty {
            text-align: left;
        }
        .win {
            color: green;
        }
        .lose {
            color: red;
        }
    </style>
</head>
<body>
    <h1>@lang('public.agent_monthly_report')</h1>

    <table>
        <thead>
            <tr>
                <th rowspan="2">@lang('public.month')</th>
                <th rowspan="2">@lang('public.account')</th>
                <th rowspan="2">@lang('public.name')</th>
                <th rowspan="2">@lang('public.bet_amount')</th>
                <th rowspan="2">@lang('public.valid_amount')</th>
                <th rowspan="2">@lang('public.stake_count')</th>
                <th rowspan="2">@lang('public.gross_commission')</th>
                <th colspan="3">@lang('public.member')</th>
                <th colspan="3">@lang('public.downline')</th>
                <th colspan="3">@lang('public.myself')</th>
                <th colspan="3">@lang('public.upline')</th>
                <th colspan="3">@lang('public.detail')</th>
            </tr>
            <tr>
                <th>@lang('public.win_lose')</th>
                <th>@lang('public.commission')</th>
                <th>@lang('public.total')</th>
                <th>@lang('public.win_lose')</th>
                <th>@lang('public.commission')</th>
                <th>@lang('public.total')</th>
                <th>@lang('public.win_lose')</th>
                <th>@lang('public.commission')</th>
                <th>@lang('public.total')</th>
                <th>@lang('public.win_lose')</th>
                <th>@lang('public.commission')</th>
                <th>@lang('public.total')</th>
            </tr>
        </thead>
        <tbody>
            @foreach($agentReports as $report)
                <tr>
                    <td class="qty">{{ $report->report_month_year }}</td>
                    <td class="qty">Qty: {{ $report->qty }}</td>
                    <td>{{ $report->agent_name }}</td>
                    <td>{{ number_format($report->total_bet_amount, 2) }}</td>
                    <td>{{ number_format($report->total_valid_bet_amount, 2) }}</td>
                    <td>{{ $report->stake_count }}</td> <!-- Placeholder for stake count -->
                    <td>{{ number_format($report->total_commission_amount, 2) }}</td>

                    <!-- Win/Loss for Member -->
                    <td class="{{ $report->win_or_lose < 0 ? 'lose' : 'win' }}">
                        {{ number_format($report->win_or_lose, 2) }}
                    </td>
                    <td>0</td> <!-- Member Comm -->
                    <td>{{ number_format($report->win_or_lose + $report->total_commission_amount, 2) }}</td> <!-- Member Total -->

                    <td>--</td> <!-- Downline W/L Placeholder -->
                    <td>0</td> <!-- Downline Comm Placeholder -->
                    <td>--</td> <!-- Downline Total Placeholder -->

                    <!-- Win/Loss for Myself -->
                    <td class="{{ $report->win_or_lose < 0 ? 'lose' : 'win' }}">
                        {{ number_format($report->win_or_lose, 2) }}
                    </td>
                    <td>0</td> <!-- Myself Comm -->
                    <td>{{ number_format($report->win_or_lose + $report->total_commission_amount, 2) }}</td> <!-- Myself Total -->

                    <!-- Win/Loss for Upline -->
                    <td class="{{ $report->win_or_lose < 0 ? 'lose' : 'win' }}">
                        {{ number_format($report->win_or_lose, 2) }}
                    </td>
                    <td>0</td> <!-- Upline Comm -->
                    <td>{{ number_format($report->win_or_lose + $report->total_commission_amount, 2) }}</td> <!-- Upline Total -->
                    <td>
                    <a href="{{ route('admin.agent_winLdetails', ['agent_id' => $report->agent_id, 'month' => $report->report_month_year]) }}" class="btn btn-info">
                        View Detail
                    </a>
                    </td>
                </tr>
            @endforeach
            <tr class="summary">
                <td colspan="2">Summary:</td>
                <td>{{ number_format($agentReports->sum('total_bet_amount'), 2) }}</td>
                <td>{{ number_format($agentReports->sum('total_valid_bet_amount'), 2) }}</td>
                <td>--</td>
                <td>{{ number_format($agentReports->sum('total_commission_amount'), 2) }}</td>

                <!-- Summary Win/Loss -->
                <td class="{{ $agentReports->sum('win_or_lose') < 0 ? 'lose' : 'win' }}">
                    {{ number_format($agentReports->sum('win_or_lose'), 2) }}
                </td>
                <td>0</td>
                <td>{{ number_format($agentReports->sum('win_or_lose') + $agentReports->sum('total_commission_amount'), 2) }}</td>

                <td>--</td>
                <td>0</td>
                <td>--</td>

                <!-- Summary Myself Win/Loss -->
                <td class="{{ $agentReports->sum('win_or_lose') < 0 ? 'lose' : 'win' }}">
                    {{ number_format($agentReports->sum('win_or_lose'), 2) }}
                </td>
                <td>0</td>
                <td>{{ number_format($agentReports->sum('win_or_lose') + $agentReports->sum('total_commission_amount'), 2) }}</td>

                <!-- Summary Upline Win/Loss -->
                <td class="{{ $agentReports->sum('win_or_lose') < 0 ? 'lose' : 'win' }}">
                    {{ number_format($agentReports->sum('win_or_lose'), 2) }}
                </td>
                <td>0</td>
                <td>{{ number_format($agentReports->sum('win_or_lose') + $agentReports->sum('total_commission_amount'), 2) }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
