<?php

namespace App\Models;

use App\Enums\MemberTransactionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberTransaction extends Model
{
    use HasFactory, Traits\HasAllowableFields;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website_id',
        'member_id',
        'type',
        'is_adjustment',
        'account_code',
        'account_name',
        'account_number',
        'company_bank',
        'company_bank_factor',
        'amount',
        'credit_amount',
        'debit_amount',
        'remarks',
        'status',
        'member_ip',
        'member_info',
        'screenshot_name',
        'screenshot_path',
        'approved_by_id',
        'approved_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'website_id' => 'integer',
        'member_id' => 'integer',
        'type' => 'string',
        'is_adjustment' => 'boolean',
        'company_bank_factor' => 'decimal:2',
        'amount' => 'decimal:2',
        'credit_amount' => 'decimal:2',
        'debit_amount' => 'decimal:2',
        'status' => 'integer',
        'approved_by_id' => 'integer',
        'approved_at' => 'timestamp',
    ];

    public function website()
    {
        return $this->belongsTo(Website::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $search)
    {
        $query->where(function ($query) use ($search) {
            $query->whereHas('member', function ($query) use ($search) {
                $query->where('members.username', 'like', "%{$search}%");
            });
            $query->orWhere('company_bank', 'like', "%{$search}%");
        });
    }

    public function approve($user)
    {
        $this->status = MemberTransactionStatus::APPROVED;
        $this->approved_by_id = $user->id;
        $this->approved_at = now();
        $this->save();
    }

    public function reject($user)
    {
        $this->status = MemberTransactionStatus::REJECTED;
        $this->approved_by_id = $user->id;
        $this->approved_at = now();
        $this->save();
    }
}
