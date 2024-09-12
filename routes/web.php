<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ComercioController;

Route::resource('comercios', ComercioController::class);
Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
    return view('admin.admin');
});

Route::post('/logout', function () {
    Auth::logout(); 
    return redirect('/Login'); 
})->name('logout');

Route::get('/Login', function () {
    return view('session.pages-login');
});

Route::get('/Register', function () {
    return view('session.pages-register');
});

// Charts
Route::get('/charts-apexcharts', function () {
    return view('admin.charts-apexcharts');
});

Route::get('/charts-chartjs', function () {
    return view('admin.charts-chartjs');
});

Route::get('/charts-echarts', function () {
    return view('admin.charts-echarts');
});

// Components
Route::get('/components-accordion', function () {
    return view('admin.components-accordion');
});

Route::get('/components-alerts', function () {
    return view('admin.components-alerts');
});

Route::get('/components-badges', function () {
    return view('admin.components-badges');
});

Route::get('/components-breadcrumbs', function () {
    return view('admin.components-breadcrumbs');
});

Route::get('/components-buttons', function () {
    return view('admin.components-buttons');
});

Route::get('/components-cards', function () {
    return view('admin.components-cards');
});

Route::get('/components-carousel', function () {
    return view('admin.components-carousel');
});

Route::get('/components-list-group', function () {
    return view('admin.components-list-group');
});

Route::get('/components-modal', function () {
    return view('admin.components-modal');
});

Route::get('/components-pagination', function () {
    return view('admin.components-pagination');
});

Route::get('/components-progress', function () {
    return view('admin.components-progress');
});

Route::get('/components-spinners', function () {
    return view('admin.components-spinners');
});

Route::get('/components-tabs', function () {
    return view('admin.components-tabs');
});

Route::get('/components-tooltips', function () {
    return view('admin.components-tooltips');
});

// Forms
Route::get('/forms-editors', function () {
    return view('admin.forms.forms-editors');
});

Route::get('/forms-elements', function () {
    return view('admin.forms.forms-elements');
});

Route::get('/forms-layouts', function () {
    return view('admin.forms.forms-layouts');
});

Route::get('/forms-validation', function () {
    return view('admin.forms.forms-validation');
});

// Icons
Route::get('/icons-bootstrap', function () {
    return view('admin.icons-bootstrap');
});

Route::get('/icons-boxicons', function () {
    return view('admin.icons-boxicons');
});

Route::get('/icons-remix', function () {
    return view('admin.icons-remix');
});

// Pages
Route::get('/pages-blank', function () {
    return view('admin.pages-blank');
});

Route::get('/pages-contact', function () {
    return view('admin.pages-contact');
});

Route::get('/pages-error-404', function () {
    return view('admin.pages-error-404');
});

Route::get('/pages-faq', function () {
    return view('admin.pages-faq');
});

// Tables
Route::get('/tables-data', function () {
    return view('admin.tables-data');
});

Route::get('/tables-general', function () {
    return view('admin.tables-general');
});

// Users
Route::get('/users-profile', function () {
    return view('admin.users-profile');
});


