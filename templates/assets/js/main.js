    $(document).ready(function(){		        $('#postJson').click(function(){ // just checking the ajux request            // show that something is loading            $('#response').html("<b>Loading response...</b>");            /*             * 'post_receiver.php' - where you will pass the form data             * $(this).serialize() - to easily read form data             * function(data){... - data contains the response from post_receiver.php             */            $.post(ajax.url, JSON.stringify({"operation":{type:"quotation_test"}, user_id: "143", username: "ninjazhai", website: ajax.url, message:"Hi this from front end message" }), function(data){					console.log(data);                // show the response                $('#response').html(data);            }).fail(function() {                // just in case posting your form failed                alert( "Posting failed." );            });            // to prevent refreshing the whole page page            return false;        });    });