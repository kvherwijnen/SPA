<?php

/**
 * :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
 *
 * Copyright (c) 2020
 * All Rights Reserved
 * Licensed use only
 *
 * This product is part of the SheepCompany Incorporated
 *
 *
 * LICENSE BY:
 * Artificial Intelligence :: Sheep-AI.com
 * More information: LICENSE.txt
 *
 * :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Preferences extends Model
{
    protected $fillable = [
        'dark_mode',
        'silent',
        'theme',
        'hue_installed',
        'hue_client_id',
        'hue_client_secret',
        'hue_device_id',
        'hue_username',
        'hue_access_token',
        'hue_access_token_expires_in',
        'hue_access_token_expires_at',
        'hue_refresh_token',
        'hue_refresh_token_expires_in',
        'hue_refresh_token_expires_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'dark_mode' => 'boolean',
        'silent' => 'boolean',
        'hue_installed' => 'boolean',
        'hue_access_token_expires_in' => 'integer',
        'hue_access_token_expires_at' => 'datetime',
        'hue_refresh_token_expires_in' => 'integer',
        'hue_refresh_token_expires_at' => 'datetime',
    ];

    protected $with = ['theme'];
    /**
     * Get user what owns this object
     *
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get users theme
     *
     * @return HasOne
     */
    public function theme()
    {
        return $this->hasOne(Theme::class, 'id', 'theme');
    }
}
