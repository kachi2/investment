<?php 
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Agent Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/register/agents', 'AuthController@register')->name('agency.register');
Route::post('/register/agent/', 'AuthController@registers')->name('agency.registers');
Route::get('/registration/{id}', 'AuthController@CompleteRegistration')->name('agency.registration');
Route::post('/completion/{id}', 'AuthController@AccountCompleted')->name('agency.AccountCompleted');
Route::get('/login', 'AuthController@Login')->name('Agent-login');
Route::post('/logins', 'AuthController@Logins')->name('agent.login');
Route::post('/logout', 'AuthController@logout')->name('agent.logout');


Route::get('/', 'HomeController@index')->name('agency.index');
Route::get('/home', 'HomeController@index')->name('agency.index');
Route::get('index', 'HomeController@index')->name('agency.index');
Route::get('/agent/task', 'HomeController@Task')->name('agency.task');
Route::get('/agent/payments', 'HomeController@Payments')->name('agency.payment');
Route::get('/agent/salary', 'HomeController@SalaryPayments')->name('agency.salary');
Route::post('/agent/salary/invoice', 'HomeController@SalaryInvoice')->name('salary.invoice');
Route::get('/agent/salary/invoice/{id}', 'HomeController@SalaryInvoices')->name('salaries.invoice');
Route::post('/agent/process/payment/', 'HomeController@paymentProcessor')->name('agentProcess.payment');
Route::get('/agent/referral', 'HomeController@AgentReferral')->name('agent.referral');