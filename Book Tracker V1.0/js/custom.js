
/*
function table_hide_Function() {
    var x = document.getElementById("all-book-list");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function table_hide_Function() {
    var x = document.getElementById("all-book-list");
     x.style.display = "none";
}
function table_show_Function() {
    var x = document.getElementById("all-book-list");
     x.style.display = "block";
}
*/

$(document).ready(function(){

    load_data();

    function load_data(query)
    {
        $.ajax({
            url:"magic/fetch.php",
            method:"POST",
            data:{query:query},
            success:function(data)
            {
                $('#result').html(data);
            }
        });
    }

    $('#search_text').keyup(function(){
        var search = $(this).val();
        if(search != '')
        {
            load_data(search);
        }
        else
        {
            load_data();
        }
    });

});
