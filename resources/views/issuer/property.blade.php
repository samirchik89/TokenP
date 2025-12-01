@extends('issuer.layout.base')
@section('content')
    <!-- Start Page Content here -->
    <div class="content-page-inner">
        <!-- Header Banner Start -->
        <div class="header-breadcrumbs">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1>Property List</h1>
                    </div>
                    <div class="col-sm-6">
                        @include('issuer.layout.breadcrumb',['items' => [
                            [
                                'url' => 'issuer/dashboard',
                                'title' => 'Dashboard'
                            ],
                            [
                                'title' => 'Property'
                            ]
                        ]])
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Banner Start -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="content">
                        <!-- Start container-fluid -->
                        <div class="container-fluid wizard-border">
                            <!-- start  -->
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <div>
                                        <table id="example1" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>S.N0</th>
                                                    <th>Property Name</th>
                                                    <th>Property Image</th>
                                                    <th>Total Deal size</th>
                                                    <th>Contract Address</th>
                                                    <th>Action</th>
                                                    <th>Detail</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($properties as $key => $item)
                                                    <tr class="{{ $property_id == $item->id ? 'bg-success' : '' }}" style="pointer-events: none">
                                                        <td>{{ @$key + 1 }}
                                                        </td>
                                                        <td>{{ $item->propertyName . ', ' . $item->propertyLocation }}</td>
                                                        <td>
                                                            @if ($item->propertyLogo != '')
                                                                <a href="/storage/{{ $item->propertyLogo }}" target="_blank">
                                                                    <img src="/storage/{{ $item->propertyLogo }}" width="60px">
                                                                </a>
                                                            @endif
                                                        </td>
                                                        <td>{{ number_format($item->totalDealSize, 2) }}</td>


                                                        <td>
                                                            <a href="{{ $item->contract_link }}" target="_blank" style="position: relative; z-index: 10; pointer-events: auto;">
                                                                {{ $item->contract_address }}
                                                            </a>

                                                        </td>

                                                        <td style="pointer-events: all;">
                                                            @if ($item->status != 'block')
                                                                @if($isDemo)
                                                                    <a href="#"
                                                                        class="btn btn-primary disabled" style="pointer-events: none; opacity: 0.6;">Edit</a>
                                                                @else
                                                                    <a href="{{ route('token.edit', $item->id) }}"
                                                                        class="btn btn-primary">Edit</a>
                                                                @endif
                                                            @else
                                                                <div class="text-danger">Rejected by Admin</div>
                                                            @endif
                                                        </td>

                                                        <td style="pointer-events: all">
                                                            @if($isDemo)
                                                                <!-- Marketplace route with anchor tag -->
                                                                @if(request()->property_id == $item->id)
                                                                <div class="demo-pointer-container">
                                                                    <div class="demo-pointer-text">
                                                                        <i class="fas fa-hand-point-down"></i> Click here
                                                                    </div>
                                                                </div>
                                                                @endif

                                                                <a href="{{route('marketplace')}}#property{{$item->id}}"
                                                                    class="btn btn-secondary @if(request()->property_id == $item->id) demo-pointer @endif">View</a>
                                                            @else
                                                                <a href="/issuer/propertydetails/{{ $item->id }}"
                                                                    class="btn btn-primary">View</a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- end row -->
                        </div>
                        <!-- end container-fluid -->

                        <!-- Footer Start -->
                        <!-- <footer class="footer">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                        <ul class="social">
                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        </ul>
                                            <p>Copyright © 2021 {{ $project_name }}. All rights reserved.</p>
                                        </div>
                                    </div>
                                </div>
                            </footer> -->
                        <!-- end Footer -->
                    </div>
                    <!-- end content -->
                </div>
            </div>
        </div>
        <!-- Footer Start -->
        {{-- <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                    <div class="d-flex flex-wrap justify-content-between align-content-center">
                        <ul class="social">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                        </ul>
                        <p>Copyright © <script>document.write(new Date().getFullYear());</script> {{ $project_name }}. All rights reserved.</p>
                    </div>
                    </div>
                </div>
            </div>
        </footer> --}}
        <!-- end Footer -->
    </div>
    <!-- END content-page -->
@endsection

<style>
    /* Disabled link styles */
    .disabled-link {
        pointer-events: none !important;
        opacity: 0.5 !important;
        cursor: not-allowed !important;
    }

    /* Blinking animation for Property button */
    @keyframes blink {
        0% {
            box-shadow: 0 0 5px #28a745, 0 0 10px #28a745, 0 0 15px #28a745;
            transform: scale(1);
        }
        50% {
            box-shadow: 0 0 10px #28a745, 0 0 20px #28a745, 0 0 30px #28a745;
            transform: scale(1.05);
        }
        100% {
            box-shadow: 0 0 5px #28a745, 0 0 10px #28a745, 0 0 15px #28a745;
            transform: scale(1);
        }
    }

    /* Demo pointer animation */
    @keyframes demoPointer {
        0% {
            box-shadow: 0 0 5px #ff6b35, 0 0 10px #ff6b35, 0 0 15px #ff6b35;
            transform: scale(1);
            background-color: #ff6b35;
        }
        50% {
            box-shadow: 0 0 10px #ff6b35, 0 0 20px #ff6b35, 0 0 30px #ff6b35;
            transform: scale(1.1);
            background-color: #ff5722;
        }
        100% {
            box-shadow: 0 0 5px #ff6b35, 0 0 10px #ff6b35, 0 0 15px #ff6b35;
            transform: scale(1);
            background-color: #ff6b35;
        }
    }

    /* Up-down animation for pointer text */
    @keyframes upDownAnimation {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    .demo-pointer-container {
        position: relative;
        width: 100%;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        margin-bottom: 15px;
    }

    .demo-pointer-text {
        display: inline-block;
        background: linear-gradient(45deg, #ff6b35, #ff5722);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: bold;
        font-size: 14px;
        box-shadow: 0 4px 15px rgba(255, 107, 53, 0.4);
        animation: upDownAnimation 2s ease-in-out infinite;
        position: relative;
        z-index: 20;
        margin-left: 0;
        transform: translateX(8px);
    }

    .demo-pointer-text i {
        margin-right: 8px;
        font-size: 16px;
        animation: upDownAnimation 2s ease-in-out infinite;
    }

    .demo-pointer-text::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 50%;
        transform: translateX(-50%);
        width: 0;
        height: 0;
        border-left: 8px solid transparent;
        border-right: 8px solid transparent;
        border-top: 8px solid #ff6b35;
    }

    .property-btn {
        animation: blink 2s infinite;
        position: relative;
        z-index: 10;
    }

    .property-btn:hover {
        animation: none;
        box-shadow: 0 0 15px #28a745, 0 0 25px #28a745, 0 0 35px #28a745 !important;
        transform: scale(1.1) !important;
    }

    .demo-pointer {
        animation: demoPointer 1.5s infinite !important;
        background-color: #ff6b35 !important;
        border-color: #ff6b35 !important;
        color: white !important;
        font-weight: bold !important;
        cursor: pointer !important;
    }

    .demo-pointer:hover {
        animation: none !important;
        box-shadow: 0 0 20px #ff6b35, 0 0 30px #ff6b35, 0 0 40px #ff6b35 !important;
        transform: scale(1.15) !important;
        background-color: #ff5722 !important;
        border-color: #ff5722 !important;
    }
</style>