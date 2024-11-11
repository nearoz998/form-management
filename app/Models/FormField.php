<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FormField extends Model
{
  use HasFactory;

  protected $fillable = ['label', 'type', 'options', 'placeholder', 'required', 'form_id'];

  protected $casts = [
    'required' => 'boolean',
  ];

  /**
   * Get the form that owns the FormField
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function form(): BelongsTo
  {
    return $this->belongsTo(Form::class);
  }

  /**
   * Get all of the responseFields for the FormField
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function responseFields(): HasMany
  {
      return $this->hasMany(ResponseField::class, 'form_field_id');
  }
}
