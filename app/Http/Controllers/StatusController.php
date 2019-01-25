<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatusController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }


  public function index()
  {
    return view('status/index');
  }

  public function getStatus()
  {
    $toBeCollected = DB::select('select IFNULL(sum(price * amount * (1 + tax / 100)), 0) as "toBeCollected" from income_products where income_id in 
    (select id from incomes where status_id = 
      (select id from statuses where title = "not paid")) and user_id in 
      (select id from users where company_id =
        (select company_id from users where id = ?));', [auth()->user()->id])[0]->toBeCollected;
    $delayedCollection = DB::select('select IFNULL(sum(price * amount * (1 + tax / 100)), 0) as "delayedCollection" from income_products where income_id in 
    (select id from incomes where payment_date < now() and status_id = 
      (select id from statuses where title = "not paid")) and user_id in 
      (select id from users where company_id =
        (select company_id from users where id = ?));', [auth()->user()->id])[0]->delayedCollection;
    $toBePaid = DB::select('select IFNULL(sum(price * amount * (1 + tax / 100)), 0) as "toBePaid" from expense_products where expense_id in 
    (select id from expenses where status_id = 
      (select id from statuses where title = "not paid")) and user_id in 
      (select id from users where company_id =
        (select company_id from users where id = ?));', [auth()->user()->id])[0]->toBePaid;
    $delayedPayment = DB::select('select IFNULL(sum(price * amount * (1 + tax / 100)), 0) as "delayedPayment" from expense_products where expense_id in 
    (select id from expenses where status_id = 
      (select id from statuses where title = "not paid")) and user_id in 
      (select id from users where company_id =
        (select company_id from users where id = ?));', [auth()->user()->id])[0]->delayedPayment;
    $balanceToday = DB::select('select 
    (select ifnull(sum(price * amount * (1 + tax / 100)), 0) from income_products where income_id in
      (select id from incomes where status_id =
        (select id from statuses where title = "paid")) and user_id in 
        (select id from users where company_id =
          (select company_id from users where id = ?)))
            -
    (select ifnull(sum(price * amount * (1 + tax / 100)), 0) from expense_products where expense_id in
      (select id from expenses where status_id = 
        (select id from statuses where title = "paid")) and user_id in 
        (select id from users where company_id =
          (select company_id from users where id = ?))) as "balanceToday";', [auth()->user()->id, auth()->user()->id])[0]->balanceToday;
    $balanceTotal = DB::select("select 
    (select ifnull(sum(price * amount * (1 + tax / 100)), 0) from income_products where user_id in 
    (select id from users where company_id =
      (select company_id from users where id = ?)))
            -
    (select ifnull(sum(price * amount * (1 + tax / 100)), 0) from expense_products where user_id in 
    (select id from users where company_id =
      (select company_id from users where id = ?))) as 'balanceTotal';", [auth()->user()->id, auth()->user()->id])[0]->balanceTotal;
    
    return response()->json([
      'toBeCollected' => $toBeCollected, 
      'delayedCollection' => $delayedCollection,
      'toBePaid' => $toBePaid,
      'delayedPayment' => $delayedPayment,
      'balanceToday' => $balanceToday,
      'balanceTotal' => $balanceTotal
      ]);
    
  }
}
