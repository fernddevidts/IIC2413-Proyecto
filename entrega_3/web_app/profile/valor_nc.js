 var ncPrice;
 var displayNC;
 var ethPrice;
 var cname = "ncPrice";
 var cvalue;

function UpdateEthPrice(){
    $.ajax({
        type: "GET",
        url: "https://api.coinmarketcap.com/v1/ticker/bitcoin/",
        dataType: "json",
        success: function(result){
            ethPrice = Math.round(result[0].price_usd * 100)/100;
            ncPrice = ethPrice * 0.001
            cvalue = ncPrice.toString();
            displayNC = " $USD"+ncPrice;
            document.getElementById("valor_nc").innerHTML = displayNC;
            document.cookie= cname + "=" + cvalue;


        },
    error: function(err){
        console.log(err);
    }
    });
};