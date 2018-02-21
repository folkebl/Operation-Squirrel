$(document).ready(function() {
    $('select[name="namedropdownpayin"]').change(function(event){payinupdate()}); // calls function when a name is selected in the drop down
})
// is called to display neme at top of page
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
// Creates the table 
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
            $("#payinconfirmbutton").click(function(event){payincheckifalreadypaid()});
                           }
    });
}
// is called to update the payement
function payinupdatepayment()
{
     var id = $("#namedroppayin").val();
    $.ajax({
        url:'payinupdatepayment.php',
        method:'POST',
        data: {id:id},
        dataType: "html",
        success: function(event){
            signpad();
                           }
    });
}
// the function that control all of the users sign features
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
             var id = $("#namedroppayin").val();
            var data = signaturePad.toDataURL('image/png');
              $( this ).dialog("close");
              $.post('../saveimg.php', {
                imgBase64: data,
                artist: id,
                title: "Pay In",
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
// Cheacks to see if the user has already paid
function payincheckifalreadypaid()
{
    var id = $("#namedroppayin").val();
    $.ajax({
        url:'Payinpaycheckajax.php',
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
                            payinupdatepayment();
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
                payinupdatepayment();
            }
                           }
    });
}