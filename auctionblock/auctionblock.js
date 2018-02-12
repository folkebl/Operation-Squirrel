$(document).ready(function(){
    $("#itemnumber").focus();
 $("#auctionbutton").on("click", function(){auctionblockajax()})
});

function inputvalidation()
{
 if($("#itemumber").val() == "")
 {
    highlightbox("#itemumber");
    alert("item number is a required field");
    return false;
 }
 else  if($("#buyernumber").val() == "")
            {
                highlightbox("#buyernumber");
                alert("buyer number is a required field");
                return false;
            }
        else  if($("#sellprice").val() == "")
                {
                highlightbox("#sellprice");
                alert("Selling price is a required field");
                return false;
                }
return true;
}

function auctionblockajax()
{
    if(inputvalidation())
    {
        var itemnumber = $("#itemnumber").val();
        var buyernumber = $("#buyernumber").val();
        var sellprice = $("#sellprice").val();
        console.log(itemnumber,buyernumber,sellprice);
        $.ajax({
            url:'auctionblockajax.php',
            method:'POST',
            data: {itemnumber,buyernumber,sellprice},
            dataType: "html",
            success: function(data){
                location.reload();
            }
        });
    }
}
function highlightbox(selector)
{
    $(selector).css('border-color', 'red');
}