$(document).ready(function(){
    $("#registersubmit").on("click",function(){
        registeralert();
    })
});
function registeralert()
{
    if(inputvalidation())
    {
    $("#registerdialogbox").dialog({
        title: "Data Submitted",
        dialogClass: "no-close",
        draggable: false,
        height: 250,
        width: 400,
        resizable: false,
        modal: true,
        buttons: [
          {
            text: "Sell Items",
            click: function(event) {
                adduser();
            window.location.href = "http://localhost/sellitem/SellersPage.php";
            }
          },
          {
            text: "Done",
            click: function() {
              adduser();  
              location.reload();
            }
          },
          {
            text: "Cancel",
            click: function() {
                $( this ).dialog("close");
            }
          }
        ]
      });
    }
}
function adduser()
{
    var fname = $("#firstname").val();
    var lname = $("#lastname").val();
    var phone = $("#phone").val();
    var email = $("#email").val();
    console.log(fname,lname,phone,email);
    $.ajax({
        url:'registerajax.php',
        method:'POST',
        data: {fname,lname,phone,email},
        dataType: "html",
        success: function(data){
            alert(data);
                           }
    });
}

function inputvalidation()
{
    var fname = $("#firstname").val();
    var lname = $("#lastname").val();
    var phone = $("#phone").val();
    var email = $("#email").val();
    if(fname == "")
    {
       highlightbox("#firstname");
       alert("First name is a required field");
       return false;
    }
    else if(lname == "")
            {
            highlightbox("#firstname");
            highlightbox("#lastname");
            alert("Last name is a required field");
            return false;
            }
            else if(!/^[a-zA-Z]*$/g.test(fname))
                    {
                        highlightbox("#firstname");
                        alert("Only letters are accepted");
                        return false;  
                    }
                    else if(!/^[a-zA-Z]*$/g.test(lname))
                            {
                                highlightbox("#lastname");
                                alert("Only letters are accepted");
                                return false;  
                            }
    return true;
}
function highlightbox(selector)
{
    $(selector).css('border-color', 'red');
}