function altRows(id){
	if(document.getElementsByTagName){  
		
		var table = document.getElementById(id);  
		var rows = table.getElementsByTagName("tr"); 
		 
		for(i = 0; i < rows.length; i++){          
			if(i % 2 == 0){
				rows[i].className = "two";
			}else{
				rows[i].className = "one";
			}      
		}
	}
}

window.onload=function(){
	altRows('article_table');
}

/**全选**/
$(document).ready(function(){

    $("#all").click(function(){
        $("input[name='items']").each(function(){
            if (this.checked) {
                this.checked = false;
            }
            else {
                this.checked = true;
            }
        });
    });
});