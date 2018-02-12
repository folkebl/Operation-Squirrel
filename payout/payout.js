$(document).ready(function() {
    $('select[name="namedropdown"]').change(function(event){payoutupdate()});
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
            $("#payoutconfirmbutton").click(function(event){payoutcheckifalreadypaid()});
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
            signpad();
                           }
    });
}

function signpad(){
    var canvas = $("#signpad");
    var signaturePad = new SignaturePad(document.getElementById('signpad'), {
    backgroundColor: 'rgba(255, 255, 255, 0)',
    penColor: 'rgb(255, 0, 0)'
  });
  canvas.minWidth = 1000,

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
                var id = $("#namedrop").val();
            var data = signaturePad.toDataURL('image/png');
              $( this ).dialog("close");
              $.post('../saveimg.php', {
                imgBase64: data,
                artist: id,
                title: "Pay Out",
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

function payoutcheckifalreadypaid()
{
    var id = $("#namedrop").val();
    $.ajax({
        url:'Payoutcheckpayajax.php',
        method:'POST',
        data: {id:id},
        dataType: "html",
        success: function(event){
            console.log(event);
            if(event == true)
            {
                $("#alreadypaid").dialog({
                    title: "Already Paid",
                    dialogClass: "no-close",
                    draggable: false,
                    height: 300,
                    width: 400,
                    resizable: false,
                    modal: true,
                    buttons: [
                      {
                        text: "Continue",
                        click: function(event) {
                            payoutupdatepayment();
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
            else
            {
                payoutupdatepayment();
            }
                           }
    });
}