    $(document).ready(function(){
        $('#cardetail').click(function(){
            $('#showcar').show();
            $('input').prop('required',true);
            $('input').prop('required',true);
            $('#caradd').hide();
            $('#hidecar').show();
        });
        $('#skipcar').click(function(){
            $('#showcar').hide();
            $('input').prop('required',false);
            $('input').prop('required',false);
            $('#caradd').show();
            $('#hidecar').hide();
        });

        $('#tickets').change(function(){
            var t = $('#tickets').val();
            var c = $('#cost').val();
            $('#totalcost').val(t*c);
        });

        // $('#showid').click(function(){
        //     var i = $('.forid').attr("id");
        //     $.ajax({
        //         type: "POST",
        //         url: "script.php",
        //         data: {
        //             "request": "bookings",
        //             "id": i,
        //         },
        //         success: function(response){
        //             // response=JSON.parse(response);
        //             alert(response)
        //             // $('#totalseats').val(response.seating_capacity);
        //             // $('#ad').val(response.added_by);
        //         }
        //     })
        // });
    })