@php
    $statusColors = [
        'inProgress' => 'orange',
        'inReview'   => 'blue',
        'success'    => 'green',
        'reject'     => 'red',
        'failed'     => 'red',

    ];
@endphp

@extends('issuer.layout.base')

@section('content')
<style>
    .modal-content {
        animation: fadeInUp 0.3s ease;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

</style>
    <!-- Start Page Content here -->
    <div class="content-page-inner">

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="content">
                        <div class="container-fluid wizard-border">
                            <div class="row">
                                <div class="col-12 table-responsive">
                                    <div>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Investor Name</th>
                                                    <th>Asset Name</th>
                                                    <th>Quantity</th>
                                                    <th>Total Amount</th>
                                                    <th>Payment Method</th>
                                                    <th>Details</th>
                                                    <th>Status</th>
                                                    <th>Modified at</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($requests as $index => $value)
                                                    <tr>
                                                        <td>{{ $value->user->name }}</td>
                                                        <td>{{ $value->property->propertyName }}</td>
                                                        <td>{{ $value->token_acquire }}</td>
                                                        <td>{{ number_format((float)($value->commission ?? 0) + (float)($value->deal_amount ?? 0), 2) }}</td>
                                                        <td>{{ ucwords(str_replace('_', ' ', $value->payment_mode)) }}</td>
                                                        <td>

                                                            @php
                                                                $data = [
                                                                    'user' =>$value->user,
                                                                    'request' => $value,
                                                                    'user_details' => $value->user->identity,
                                                                    'user_contract' => $value->usercontract,
                                                                    'blockchain' => $value->usercontract->blockchain,
                                                                    'tokenTransaction' => $value->tokenTransaction ?? null,
                                                                    'payment_url' => $value->payment_proof_url ?  @img($value->payment_proof_url ) : null
                                                                ];
                                                            @endphp
                                                            <button class="btn btn-sm btn-outline-primary" onclick='openBuyRequestModal(@json($data))'>View</button>

                                                        </td>
                                                        <td style="color: {{ $statusColors[$value->status] ?? 'gray' }};">
                                                            {{ ucfirst($value->status) }}
                                                        </td>
                                                        <td>{{ $value->updated_at }}</td>

                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td colspan="8" class="text-center">No records found.</td>
                                                    </tr>
                                                @endforelse
                                            </tbody>
                                        </table>

                                        <!-- Pagination -->
                                        <div class="mt-3">
                                            {{ $requests->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Buy Request Details Modal -->
        <div id="buyRequestDetailsModal" class="modal" style="display: none; position: fixed; z-index: 9999; top: 0; left: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5);">
            <div class="modal-dialog" style="margin: 4% auto; max-width: 720px;">
                <div class="modal-content" style="border-radius: 10px; overflow: hidden;">
                    <!-- Modal Header -->
                    <div class="modal-header d-flex justify-content-between align-items-center" id="modalHeader" style="background: gray; color: white; padding: 20px 24px;">
                        <h5 class="modal-title mb-0" id="modalHeaderTitle" style="color: white">Buy Request Details -</h5>
                        <button type="button" class="btn-close" onclick="closeBuyRequestModal()" style="font-size: 1.6rem; background: transparent; border: none; color: white; line-height: 1;">×</button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body" style="padding: 32px; background-color: #fff;">
                        <!-- Section: Investor -->
                        <h6 class="mb-3" style="color: #gray;">Investor Info</h6>
                        <div class="row mb-3">
                            <div class="col-sm-6"><strong>Name:</strong> <span id="modalInvestorName">-</span></div>
                            <div class="col-sm-6"><strong>ID:</strong> <span id="modalInvestorId">-</span></div>
                            <div class="col-sm-6"><strong>Country:</strong> <span id="modalInvestorCountry">-</span></div>
                            <div class="col-sm-6"><strong>Address:</strong> <span id="modalInvestorAddress">-</span></div>
                        </div>



                        <!-- Section: Custody -->
                        <h6 class="mb-3 mt-4" style="color: #gray;">Custody Info</h6>
                        <p><strong>Wallet Type:</strong> <span id="modalWalletType">-</span></p>
                        <p id="modalExternalWalletWrapper" style="display: none;">
                            <strong>External Address:</strong> <span id="modalExternalWallet">-</span>
                        </p>

                        <!-- Section: Payment -->
                        <h6 class="mb-3 mt-4" style="color: #gray;">Payment Info</h6>
                        <p><strong>Mode:</strong> <span id="modalPaymentMethod">-</span></p>
                        <p id="modalTransactionHashWrapper" style="display: none;">
                            <strong>Transaction ID:</strong>
                            <a id="modalTransactionHash" href="#" target="_blank" style="word-break: break-all; color: #007bff;">-</a>
                        </p>
                        <div id="modalPaymentProofWrapper" style="display: none; margin-top: 10px;">
                            <strong>Payment Proof:</strong><br>
                            <img id="modalPaymentProof" src="#" alt="Proof" style="max-width: 100%; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); margin-top: 8px;">
                        </div>

                        <!-- Section: Tokens -->
                        <h6 class="mb-3 mt-4" style="color: #gray;">Token Info</h6>
                        <p><strong>Requested:</strong> <span id="modalTokenRequested">-</span></p>
                        <p><strong>Transferred:</strong> <span id="modalTokenTransferred">-</span></p>

                        <!-- Section: Note -->
                        <h6 class="mb-2 mt-4" style="color: #gray;">Note</h6>
                        <textarea id="modalNote" class="form-control" rows="3" style="resize: none; background: #f7f7f7; border: 1px solid #ced4da; border-radius: 8px;"></textarea>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer" style="padding: 20px 24px; background: #f1f3f5;">
                        <button class="btn btn-secondary" onclick="closeBuyRequestModal()" style="border-radius: 8px; padding: 8px 16px;">Close</button>
                    </div>
                </div>
            </div>
        </div>



    </div>
    <!-- END content-page -->
    <script>
        const statusColors = {
            inProgress: '#fd7e14',  // orange
            inReview: '#0d6efd',    // blue
            success: '#198754',     // green
            reject: '#dc3545',      // red
            failed: '#dc3545'       // red
        };

        function openBuyRequestModal(data) {
            const modal = document.getElementById('buyRequestDetailsModal');
            const modalHeader = document.getElementById('modalHeader');
            const modalTitle = document.getElementById('modalHeaderTitle');

            const status = data.request?.status || 'inProgress';
            const color = statusColors[status] || 'gray';

            modalHeader.style.backgroundColor = color;
            modalHeader.style.color = 'white';
            modalTitle.textContent = `Buy Request Details - ${status.charAt(0).toUpperCase() + status.slice(1)}`;


            // Investor
            document.getElementById('modalInvestorName').textContent = data.user?.name || '-';
            document.getElementById('modalInvestorId').textContent = data.user?.id || '-';
            document.getElementById('modalInvestorCountry').textContent = data.user_details?.nationality || '-';
            document.getElementById('modalInvestorAddress').textContent = data.user_details?.address || '-';


            // Custody
            const walletType = data.request?.wallet_type ? 'External' : 'Internal';
            document.getElementById('modalWalletType').textContent = walletType;

            if (walletType === 'External') {
                document.getElementById('modalExternalWalletWrapper').style.display = 'block';
                document.getElementById('modalExternalWallet').textContent = data.request?.receiver_wallet_address || '-';
            } else {
                document.getElementById('modalExternalWalletWrapper').style.display = 'none';
            }

            // Payment
            // document.getElementById('modalPaymentMethod').textContent = data.request?.payment_mode || '-';
            document.getElementById('modalPaymentMethod').textContent = (data.request?.payment_mode || '-').replace(/_/g, ' ').replace(/\b\w/g, c => c.toUpperCase());

            if (data.tokenTransaction?.transaction_hash) {
                const explorer = data.blockchain?.link || '#';
                const hash = data.tokenTransaction.transaction_hash;
                const link = explorer.endsWith('/') ? explorer + 'tx/' + hash : explorer + '/tx/' + hash;
                document.getElementById('modalTransactionHashWrapper').style.display = 'block';
                const anchor = document.getElementById('modalTransactionHash');
                anchor.href = link;
                anchor.textContent = hash;
            } else {
                document.getElementById('modalTransactionHashWrapper').style.display = 'none';
            }

            if (data.payment_url) {
                document.getElementById('modalPaymentProofWrapper').style.display = 'block';
                document.getElementById('modalPaymentProof').src = data.payment_url;
            } else {
                document.getElementById('modalPaymentProofWrapper').style.display = 'none';
            }

            // Token info
            document.getElementById('modalTokenRequested').textContent = data.request?.token_acquire || '-';
            document.getElementById('modalTokenTransferred').textContent = data.tokenTransaction?.number_of_token || '-';

            // Note
            document.getElementById('modalNote').value = data.request?.note || '';

            // Show modal
            modal.style.display = 'block';
        }

        function closeBuyRequestModal() {
            const modal = document.getElementById('buyRequestDetailsModal');
            modal.style.display = 'none';
        }
    </script>


@endsection
