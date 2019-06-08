<?php

//template route
//include('route_template.php');

// Route::get('/', function () {
//     return view('login');
// });
// Route::get('index', function () {
//     return view('/index');
// });

Auth::routes();
Route::get('/', 'HomeController@index')->name('index');

###Master###
//set_meet_room
Route::resource('/set_meet_room/set_room','set_meet_room\Set_Room_controller');
//set_type_room
Route::resource('/set_meet_room/set_type_room','set_meet_room\Set_Type_Room_controller');
//set_time
Route::get('/set_meet_room/set_time',['uses'=>'set_meet_room\Set_Time_controller@index','as'=>'set_time.index']);
Route::post('/set_meet_room/set_time',['uses'=>'set_meet_room\Set_Time_controller@update_time','as'=>'set_time.update_time']);
###Master###

##reserve_room##
Route::get('/reserve_room/reservation_details',['uses'=>'ReserveRoom\Reservation_details_controller@index','as'=>'reservation_details.index']);
Route::get('/reserve_room/reservation_details/{id}/reserve',['uses'=>'ReserveRoom\Reservation_details_controller@reserve','as'=>'reservation_details.reserve']);
Route::post('/reserve_room/reservation_details',['uses'=>'ReserveRoom\Reservation_details_controller@reserve_create','as'=>'reservation_details.reserve_create']);
##reserve_room##

##approve_reserve##
//อนุมัติการจอง
Route::get('/approve_reserve/approve_reserve_room',['uses'=>'approve_reserve\approve_reserve_room_controller@index','as'=>'approve_reserve_room.index']);
Route::post('/approve_reserve/approve_reserve_room',['uses'=>'approve_reserve\approve_reserve_room_controller@approve','as'=>'approve_reserve_room.approve']);
##approve_reserve##

##aprove_detail##
//แสดงการจองแต่ละ user
Route::get('/approve_reserve/approve_reserve_detail',['uses'=>'approve_reserve\approve_reserve_detail_controller@index','as'=>'approve_reserve_detail.index']);
Route::get('/approve_reserve/approve_reserve_detail/{id}/edit',['uses'=>'approve_reserve\approve_reserve_detail_controller@edit','as'=>'approve_reserve_detail.edit']);
Route::post('/approve_reserve/approve_reserve_detail/',['uses'=>'approve_reserve\approve_reserve_detail_controller@update','as'=>'approve_reserve_detail.update']);
##aprove_detail##

##checkduplicate##
Route::post('/check_code_room','ChkDuplicateController@check_code_room');//รหัสห้อง
Route::post('/check_type_room','ChkDuplicateController@check_type_room');//รหัสห้อง
Route::post('/check_email_user','ChkDuplicateController@check_email_user');//รหัสห้อง
Route::post('/check_code_user','ChkDuplicateController@check_code_user');//รหัสบุคลากร
Route::post('/check_time_reserve','ChkDuplicateController@check_time_reserve');//เช็คซ้ำช่วงเวลาในการจอง
##checkduplicate##


