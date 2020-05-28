 switch(action){
                    case "starch":
                    for (var j = 0; j >= starcharray.length; j++) {
                       if (starcharray[j]===filename) {
                       var starchv= document.getElementById(action+i);
                       starchv.style.borderColor="green";
                   }; 
                       break;
                       case "iron":
                        for (var j = 0; j >= starcharray.length; j++) {
                       if (starcharray[j]===filename) {
                       var starchv= document.getElementById(action+i);
                       starchv.style.borderColor="green";
                       }; 
                       break;
                       case "perfume":
                        for (var j = 0; j >= starcharray.length; j++) {
                       if (starcharray[j]===filename) {
                       var starchv= document.getElementById(action+i);
                       starchv.style.borderColor="green";
                       }; 
                       break;
                       default;

                       
                    

                }

function addto (action,filename,id) {
     var starchv= document.getElementById(id);

     switch(action){
                    case "starch":
                    for (var j = 0; j >= starcharray.length; j++) {
                       if (starcharray[j]===filename) {
                      
                       starcharray.splice(j,1);
                       starchv.style.borderColor="grey";
                       }else{
                        starcharray.puch(filename);
                         starchv.style.borderColor="green";
                       }
                       break;
                       case "iron":
                        for (var j = 0; j >= starcharray.length; j++) {
                       if (starcharray[j]===filename) {
                         
                       perfumearray.splice(j,1);
                       starchv.style.borderColor="grey";
                       }else{
                        perfumearray.puch(filename);
                         starchv.style.borderColor="green";
                       }
                       break;
                       case "perfume":
                        for (var j = 0; j >= starcharray.length; j++) {
                       if (starcharray[j]===filename) {
                        
                       ironarray.splice(j,1);
                       starchv.style.borderColor="grey";
                       }else{
                        ironarray.puch(filename);
                         starchv.style.borderColor="green";
                       }
                       break;
                       default;

                       }; 
    
}