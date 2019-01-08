<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'company_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function expense_product()
    {
        return $this->hasMany(ExpenseProduct::class);
    }

    public function expense()
    {
        return $this->hasMany(Expense::class);
    }
    
    public function supplier()
    {
        return $this->hasMany(Supplier::class);
    }

    public function customer()
    {
        return $this->hasMany(Customer::class);
    }

    public function income()
    {
        return $this->hasMany(Income::class);
    }

    public function income_product()
    {
        return $this->hasMany(IncomeProduct::class);
    }

    public function isSupplierMine(Supplier $supplier)
    {
        $supplierCompany = $supplier->user->company;
        if($this->company == $supplierCompany)
        return 1;
        return 0;
    }

    public function isProductMine(Product $product)
    {
        $productCompany = $product->user->company;
        if($this->company == $productCompany)
        return 1;
        return 0;
    }

    public function isExpenseMine(Expense $expense)
    {
        $expenseCompany = $expense->user->company;
        if($this->company == $expenseCompany)
        return 1;
        return 0;
    }
}
