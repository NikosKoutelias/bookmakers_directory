function show(){
    let result = document.getElementById("sorting_by");
    
    if(result.value === "sorting_id"){
        $('#demo').collapse();
        document.getElementById("demo").style.visibility = "visible";
    }else{
        
        document.getElementById("demo").style.visibility = "hidden";
    }
   }
   
   