@extends('layout.app')

@section('content')
<style>
    .col-sm-6{
    margin-top: 24px;

    /* border: 1px solid black; */
    }

    @media screen and (min-width: 1200px) {
        .col-xl-3 {
            width: 25%;
        }
    }
    h2{
        margin-top: 23px;

    }
    .card-box.text-center.p-3.pull-up{
        border-bottom: 1px solid grey !important;
    border-right: 1px solid grey !important;
    border-left: 1px solid grey !important;
    }

    .col-xl-3 col-sm-6:hover{
        transform: translateY(-1.5rem);
 /* border: #f2295bf0 0.2em solid; */
 border-radius: 2.5rem 0 2.5rem 0;
    }

    .rb{
        margin: 20px;
    }


    .card-box {
        border: 1px solid #dee2e6; /* Light Bootstrap-like border */
        border-radius: 0.5rem; /* Optional: Rounded corners */
        background-color: #fff; /* Optional: Card background */
        margin: 5px;
    }
/* General Card Box Enhancements */
.card-box {
    border: 1px solid #dee2e6;
    border-radius: 0.5rem;
    background-color: #fff;
    margin: 5px;
    transition: box-shadow 0.3s ease;
}

/* Hover Lift Effect (Only on summary cards, not tables) */
.card-box:hover {
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
}

/* Section Header Styling */
.card-header {
    border-radius: 0.4rem;
    padding: 1rem;
    border: 1px solid transparent;
    background-color: #fff;
    margin-bottom: 0;
}

/* Waiting Approval Section */
.card-box.approval-box {
    background-color: #fef9e7;
    border-left: 4px solid #f39c12 !important;
}

/* Buy Requests Section */
.card-box.buy-box {
    background-color: #ebf3fd;
    border-left: 4px solid #3498db !important;
}

/* Section Flex */
.approval-header-flex {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.approval-header-left {
    display: flex;
    align-items: flex-start;
}

.icon-wrapper {
    margin-right: 1rem;
    width: 48px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.toggle-btn {
    background: transparent;
    border: none;
    color: inherit;
    cursor: pointer;
    font-size: 1.2rem;
    transition: transform 0.3s ease;
}

/* Default state: arrow up */
.toggle-btn i {
    transform: rotate(0deg);  /* Rotate down arrow to point up */
    transition: transform 0.3s ease;
}

/* Collapsed state: arrow down */
.toggle-btn[aria-expanded="false"] i {
    transform: rotate(180deg);  /* Normal down arrow */
}
/* Inner Item Styling */
.card-body > .mb-3 {
    border: 1px solid #f39c12;
    border-radius: 0.4rem;
    background-color: #ffffff;
    transition: box-shadow 0.2s ease;
}

.card-body > .mb-3:hover {
    box-shadow: 0 0 8px rgba(243, 156, 18, 0.2);
}

/* Table Header */
table thead tr {
    background-color: #f8f9fa;
    font-weight: 600;
}

/* Table Borders */
table td,
table th {
    border-top: 1px solid #dee2e6;
    padding: 12px;
    vertical-align: middle;
}

/* Badge Styling */
.badge {
    padding: 4px 10px;
    border-radius: 0.4rem;
    font-size: 0.75rem;
    font-weight: 500;
}

.approval-list {
    display: flex;
    flex-direction: column;
    gap: 1rem; /* space between cards */
}


.approval-card {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 12px;
        padding: 12px;
    }

    .approval-card-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }

    .approval-info-wrapper {
        display: flex;
        flex: 1;
        justify-content: space-between;
        gap: 20px;
    }

    .approval-info {
        flex: 1;
    }

    .label {
        margin: 0;
        font-size: 12px;
        color: #000000;
        font-weight: bold;
    }

    .value {
        margin: 2px 0 0;
        font-weight: 600;
    }

    .btn-delete {
        background-color: #3498db;
        color: white;
        border: none;
        padding: 6px 12px;
        font-size: 13px;
        border-radius: 4px;
        cursor: pointer;
        white-space: nowrap;
    }

    .btn-delete i {
        margin-right: 4px;
    }

.section-wrapper {
            border-left: 4px solid #3498db;
            background-color: #eaf3fe;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px;
            border-bottom: 1px solid #ccc;
        }

        .section-header h5 {
            margin: 0;
            font-weight: bold;
            color: #3498db;
        }

        .section-header p {
            margin: 0;
            font-size: 13px;
            color: #3498db;
        }

        .collapse-toggle {
            cursor: pointer;
            color: #3498db;
            font-size: 18px;
        }

        .card-body {
            padding: 16px;
        }

        .custom-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #eaf3fe;
        }

        .custom-table thead {
            background-color: #f8f9fa;
        }

        .custom-table th, .custom-table td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }

        .custom-table th {
            font-weight: bold;
        }

        .badge-processing {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
            padding: 4px 10px;
            border-radius: 5px;
            font-size: 12px;
        }

        .badge-pending {
            background-color: #6c757d;
            color: white;
            padding: 4px 10px;
            border-radius: 5px;
            font-size: 12px;
        }

        .action-icon {
            color: #007bff;
            text-decoration: none;
            font-size: 16px;
        }

        .action-icon:hover {
            text-decoration: underline;
        }

        .custom-table tr {
            height: 52px; /* Increase height for row spacing */
        }

        .custom-table tbody tr:not(:last-child) {
            border-bottom: 10px solid #eaf3fe; /* Adds visual spacing */
        }

        .custom-table td {
            vertical-align: middle;
        }


        .hidden {
            display: none;
        }

        .rotate-180 {
            transform: rotate(180deg);
            transition: transform 0.3s ease;
        }

        .rotate-0 {
            transform: rotate(0deg);
            transition: transform 0.3s ease;
        }
