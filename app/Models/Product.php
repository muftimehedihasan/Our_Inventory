<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'category_id', 'name', 'price', 'unit'];


    // RELATIONSHIPS
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function invoice(){
        return $this->hasMany(Invoice::class);
    }



    public function invoiceProducts()
    {
        return $this->hasMany(InvoiceProduct::class);
    }

}
