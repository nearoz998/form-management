<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResponseField extends Model
{
  use HasFactory;

  protected $fillable = ['response_id', 'form_field_id', 'value'];

  /**
   * Get the response that owns the ResponseField
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function response(): BelongsTo
  {
    return $this->belongsTo(Response::class);
  }

  /**
   * Get the formField that owns the ResponseField
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function formField(): BelongsTo
  {
    return $this->belongsTo(FormField::class);
  }
}
