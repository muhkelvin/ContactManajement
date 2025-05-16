<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /** @use HasFactory<\Database\Factories\ContactFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'notes',
        'contact_group_id',
    ];

    /**
     * Get the group that the contact belongs to
     */
    public function group()
    {
        return $this->belongsTo(ContactGroup::class, 'contact_group_id');
    }
}
