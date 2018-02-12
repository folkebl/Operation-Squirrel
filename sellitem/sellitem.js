$(document).ready(function(){
    getdatafromurl();
    $("#itemdone").on("click",function(){
        itemalert();
    })
});
function getdatafromurl()
{
    var url_string = window.location.href;
    var url = new URL(url_string);
    var id = url.searchParams.get("id");
     console.log(id)
        if (isNaN(id))
            {
                $("#namedropregistration").val(0);
            }
            else if (id == "" || id == null)
                    {
                        $("#namedropregistration").val(0);
                    }
                    else 
                    {
                        $("#namedropregistration").val(id);
                    }
}
function itemalert()
{
    if(inputvalidation())
    {
    $("#itemdialogbox").dialog({
        title: "Data Submitted",
        dialogClass: "no-close",
        draggable: false,
        height: 250,
        width: 400,
        resizable: false,
        modal: true,
        buttons: [
          {
            text: "Done",
            click: function(event) {
                updateitemdata();
             window.location.href = "http://localhost/register/Registration.php";
            }
          },
          {
            text: "Add Another",
            click: function() {
                updateitemdata();
              location.reload();
            }
          },
          {
            text: "Cancel",
            click: function() {
                $(this).dialog("close");
            }
          }
        ]
      });
    }
}
function updateitemdata(){
    var itemnum = $("#namedropregistration").val();
    var desc = $("#desc").val();
    var condition = $("#condition").val();
    var sellernotes = $("#sellernotes").val();
    var stratingbid = $("#stratingbid").val();
    var charity = $('#charity').is(':checked');
    if(charity == true)
    charity = 1;
    else
    charity = 0;
    
    console.log(itemnum,desc,condition,sellernotes,stratingbid,charity);
    $.ajax({
        url:'sellitemajax.php',
        method:'POST',
        data: {itemnum,desc,condition,sellernotes,stratingbid,charity},
        dataType: "html",
        success: function(data){
            alert(data);
                           }
    });
}
function inputvalidation()
{
    var itemnum = $("#namedropregistration").val();
    console.log(itemnum);
    var desc = $("#desc").val();
    var condition = $("#condition").val();
    var sellernotes = $("#sellernotes").val();
    var stratingbid = $("#stratingbid").val();
    var charity = $("#charity").val();
    var charity = $('#charity:checkbox:checked').length > 0;
    console.log(charity);
    if(itemnum == 0)
        {
            highlightbox("#namedropregistration");
            alert("You must select a name");
            return false;
        }
        else if(desc == "")
                {
                    highlightbox("#desc");
                    alert("You must select a item description");
                    return false;
                }
            else if(sellernotes == "")
                    {
                        highlightbox("#desc");
                        alert("You must select a item description");
                        return false;
                    }
                else if (condition == "")
                        {
                            highlightbox("#condition");
                            alert("You must fill in the item description");
                            return false;
                        }
                    else if (stratingbid == "")
                            {
                                highlightbox("#stratingbid");
                                alert("You must input the starting bid");
                                return false;
                            }
    return true;
}
function highlightbox(selector)
{
    $(selector).css('border-color', 'red');
}