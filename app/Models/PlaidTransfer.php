<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaidTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plaid_item_id',
        'plaid_item_account_id',
        'transfer_id',
        'authorization_id',
        'type', // debit, credit
        'network', // ach, rtp, wire
        'amount',
        'description',
        'status', // pending, posted, cancelled, failed, returned
        'failure_reason',
        'ach_class',
        'origination_account_id',
        'metadata',
        'webhook_data',
        'created_date',
        'posted_date',
        'cancelled_date',
        'failed_date',
        'returned_date',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'metadata' => 'array',
        'webhook_data' => 'array',
        'created_date' => 'datetime',
        'posted_date' => 'datetime',
        'cancelled_date' => 'datetime',
        'failed_date' => 'datetime',
        'returned_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plaidItem()
    {
        return $this->belongsTo(PlaidItem::class);
    }

    public function plaidItemAccount()
    {
        return $this->belongsTo(PlaidItemAccount::class);
    }

    /**
     * Update transfer status based on webhook data
     */
    public function updateFromWebhook($webhookCode, $webhookData)
    {
        $updates = ['webhook_data' => $webhookData];

        switch ($webhookCode) {
            case 'TRANSFER_EVENTS_UPDATE':
                if (isset($webhookData['new_transfer_status'])) {
                    $updates['status'] = $webhookData['new_transfer_status'];

                    // Set appropriate date based on status
                    switch ($webhookData['new_transfer_status']) {
                        case 'posted':
                            $updates['posted_date'] = now();
                            break;
                        case 'cancelled':
                            $updates['cancelled_date'] = now();
                            break;
                        case 'failed':
                            $updates['failed_date'] = now();
                            if (isset($webhookData['failure_reason'])) {
                                $updates['failure_reason'] = $webhookData['failure_reason'];
                            }
                            break;
                        case 'returned':
                            $updates['returned_date'] = now();
                            break;
                    }
                }
                break;
        }

        $this->update($updates);
        return $this;
    }

    /**
     * Check if transfer is in a final state
     */
    public function isFinal()
    {
        return in_array($this->status, ['posted', 'cancelled', 'failed', 'returned']);
    }

    /**
     * Check if transfer was successful
     */
    public function isSuccessful()
    {
        return $this->status === 'posted';
    }

    /**
     * Check if transfer failed
     */
    public function hasFailed()
    {
        return in_array($this->status, ['cancelled', 'failed', 'returned']);
    }
}