$(document).ready(function() {
    $('select[name="namedropdown"]').change(function(event){payoutupdate()});
    $('select[name="namedropdownpayin"]').change(function(event){payinupdate()});
})

function payoutupdate()
{
     var id = $("#namedrop").val();
    $.ajax({
        url:'payoutcomplete.php',
        method:'POST',
        data: {id:id},
        dataType: "html",
        success: function(event){
            $("#displaynameforajax").html(event);
            payouttable();
                           }
    });
}
function payouttable()
{
     var id = $("#namedrop").val();
    $.ajax({
        url:'createtablepayout.php',
        method:'POST',
        data: {id:id},
        dataType: "html",
        success: function(event){
            $("#payouttable").html(event);
            $("#payoutconfirmbutton").click(function(event){payoutupdatepayment()});
                           }
    });
}
function payoutupdatepayment()
{
     var id = $("#namedrop").val();
    $.ajax({
        url:'payoutupdatepayment.php',
        method:'POST',
        data: {id:id},
        dataType: "html",
        success: function(event){
            alert("updated");
            location.reload();
                           }
    });
}
function payinupdate()
{
    var id = $("#namedroppayin").val();
    $.ajax({
        url:'payincomplete.php',
        method:'POST',
        data: {id:id},
        dataType: "html",
        success: function(event){
            $("#displaynamepayinajax").html(event);
            payintable();
                           }
    });
}

function payintable()
{
     var id = $("#namedroppayin").val();
    $.ajax({
        url:'createtablepayin.php',
        method:'POST',
        data: {id:id},
        dataType: "html",
        success: function(event){
            $("#payintable").html(event);
            $("#payinconfirmbutton").click(function(event){payinupdatepayment()});
                           }
    });
}

function payinupdatepayment()
{
     var id = $("#namedroppayin").val();
    $.ajax({
        url:'payinupdatepayment.php',
        method:'POST',
        data: {id:id},
        dataType: "html",
        success: function(event){
            alert("updated");
            location.reload();
                           }
    });
}