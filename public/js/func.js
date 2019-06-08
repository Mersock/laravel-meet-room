
    //form-save-req
    function btn_save_req(){
        var count_field = 0;
        var num_length = $('.validate-data').length;
        $('.validate-data').each(function(){
            var field = $(this).attr('field');
            if(this.value==""){
                alert('กรุณาระบุ'+field);
                $('#'+this.id).focus();
                return false;
            }
            count_field++;
        });
        if(count_field==num_length){
            if(confirm('ยืนยันการบันทึก')){
            $('#form-request').submit();
            }
        }
    }
         //form-save-update
        function btn_save_update(id){
            var count_field = 0;
            var num_length = $('.validate-data_'+id).length;
            $('.validate-data_'+id).each(function(){
                var field = $(this).attr('field');
                if(this.value==""){
                    alert('กรุณาระบุ'+field);
                    $('#'+this.id).focus();
                    return false;
                }
                count_field++;
            });
            if(count_field==num_length){
                if(confirm('ยืนยันการบันทึก')){
                $('#form-update_'+id).submit();
                }
            }

        }
  
        //form-update-reset
        function btn_reset_update(){
            $(':input')
            .not(':button, :submit, :reset, :hidden, :checkbox, :radio')
            .prop('checked', false)
            .prop('selected', false)
            .val(null)
            .val(null).trigger('change'); 
        }

        //form-update-reset
       function btn_reset_req(){ 
        $(':input')
        .not(':button, :submit, :reset, :hidden, :checkbox, :radio')
        .prop('checked', false)
        .prop('selected', false)
        .val(null)
        .val(null).trigger('change');
    }    

    function delete_form_data(id){
        if(confirm('ยืนยันการลบรายการนี้')){
        $('#form-del_'+id).submit();
        }
    }
    
    function check_dupicate(id,val,url){
    if(id!="" && val!="" && url!=""){
            $.ajax({
                type:"POST",
                url:url,
                data:{ code:val },
                success:function(data){
                    if(data>0){
                        alert('ข้อมูลซ้ำ');
                        $("#"+id).val(null);
                        $("#"+id).focus();
                    }
                }
            }); 
        }
    }

    function select2_checkall(){
        $(".single-select-multiple > option").prop("selected",true);
        $(".single-select-multiple").trigger("change");
    }
    
        