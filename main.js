// $("button").click(function(){
	var str = "<?php echo $hacks[0][0] ?>";
// 	alert(str)
//     $("p").text(str);
// });

var hacks = [
	["HackMTY", "Monterrey, MX", "August 27th - 28th"],
	["BigRed//Hacks", "Ithaca, NY", "September 16th - 18th"]
]

$(document).ready(function(){
    $('button').click(function(){
    	var temp;
    	var int;
    	for(var i=0; i<hacks.length; i++){
    		temp = hacks.find(function(element){
    			console.log($("form input:text").val());
    			return element === $("form input:text").val();
    		})
    		if(temp != ''){
    			int = i
    			break;
    		}
    	}
    	temp = '';
    	for(var i=0; i<hacks[0].length; i++){
    		temp += " " + hacks[int][i];
    	}
    	$('p').html("<li>" + temp + "</li>");
    });
});