</style>
    <!-- START content-page -->
    <div class="content-page-inner">
          <div class="content">
              <div class="container-fluid wizard-border">
                    <div class="row m-0 ">
                        <div class="col-12 ">
                            <div>
                                <div class="widget-inline">
                                    <div class="row justify-content-center">

                                        <div class="col-xl-3 col-sm-6">
                                            <div class="card-box text-center p-3 pull-up" style="cursor: alias; border-top: 3px solid #5029f4 !important;">
                                                <h2 class="mt-2"><i class="fas fa-comment-dollar"></i><b><span class="count">${{ number_format(@$totalNetInvestment, 2, '.', '') }}</span></b></h2>
                                                <p class="text-muted mb-0">Assets Value</p>
                                                <p>(Total assets in custody)</p>
                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-sm-6">
                                            <div class="card-box text-center p-3 pull-up" style="cursor: alias; border-top: 3px solid gold !important;">
                                                <h2 class="mt-2"><i class="fas fa-address-book fa-co"></i><b><span class="count">${{ number_format(@$balance, 2, '.', '') }}</span></b></h2>
                                                <p class="text-muted mb-0">Wallet Balance</p>
                                                <p>(Current Balance of Wallet)</p>
                                            </div>
                                        </div>

                                        <div class="col-xl-3 col-sm-6">
                                            <div class="card-box text-center p-3 pull-up" style="cursor: alias; border-top: 3px solid #00c292 !important;">
                                                <h2 class="mt-2"><i class="fa fa-building fa-co"></i><b><span class="count">{{ $tokenCount }}</span></b></h2>
                                                <p class="text-muted mb-0">Total Shares</p>
                                                <p>(Total Shares in custody)</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(!$pendingApprovalRequests->isEmpty() || !$pendingBuyRequests->isEmpty() || !$notifications->isEmpty() && $notifications->count())
                        <div class="card-box border rounded p-3 mb-4 rb" style="background-color: #ffffff;">
                            <div class="card-header approval-section-header" style="background-color: #ffffff; margin: 1rem 1rem 0 1rem; gap: 5px;">
                                <div style="display: flex; align-items: center; gap: 10px;">
                                    <i class="fas fa-bell fa-lg text-dark fa-2x"></i>
                                    <h3 style="margin: 0; font-weight: bold;">Recent Alerts</h3>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row m-0 mb-4"><!-- div-parent -->
                                    @if(!$pendingApprovalRequests->isEmpty())
                                        <!-- div-c1: Existing Alert - Pending Buy Requests -->
                                        <div class="col-12 mb-3"><!-- div-c1 -->
                                            <div class="row m-0 mb-4">
                                                <div class="col-12">
                                                    <div class="card-box border rounded p-3" style="border-left: 4px solid #f39c12 !important; background-color: #fef9e7;">
                                                        <div class="card-header approval-section-header" style="background-color: #fef9e7;">
                                                            <div class="approval-header-flex d-flex justify-content-between align-items-center">
                                                                <div class="approval-header-left d-flex align-items-center gap-3">
                                                                    <div class="icon-wrapper">
                                                                        <i class="fas fa-exclamation-triangle fa-2x" style="color: #f39c12;"></i>
                                                                    </div>
                                                                    <div>
                                                                        <h5 class="mb-1 fw-bold" style="color: #d68910;">Waiting for approval request from issuers</h5>
                                                                        <p class="text-muted mb-0 small">You have {{ count($pendingApprovalRequests) }} request{{ count($pendingApprovalRequests) > 1 ? 's' : '' }} pending approval from issuers</p>
                                                                    </div>
                                                                </div>
                                                                <button class="toggle-btn" type="button" data-bs-toggle="collapse" data-bs-target="#pendingApprovalCollapse" aria-expanded="true" aria-controls="pendingApprovalCollapse">
                                                                    <i class="fas fa-chevron-down"></i>
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <div class="collapse " id="pendingApprovalCollapse">
                                                            <div class="card-body approval-list pt-3">
                                                                @foreach($pendingApprovalRequests as $request)
                                                                    <div class="approval-card">
                                                                        <div class="approval-card-content d-flex justify-content-between align-items-center">
                                                                            <div class="approval-info-wrapper d-flex gap-4">
                                                                                <div class="approval-info">
                                                                                    <p class="label">Asset</p>
                                                                                    <p class="value">{{ $request->property->propertyName }}</p>
                                                                                </div>
                                                                                <div class="approval-info">
                                                                                    <p class="label">Issuer</p>
                                                                                    <p class="value">{{ $request->property->getIssuerDetails()->name ?? '-' }}</p>
                                                                                </div>
                                                                            </div>
                                                                            <form method="GET" action="{{ url('/applyInvest/' . $request->property->id) }}">
                                                                                <button type="submit" class="btn-delete" title="View Property">
                                                                                    <i class="fas fa-eye"></i> View
                                                                                </button>
                                                                            </form>

                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    <!-- div-c2: Existing Alert - Waiting for Approval Requests -->
                                    @if(!$pendingBuyRequests->isEmpty())
                                        <div class="col-12 mb-3"><!-- div-c2 -->
                                            <div class="row m-0 mb-4">
                                                <div class="col-12">
                                                    <div class="card-box border rounded p-3" style="border-left: 4px solid #1034d6 !important; background-color: #eaf3fe;">
                                                        <div class="card-header approval-section-header" style="background-color: #eaf3fe;">
                                                            <div class="approval-header-flex d-flex justify-content-between align-items-center">
                                                                <div class="approval-header-left d-flex align-items-center gap-3">
                                                                    <div class="icon-wrapper">
                                                                        <i class="fas fa-file-alt fa-2x" style="color: #1034d6;"></i>
                                                                    </div>
                                                                    <div style="color: #1034d6;">
                                                                        <h5 class="mb-1 fw-bold">Pending Buy Requests</h5>
                                                                        <p class="mb-0 small">You have {{ count($pendingBuyRequests) }} incomplete buy request{{ count($pendingBuyRequests) > 1 ? 's' : '' }}</p>
                                                                    </div>
                                                                </div>
                                                                <button class="toggle-btn" type="button" data-bs-toggle="collapse" data-bs-target="#pendingBuyCollapse" aria-expanded="true" aria-controls="pendingBuyCollapse">
                                                                    <i class="fas fa-chevron-down"></i>
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <div class="collapse " id="pendingBuyCollapse">
                                                            <div class="card-body">
                                                                <table class="custom-table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Asset Name</th>
                                                                            <th>Tokens</th>
                                                                            <th>Amount ($)</th>
                                                                            <th>Status</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($pendingBuyRequests as $buyRequest)
                                                                            <tr>
                                                                                <td><strong>{{ $buyRequest->property->propertyName }}</strong></td>
                                                                                <td>{{ $buyRequest->token_acquire }}</td>
                                                                                <td>${{ number_format($buyRequest->deal_amount, 2) }}</td>
                                                                                <td>
                                                                                    @php
                                                                                        switch ($buyRequest->current_stage) {
                                                                                            case '1':
                                                                                                $stageLabel = 'Set Custody';
                                                                                                break;
                                                                                            case '2':
                                                                                                $stageLabel = 'Payment Not Done';
                                                                                                break;
                                                                                            default:
                                                                                                $stageLabel = 'Unknown';
                                                                                        }
                                                                                    @endphp
                                                                                    <span class="badge-pending">{{ $stageLabel }}</span>
                                                                                </td>

                                                                                <td>
                                                                                    <a href="{{ url('/applyInvest/' . $buyRequest->property->id) }}" class="action-icon" title="Complete the buy request">
                                                                                        <i class="fas fa-edit"></i>
                                                                                    </a>

                                                                                    <form method="POST"
                                                                                            action="{{ route('discardPurchaseRequest', ['user_id' => $buyRequest->user->id, 'id' => $buyRequest->usercontract->id]) }}"
                                                                                            style="display: inline;"
                                                                                            onsubmit="return confirm('Are you sure you want to delete this buy request?');">
                                                                                        @csrf

                                                                                        <input type="hidden" name="request_id" value="{{ $buyRequest->id }}">

                                                                                        <button type="submit"
                                                                                                class="action-icon"
                                                                                                style="background: none; border: none; padding: 0; margin-left: 10px; cursor: pointer;"
                                                                                                title="Delete request">
                                                                                            <i class="fas fa-trash-alt" style="color: #dc3545;"></i>
                                                                                        </button>
                                                                                    </form>


                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif

                                    @if(!$notifications->isEmpty() && $notifications->count())
                                        <div class="col-12" style="max-height: 550px; overflow-y: auto;"> <!-- shows approx 5 cards -->
                                            @foreach($notifications as $notification)
                                                @php
                                                    $alert = $notification->alert_class;
                                                @endphp

                                                <div class="card-box border rounded p-3 mb-3 notification-card"
                                                    style="border-left: 4px solid {{ $alert['color'] }} !important; background-color: #f9f9f9; position: relative;">

                                                    <div class="card-header approval-section-header" style="background-color: #f9f9f9;">
                                                        <div class="approval-header-flex d-flex justify-content-between align-items-center">
                                                            <div class="approval-header-left d-flex align-items-center gap-3">
                                                                <div class="icon-wrapper">
                                                                    @switch($notification->notification_type)
                                                                        @case('success')
                                                                            <i class="fas fa-check-circle fa-2x" style="color: #28a745;"></i>
                                                                            @break
                                                                        @case('warning')
                                                                            <i class="fas fa-exclamation-triangle fa-2x" style="color: #ffc107;"></i>
                                                                            @break
                                                                        @case('error')
                                                                        @case('danger')
                                                                            <i class="fas fa-times-circle fa-2x" style="color: #dc3545;"></i>
                                                                            @break
                                                                        @case('info')
                                                                            <i class="fas fa-info-circle fa-2x" style="color: #17a2b8;"></i>
                                                                            @break
                                                                        @default
                                                                            <i class="fas fa-bell fa-2x" style="color: #6c757d;"></i>
                                                                    @endswitch
                                                                </div>

                                                                <div>
                                                                    <h5 class="mb-1 fw-bold" style="color: {{ $alert['color'] }};">{{ $notification->title }}</h5>
                                                                    <p class="text-muted mb-0 small">{{ $notification->description }}</p>
                                                                </div>
                                                            </div>

                                                            <!-- Close Button -->
                                                            <button type="button"
                                                                onclick="this.closest('.notification-card').remove();"
                                                                class="btn btn-sm btn-light border-0"
                                                                style="position: absolute; top: 10px; right: 10px;"
                                                                aria-label="Close">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endif



                    <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12 mb-4">
                                <div class="card-box h-100 border rounded p-3">
                                    <div class="card-body p-4">

                                        <!-- Row: Icon on Left, Text on Right -->
                                        <div style="display: flex; align-items: flex-start; margin-bottom: 1rem;">
                                            <!-- Icon -->
                                            <div style="margin-right: 1rem; flex-shrink: 0; width: 48px; display: flex; justify-content: center;">
                                                <i class="fas fa-search-dollar fa-2x text-muted"></i>
                                            </div>

                                            <div style="flex: 1;">
                                                <h5 class="mb-1 fw-bold" style="color: #626773;">Investment Opportunities</h5>
                                                <p class="text-muted mb-0 small">View current offering / investment opportunities from issuers</p>
                                            </div>
                                        </div>

                                        <!-- Buttons -->
                                        <div style="display: flex; gap: 0.5rem;">
                                            <a href="{{ url('/propertyList') }}" class="btn btn-primary btn-sm flex-fill">
                                                VIew
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12 mb-4">
                                <div class="card-box h-100 border rounded p-3">
                                    <div class="card-body p-4">

                                        <!-- Row: Icon on Left, Text on Right -->
                                        <div style="display: flex; align-items: flex-start; margin-bottom: 1rem;">
                                            <!-- Icon -->
                                            <div style="margin-right: 1rem; flex-shrink: 0; width: 48px; display: flex; justify-content: center;">
                                                <i class="fas fa-wallet fa-2x text-muted"></i>
                                            </div>

                                            <div style="flex: 1;">
                                                <h5 class="mb-1 fw-bold" style="color: #626773;">Fiat Wallet Management</h5>
                                                <p class="text-muted mb-0 small">Manage your fiat wallet with platform admin </p>
                                            </div>
                                        </div>

                                        <!-- Buttons -->
                                        <div style="display: flex; gap: 0.5rem;">
                                            <a href="{{ url('/wallet') }}" class="btn btn-primary btn-sm flex-fill">
                                                Deposit
                                            </a>

                                            <a href="{{ url('/withdrawETH') }}" class="btn btn-outline-primary btn-sm flex-fill">
                                                Withdraw
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12 mb-4">
                                <div class="card-box h-100 border rounded p-3">
                                    <div class="card-body p-4">

                                        <!-- Row: Icon on Left, Text on Right -->
                                        <div style="display: flex; align-items: flex-start; margin-bottom: 1rem;">
                                            <!-- Icon -->
                                            <div style="margin-right: 1rem; flex-shrink: 0; width: 48px; display: flex; justify-content: center;">
                                                <i class="fas fa-user-cog fa-2x text-muted"></i>
                                            </div>

                                            <div style="flex: 1;">
                                                <h5 class="mb-1 fw-bold" style="color: #626773;">Manage Profile</h5>
                                                <p class="text-muted mb-0 small">Manage your profile details </p>
                                            </div>
                                        </div>

                                        <!-- Buttons -->
                                        <div style="display: flex; gap: 0.5rem;">
                                            <a href="{{ url('/profile') }}" class="btn btn-primary btn-sm flex-fill">
                                                Manage
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12 mb-4">
                                <div class="card-box h-100 border rounded p-3">
                                    <div class="card-body p-4">

                                        <!-- Row: Icon on Left, Text on Right -->
                                        <div style="display: flex; align-items: flex-start; margin-bottom: 1rem;">
                                            <!-- Icon -->
                                            <div style="margin-right: 1rem; flex-shrink: 0; width: 48px; display: flex; justify-content: center;">
                                                <i class="fas fa-briefcase fa-2x text-muted"></i>
                                            </div>

                                            <div style="flex: 1;">
                                                <h5 class="mb-1 fw-bold" style="color: #626773;">Investments</h5>
                                                <p class="text-muted mb-0 small">View your current investments </p>
                                            </div>
                                        </div>

                                        <!-- Buttons -->
                                        <div style="display: flex; gap: 0.5rem;">
                                            <a href="{{ url('/investment') }}" class="btn btn-primary btn-sm flex-fill">
                                                View
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-12 mb-4">
                                <div class="card-box h-100 border rounded p-3">
                                    <div class="card-body p-4">

                                        <!-- Row: Icon on Left, Text on Right -->
                                        <div style="display: flex; align-items: flex-start; margin-bottom: 1rem;">
                                            <!-- Icon -->
                                            <div style="margin-right: 1rem; flex-shrink: 0; width: 48px; display: flex; justify-content: center;">
                                                <i class="fas fa-shield-alt fa-2x text-muted"></i>
                                            </div>

                                            <div style="flex: 1;">
                                                <h5 class="mb-1 fw-bold" style="color: #626773;">Manage dashboard security</h5>
                                                <p class="text-muted mb-0 small">Manage Login Credentials and 2FA settings </p>
                                            </div>
                                        </div>

                                        <!-- Buttons -->
                                        <div style="display: flex; gap: 0.5rem;">
                                            <a href="{{ url('/security') }}" class="btn btn-primary btn-sm flex-fill">
                                                Manage
                                            </a>
                                        </div>

                                    </div>
                                </div>
                            </div>


                    </div>

                    @php
                        $userdata= $tokenCount;
                    @endphp
            </div>
        </div>
    </div>
      <!-- END content-page -->
