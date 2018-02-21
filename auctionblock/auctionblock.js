$(document).ready(function(){
    $("#itemnumber").focus(); // creates the focus on the first box
 $("#auctionbutton").on("click", function(){auctionblockajax()}) //calls the auction block when the submit is pressed
});
// ensures that a value is not empty
function inputvalidation()
{
 if($("#itemnumber").val() == "")
 {
    highlightbox("#itemnumber");
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
//gets the values of all of the text boxes and puts them into the database
function auctionblockajax()
{
    if(inputvalidation()) // ensures that the values are correct
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
//highlioghts the boarders red if critera is not met for input validation
function highlightbox(selector)
{
    $(selector).css('border-color', 'red');
}