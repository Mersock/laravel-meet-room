<?php
Route::get('/template', function () {
    return view('template.sb_admin_2.index');
});
Route::get('template/flots', function () {
    return view('template.sb_admin_2.flots');
});
Route::get('template/morris', function () {
    return view('template.sb_admin_2.morris');
});
Route::get('template/table', function () {
    return view('template.sb_admin_2.table');
});
Route::get('template/forms', function () {
    return view('template.sb_admin_2.forms');
});
Route::get('template/panels-wells', function () {
    return view('template.sb_admin_2.panels-wells');
});
Route::get('template/buttons', function () {
    return view('template.sb_admin_2.buttons');
});
Route::get('template/notifications', function () {
    return view('template.sb_admin_2.notifications');
});
Route::get('template/typography', function () {
    return view('template.sb_admin_2.typography');
});
Route::get('template/icons', function () {
    return view('template.sb_admin_2.icons');
});
Route::get('template/grid', function () {
    return view('template.sb_admin_2.grid');
});
Route::get('template/blank', function () {
    return view('template.sb_admin_2.blank');
});
Route::get('template/login', function () {
    return view('template.sb_admin_2.login');
});