@endsection
{{-- <scriptsrc="asset('adminTemplate/js/highchart/highcharts.js')"></script> --}}
{{-- <script src="{{ asset('adminTemplate/js/highchart/data.js') }}"></script>
<script src="{{ asset('adminTemplate/js/highchart/exporting.js') }}"></script>
<script src="{{ asset('adminTemplate/js/highchart/export-data.js') }}"></script>
<script src="{{ asset('adminTemplate/js/highchart/accessibility.js') }}"></script>
<script src="{{ asset('adminTemplate/js/highchart/graph.js') }}"></script>
<script src="{{ asset('adminTemplate/js/jquery.dataTables.min.js') }}"></script> --}}
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> --}}
{{-- <script src="{{asset('assets_m/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('assets_m/js/scripts.bundle.js')}}"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Vendors Javascript(used by this page)-->
		<script src="{{asset('assets_m/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
		<script src="{{asset('assets_m/plugins/custom/datatables/datatables.bundle.js')}}"></script>
		<!--end::Page Vendors Javascript-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="{{asset('assets_m/js/widgets.bundle.js')}}"></script>
		<script src="{{asset('assets_m/js/custom/widgets.js')}}"></script>
		<script src="{{asset('assets_m/js/custom/apps/chat/chat.js')}}"></script>
		<script src="{{asset('assets_m/js/custom/intro.js')}}"></script>
		<script src="{{asset('assets_m/js/custom/utilities/modals/users-search.js')}}"></script> --}}
