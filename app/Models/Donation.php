<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = ['campaign_id', 'donor_name', 'donor_email', 'amount', 'message', 'status'];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}