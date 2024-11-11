<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Response extends Model
{
  use HasFactory;

  protected $fillable = ['form_id'];

  /**
   * Get the form that owns the Response
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function form(): BelongsTo
  {
    return $this->belongsTo(Form::class);
  }

  /**
   * Get all of the fields for the Response
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function fields(): HasMany
  {
    return $this->hasMany(ResponseField::class);
  }
}