<script>
    var userdata= "{{ $userdata }}";
    // alert(JSON.parse(userdata))

    // var KTChartsWidget4 = function () {
    //     // Private methods
    //     var initChart = function() {
    //         var element = document.getElementById("kt_charts_widget_4");

    //         if (!element) {
    //             return;
    //         }

    //         // alert(values)


    //         // console.log(userdata);
    //         var height = parseInt(KTUtil.css(element, 'height'));
    //         var labelColor = KTUtil.getCssVariableValue('--bs-gray-500');
    //         var borderColor = KTUtil.getCssVariableValue('--bs-border-dashed-color');
    //         var baseColor = KTUtil.getCssVariableValue('--bs-primary');
    //         var lightColor = KTUtil.getCssVariableValue('--bs-primary');

    //         var options = {
    //             series: [{
    //                 name: 'Total amount of Shares',
    //                 data:  JSON.parse(userdata)
    //                     }],
    //             chart: {
    //                 fontFamily: 'inherit',
    //                 type: 'area',
    //                 height: height,
    //                 toolbar: {
    //                     show: false
    //                 }
    //             },
    //             plotOptions: {

    //             },
    //             legend: {
    //                 show: false
    //             },
    //             dataLabels: {
    //                 enabled: false
    //             },
    //             fill: {
    //                 type: "gradient",
    //                 gradient: {
    //                     shadeIntensity: 1,
    //                     opacityFrom: 0.4,
    //                     opacityTo: 0,
    //                     stops: [0, 80, 100]
    //                 }
    //             },
    //             stroke: {
    //                 curve: 'smooth',
    //                 show: true,
    //                 width: 3,
    //                 colors: [baseColor]
    //             },
    //             xaxis: {
    //                 categories: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC',''],
    //                 axisBorder: {
    //                     show: false,
    //                 },
    //                 axisTicks: {
    //                     show: false
    //                 },
    //                 tickAmount: 6,
    //                 labels: {
    //                     rotate: 0,
    //                     rotateAlways: true,
    //                     style: {
    //                         colors: labelColor,
    //                         fontSize: '12px'
    //                     }
    //                 },
    //                 crosshairs: {
    //                     position: 'front',
    //                     stroke: {
    //                         color: baseColor,
    //                         width: 1,
    //                         dashArray: 3
    //                     }
    //                 },
    //                 tooltip: {
    //                     enabled: true,
    //                     formatter: undefined,
    //                     offsetY: 0,
    //                     style: {
    //                         fontSize: '12px'
    //                     }
    //                 }
    //             },

    //             states: {
    //                 normal: {
    //                     filter: {
    //                         type: 'none',
    //                         value: 0
    //                     }
    //                 },
    //                 hover: {
    //                     filter: {
    //                         type: 'none',
    //                         value: 0
    //                     }
    //                 },
    //                 active: {
    //                     allowMultipleDataPointsSelection: false,
    //                     filter: {
    //                         type: 'none',
    //                         value: 0
    //                     }
    //                 }
    //             },
    //             tooltip: {
    //                 style: {
    //                     fontSize: '12px'
    //                 },
    //                 y: {
    //                     formatter: function (val) {
    //                         return  parseInt(val)
    //                     }
    //                 }
    //             },
    //             colors: [lightColor],
    //             grid: {
    //                 borderColor: borderColor,
    //                 strokeDashArray: 4,
    //                 yaxis: {
    //                     lines: {
    //                         show: true
    //                     }
    //                 }
    //             },
    //             markers: {
    //                 strokeColor: baseColor,
    //                 strokeWidth: 3
    //             }
    //         };

    //         // var chart = new ApexCharts(element, options);

    //         // Set timeout to properly get the parent elements width
    //         setTimeout(function() {
    //             chart.render();
    //         }, 200);
    //     }


    //     // Public methods
    //     return {
    //         init: function () {
    //             // initChart();
    //         }
    //     }
    // }();

    // const toggleBtn = document.getElementById('approvalToggleBtn');
    // const collapseSection = document.getElementById('approvalRequestsCollapse');

    // toggleBtn.addEventListener('click', () => {
    //     const isExpanded = toggleBtn.getAttribute('aria-expanded') === 'true';

    //     // Toggle aria-expanded
    //     toggleBtn.setAttribute('aria-expanded', !isExpanded);

    //     // Toggle collapse visibility
    //     collapseSection.classList.toggle('hidden');
    // });



</script>

