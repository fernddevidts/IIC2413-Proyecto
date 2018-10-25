 var ethPrice;
 var displayEth;
 var ncPrice;
 var displayNC;

function UpdateEthPrice(){
    $.ajax({
        type: "GET",
        url: "https://api.coinmarketcap.com/v1/ticker/bitcoin/",
        dataType: "json",
        success: function(result){
            ethPrice = result[0].price_usd;
            ncPrice = ethPrice * 0.001
            displayEth = "$USD"+ethPrice;
            displayNC = "$USD"+ncPrice;
            document.getElementById("valor_eth").innerHTML = displayEth;
            document.getElementById("valor_nc").innerHTML = displayNC;

        },
    error: function(err){
        console.log(err);
    }
    });
}

