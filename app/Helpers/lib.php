<?php
namespace App\Helpers;

use DB;
use Image;
use File;
use Storage;
use Form;
use Auth;

use App\User;

class lib{
    
    public static function active_status($id){
        $text = "";
        if($id=='0'){
            $text = "ไม่ใช้งาน";
        }elseif($id=='1'){
            $text = "ใช้งาน";
        }
        return $text;
    }
    /*
     * $request_file ex.  $request->file('file_name')
     * $public_path ex. '/image/'
     * $width default 400
     * $height dufault 400
     */
    public static function upload_file($request_file,$public_path,$width="",$height=""){
            if($request_file){
            $image = $request_file;
            $image_name = $image->getClientOriginalName();
            $filename = rand().date('dmYHis').".".$image->getClientOriginalExtension();
            //ใช้ public_path ถ้าใช้ storage_path ให้เพิ่ม @param
            $location = public_path($public_path.$filename);
            $width = ($width=="")?600:$width;
            $height = ($height=="")?400:$height;
            Image::make($image)->resize($width,$height)->save($location);
            return [
                'image_name' => $image_name,
                'file_name' => $filename
                ];
            }  
    }
    public static function delete_file($file){
        $filename = public_path($file);
        File::delete($filename);
    }

    //ไปหา class หรือ id ที่ตั้ง
    public static function edit_data($target_data){
        return Form::button('<a><span class=\'fa fa-edit\'></span></a>',['class'=>'btn btn-default',"data-toggle"=>"modal","data-target"=>$target_data]);
    }
    public static function edit_data_dis(){
        return Form::button('<a><span class=\'fa fa-edit\'></span></a>',['class'=>'btn btn-default','disabled']);
    }

    //ไปหา class หรือ id ที่ตั้ง
    public static function delete_data($id){
        return Form::button('<a><span class=\'fa fa-trash\'></span></a>',['onclick'=>'delete_form_data('.$id.')','type'=>'submit','class'=>'btn btn-default']);
        
    }
    public static function delete_data_dis(){
        return Form::button('<a><span class=\'fa fa-trash\'></span></a>',['class'=>'btn btn-default','disabled']);
    }

    /*
        $totaldata ข้อมูลทั้งหมดแถว
        $links ex. $Rooms->links()
    */
    public static function pagination($totaldata="",$links=""){
        $html = '';
        $html = '<div class="row">';
        $html .= '<div class="col-md-12">';     
        $html .=  '<p class="text-center">จำนวนข้อมูลทั้งหมด '.$totaldata.' รายการ </p>';                       
        $html .=    '<div class="text-center">'.$links.'</div>';
        $html .=   '</div>';
        $html .=   '</div>';      
        return $html;  
    }

    /*
    $table = ชื่อตาราง
    $fild ชื่อฟิลด์ที่จะเช็ค
    $req ส่งค่า $request เพื่อเช็คเงื่อนไข
    */
    public static function ChkDuplicate($table,$feild,$req){   
        $check_row = DB::table($table)
        ->where($feild,'=',$req)
        ->count();
        return $check_row;
    }


    //ชื่อ-นามสกุล user  ที่ login อยู่
    public static function GetUser(){
        return Auth::user()->name." ".Auth::user()->last_name;
    }

    public static function Timediff($time1,$time2){
        return ( strtotime($time1) - strtotime($time2) ) / ( 60*60 );
    }
    //แปลงจาก 19/06/2018 เป็น 2018-06-19
    public static function date_to_db($date){
        if($date){
            $format = explode('/',$date);
            return ($format[2])."-".$format[1]."-".$format[0];
        }
    }
    //
    public static function date_to_input($date,$format){
        $format = strtolower($format);
        $ex = explode('/',$date);
        if($format == 'long'){
            $month = [
             '01' => 'มกราคม',
             '02' => 'กุมภาพันธ์',
             '03' => 'มีนาคม',
             '04' => 'เมษายน',
             '05' => 'พฤษภาคม',
             '06' => 'มิถุนายน',
             '07' => 'กรกฎาคม',
             '08' => 'สิงหาคม',
             '09' => 'กันยายน',
             '10' => 'ตุลาคม',
             '11' => 'พฤศจิกายน',
             '12' => 'ธันวาคม'
            ];
            $date = $ex[0]." ".$month[$ex[1]]." ".($ex[2]+543);
        }elseif($format=='short'){
            $month = [
            '01' => 'ม.ค.',
            '02' => 'ก.พ.',
            '03' => 'มี.ค.',
            '04' => 'เม.ย.',
            '05' => 'พ.ค.',
            '06' => 'มิ.ย.',
            '07' => 'ก.ค.',
            '08' => 'ส.ค.',
            '09' => 'ก.ย.',
            '10' => 'ต.ค.',
            '11' => 'พ.ย.',
            '12' => 'ธ.ค.'
               ];   
        $date = $ex[0]." ".$month[$ex[1]]." ".($ex[2]+543);
        }
    
        return $date;
    }

    public static function date_from_db($date,$format){
        $format = strtolower($format);
        $ex = explode('-',$date);
        if($format == 'long'){
            $month = [
             '01' => 'มกราคม',
             '02' => 'กุมภาพันธ์',
             '03' => 'มีนาคม',
             '04' => 'เมษายน',
             '05' => 'พฤษภาคม',
             '06' => 'มิถุนายน',
             '07' => 'กรกฎาคม',
             '08' => 'สิงหาคม',
             '09' => 'กันยายน',
             '10' => 'ตุลาคม',
             '11' => 'พฤศจิกายน',
             '12' => 'ธันวาคม'
            ];
            $date = $ex[2]." ".$month[$ex[1]]." ".($ex[0]+543);
        }elseif($format=='short'){
            $month = [
            '01' => 'ม.ค.',
            '02' => 'ก.พ.',
            '03' => 'มี.ค.',
            '04' => 'เม.ย.',
            '05' => 'พ.ค.',
            '06' => 'มิ.ย.',
            '07' => 'ก.ค.',
            '08' => 'ส.ค.',
            '09' => 'ก.ย.',
            '10' => 'ต.ค.',
            '11' => 'พ.ย.',
            '12' => 'ธ.ค.'
               ];  
            $date = $ex[2]." ".$month[$ex[1]]." ".($ex[0]+543);    
        }
        return $date;
    }

    public static function check_relate($value,$table_relate,$fild){
        $query = DB::table($table_relate)->where($fild,'=',$value);
        return $query->count();
    }
}