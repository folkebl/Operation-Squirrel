$(document).ready(function(){
    $("#itemdone").on("click",function(){
        itemalert();
    })
});
function itemalert()
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
function updateitemdata(){
    var itemnum = $("#namedropregistration").val();
    var desc = $("#desc").val();
    var condition = $("#condition").val();
    var sellernotes = $("#sellernotes").val();
    var stratingbid = $("#stratingbid").val();
    var charity = $("#charity").val();

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