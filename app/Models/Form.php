<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Form extends Model
{
  use HasFactory;

  protected $fillable = ['title', 'slug'];

  /**
   * Get all of the fields for the Form
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function fields(): HasMany
  {
    return $this->hasMany(FormField::class);
  }

  /**
   * Get all of the responses for the Form
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function responses(): HasMany
  {
    return $this->hasMany(Response::class, 'form_id');
  }
}
