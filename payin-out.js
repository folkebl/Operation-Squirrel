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
            signpad("Pay Out");
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
            signpad("Pay In");
                           }
    });
}

function signpad($payinout){
    var canvas = $("#signpad");
    var signaturePad = new SignaturePad(document.getElementById('signpad'), {
    backgroundColor: 'rgba(255, 255, 255, 0)',
    penColor: 'rgb(255, 0, 0)'
  });
  canvas.minWidth = 1000,
// function signpad()
// {

    $("#signpaddialog").dialog({
        title: "Sign To Confirm Payment",
        dialogClass: "no-close",
        draggable: false,
        height: 500,
        width: 900,
        resizable: false,
        modal: true,
        buttons: [
          {
            text: "Save",
            click: function(event) {
                if($payinout == "Pay In")
                var id = $("#namedroppayin").val();
                else
                var id = $("#namedrop").val();
            var data = signaturePad.toDataURL('image/png');
              $( this ).dialog("close");
              $.post('../saveImg.php', {
                imgBase64: data,
                artist: id,
                title: $payinout,
                date: new Date().toDateString()
            }, function(o) {
                console.log('saved');
                location.reload();
            });
            }
          },
          {
            text: "Close",
            click: function() {
              $( this ).dialog("close");
            }
          }
        ]
      });
}