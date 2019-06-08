     $(document).ready(function() {
         //token ajax laravel
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
            //reset value when hide form add
            $('.add-single-select').select2({
                placeholder: "กรุณาเลือก",
                allowClear: true
            });
            $('.single-select').select2({
                placeholder: "กรุณาเลือก",
                allowClear: true,
            });

            $('.single-select-multiple').select2();
           // $('.single-select').select2({width: 'resolve'});
            //$('.single-select').select2({dropdownAutoWidth : true});

            //when hide modal rest form
            $('.add-data').on('hidden.bs.modal', function(){
                $(this).find('form')[0].reset();
                $('.add-single-select').val(null).trigger('change');
            });
         
          //show-hide searchtext
          $("#search-toggle").click(function(){
            var search = document.getElementById("search-area");

            if (search.style.display === "none") {
                search.style.display = "block";
            } else {
                search.style.display = "none";
            }
          });

          //form-search
          $('.btn-search').click(function(){
               $("#form-search").submit(); 
          });

          $(".btn-reset").click(function(){
            $('#form-search input').each(function(){
               $(this).val(null);
               $('.single-select').val(null).trigger('change');
            });             
          });



      });