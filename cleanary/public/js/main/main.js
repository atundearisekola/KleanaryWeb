
function vlaundry (id) {
  
  var ajax = ajaxObj("POST", url);
  ajax.onreadystatechange = function() {
    if(ajaxReturn(ajax) == true) {
     
      var datArray = JSON.parse(ajax.responseText);
      
      /*
        var tshirt =  datArray['tshirt'];
        var trouser = datArray['trouser'];
        var bedshit = datArray['bedshit'];
        var tie = datArray['tie'];
        var shoes = datArray['shoes'];
        var bags = datArray['bags'];
        var towel = datArray['towel'];
        */
        var favstarch = datArray['favstarch'];
        var favperfume = datArray['favperfume'];
        var todostarch = datArray['todostarch'];
        var todoperfume = datArray['todoperfume'];
        var todoiron = datArray['todoiron'];
        var addr = datArray['addr'];
        var state = datArray['state'];
        var country = datArray['country'];
        var localgov = datArray['localgov'];
        var totalprice = datArray['totalprice'];
        var lstatus = datArray['lstatus'];
        var createdat = datArray['createdat']['date'];
        var user = datArray['userid'];
        var shortnote = datArray['shortnote'];
        var txref = datArray['txref'];
        var limage = datArray['limage'];
        
          var kinputs = datArray['kinputs'];

        ktotal=0;
  var kv= document.getElementById("singlekv");
  kv.innerHTML="";
  
   if (kinputs !="empty") {

    var kleanaries = kinputs.split(',');
                    for (var j = 0; j <= kleanaries.length-1; j++) {
                     var ks= kleanaries[j].split("zz")
                       var kqty = ks[1];
                       var kvalue = ks[0].split('|');
                       kname = kvalue[0];
                       kprice = kvalue[1];
                       var subtotal = kprice*kqty;
                       ktotal = ktotal+subtotal;
                       if(kname !=""){

                    
                        kv.innerHTML+="<tr><td>"+kname+"</td><td>"+kprice+"</td><td>"+kqty+"</td><td>"+subtotal+"</td></tr>";
                       }
                       
                       
                      }
                       
                   }

        /*

        var datArray = ajax.responseText.split("|||");
      
        var tshirt =  datArray[0];
        var trouser = datArray[1];
        var bedshit = datArray[2];
        var tie = datArray[3]
        var shoes = datArray[4];
        var bags = datArray[5];
        var towel = datArray[6];
        var favstarch = datArray[7];
        var favperfume = datArray[8];
        var todostarch = datArray[9];
        var todoperfume = datArray[10];
        var todoiron = datArray[11];
        var addr = datArray[12];
        var state = datArray[13];
        var country = datArray[14];
        var localgov = datArray[15];
        var totalprice = datArray[16];
        var lstatus = datArray[17];
        var createdat = datArray[18];
        var user = datArray[19];
        var shortnote = datArray[20];

         */
/*
         document.getElementById('tshirtv').innerHTML=tshirt;
         document.getElementById('trouserv').innerHTML=trouser;
         document.getElementById('bedshitv').innerHTML=bedshit;
         document.getElementById('tiev').innerHTML=tie;
         document.getElementById('shoesv').innerHTML=shoes;
         document.getElementById('bagsv').innerHTML=bags;
         document.getElementById('towelv').innerHTML=towel;
         */
         document.getElementById('favstarchv').innerHTML=favstarch;
         document.getElementById('favperfumev').innerHTML=favperfume;
         document.getElementById('addrv').innerHTML=addr;
         document.getElementById('statev').innerHTML=state;
         document.getElementById('countryv').innerHTML=country;
         document.getElementById('localgovv').innerHTML=localgov;
         document.getElementById('totalpricev').innerHTML=totalprice;
         document.getElementById('lstatusv').innerHTML=lstatus;
         document.getElementById('createdatv').innerHTML=createdat;
         document.getElementById('shortnotev').innerHTML=shortnote;
        document.getElementById('txrefv').innerHTML=txref;

       

         document.getElementById('todobtnv').innerHTML='<a href="javascript:void(0)" id="ironbtn" class="btn btn-primary" onclick="showGallary(\''+user+'\',\''+limage+'\')">All Image</a>';
  document.getElementById('todobtnv').innerHTML+='<a href="javascript:void(0)" id="starchbtn" class="btn btn-primary" onclick="showGallary(\''+user+'\',\''+todostarch+'\')">Starch</a>';
 document.getElementById('todobtnv').innerHTML+='<a href="javascript:void(0)" id="perfumebtn" class="btn btn-primary" onclick="showGallary(\''+user+'\',\''+todoperfume+'\')">Perfume</a>';
 document.getElementById('todobtnv').innerHTML+='<a href="javascript:void(0)" id="ironbtn" class="btn btn-primary" onclick="showGallary(\''+user+'\',\''+todoiron+'\')">Iron</a>';

  $('#viewlaundry').modal();
    }
  }
  ajax.send("lid="+id+"&_token="+token);

}


function ajaxObj(meth, url) {
    var x = new XMLHttpRequest();
    x.open(meth, url, true);
    x.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    return x;
}

function ajaxReturn(x) {
    if (x.readyState ==4 && x.status == 200) {
        return true;
    }
}

    function _(x) {
    return document.getElementById(x);
}

    

function initMap() {
      var geocoder;
  var map;
       var address = document.getElementById('addr').value;
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(-34.397, 150.644);
    var mapOptions = {
      zoom: 8,
      center: latlng
    }
    map = new google.maps.Map(document.getElementById('map'), mapOptions);
    document.getElementById('addr').addEventListener('click', function() {
          geocodeAddress(address, geocoder);
    });


  }
function geocodeAddress(address,geocoder) {
   
    var state = _("state");
    var country = _("country");
       
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == 'OK') {
        map.setCenter(results[0].geometry.location);
        state.innerHTML=results[0].address_components[1].long_name;
        country.innerHTML=results[0].address_components[2].long_name;
        var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location
        });
      } else {
        alert('Geocode was not successful for the following reason: ' + status);
      }
    });
  }


  var starcharray = new Array();
var perfumearray = new Array();
var ironarray = new Array();
var karray = new Array();
var ktotal = 0;
var starchprice;

 function preview(action) {
    var fileUpload = document.getElementById("laundryimg");
   
        if (typeof (FileReader) != "undefined") {
            var dvstarch = document.getElementById("starch");
            var dvperfume = document.getElementById("perfume");
            var dviron = document.getElementById("iron");
            var dvPreview=document.getElementById("preview");
               var btnstarch = document.getElementById("starchbtn");
            var btnperfume = document.getElementById("perfumebtn");
            var btniron = document.getElementById("ironbtn");
            var mainst =  document.getElementById("mainst");
            dvPreview.innerHTML ="";
            var mainper =  document.getElementById("mainper");
            var mainiron =  document.getElementById("mainiron");
            
            var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
            
            if (fileUpload.files.length > 0) {
                var img ="";
                var singleimg
              
                for (var i = 0; i <= fileUpload.files.length-1; i++) {
                var file = fileUpload.files[i];
                if (regex.test(file.name.toLowerCase())) {
                    
                       

                     
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        var filename = e.target.fileName;
                        img = '<img  height = "100" width = "100" title="'+e.target.fileName+'" src="'+e.target.result+'" />';
                         singleimg = '<a href="javascript:void(0)" class="imgdiv btn btn-default"  id="'+action+e.target.result+'"  onclick="addto(\''+action+'\',\''+filename+'\',\''+action+e.target.result+'\')">'+img+'</a>';
                          switch(action){
                    case "starch":
                    btnstarch.style.display="none";
                    mainst.style.display="block";
                    dvstarch.innerHTML+=singleimg;
                    
                       break;
                       case "iron":
                       btniron.style.display="none";
                    mainiron.style.display="block";
                    dviron.innerHTML+=singleimg;
                       
                       break;
                       case "perfume":
                       btnperfume.style.display="none";
                    mainper.style.display="block";
                    dvperfume.innerHTML+=singleimg;
                       
                       break;
                       default:;

                }
                    }
                   reader.fileName = file.name;
                     reader.readAsDataURL(file);

                   

                   
                   
                     
                } else {
                    alert(file.name + " is not a valid image file.");
                    dvPreview.innerHTML = "";
                    return false;
                }
            }
            }else{dvPreview.innerHTML = "Upload image first. ";}
           
        } else {
            alert("This browser does not support HTML5 FileReader.");
        }
    
};

function addto (action,filename,id) {
     var starchv= document.getElementById(id);

     switch(action){
                    case "starch":
                    var inarray= 0;
                    if (starcharray.length > 0) {
                    for (var j = 0; j <= starcharray.length-1; j++) {
                       if (starcharray[j]===filename) {
                      
                       starcharray.splice(j,1);
                       starchv.style.borderColor="grey";
                       inarray=1;
                       break;
                       }else{
                        inarray=2;
                       
                       }}
                       if (inarray==2) {
                        starcharray.push(filename);
                         starchv.style.borderColor="green";
                     };
                   }else{
                        starcharray.push(filename);
                         starchv.style.borderColor="green";
                     }
                       break;
                       case "iron":
                       var inarray= 0;
                        if (ironarray.length > 0) {
                    for (var j = 0; j <= ironarray.length-1; j++) {
                       if (ironarray[j]===filename) {
                       ironarray.splice(j,1);
                       starchv.style.borderColor="grey";
                        inarray=1;
                        break;
                       }else{
                         inarray=2;
                       
                       }}
                       if (inarray==2) {
                        ironarray.push(filename);
                         starchv.style.borderColor="green";
                     };
                   }else{
                        ironarray.push(filename);
                         starchv.style.borderColor="green";
                     }
                       break;
                       case "perfume":
                       var inarray= 0;
                         if (perfumearray.length > 0) {
                    for (var j = 0; j <= perfumearray.length-1; j++) {
                       if (perfumearray[j]===filename) {
                       perfumearray.splice(j,1);
                       starchv.style.borderColor="grey";
                       inarray= 1;
                       break;
                       }else{
                        inarray= 2;

                       }}
                       if (inarray==2) {
                        perfumearray.push(filename);
                         starchv.style.borderColor="green";
                     };}else{
                        perfumearray.push(filename);
                         starchv.style.borderColor="green";
                     }
                       break;
                       default:;

                       }; 
    
}

function ShowHide (id, btn) {
    var view =  document.getElementById(id);
    var vbtn =  document.getElementById(btn);
    if (view.style.display=="block") {
        view.style.display="none";
        vbtn.innerHTML="Show";
    }else{
        view.style.display="block";
        vbtn.innerHTML="Hide";
    }
}
function revertdone() {
     var doneb = document.getElementById('doneball');
    var reqdiv =  document.getElementById("reqdiv");
    doneb.style.display='block';
    reqdiv.style.display='none';
   
}
function DoneBall () {
    var doneb = document.getElementById('doneball');
    var summary =  document.getElementById('summary');
    var reqdiv =  document.getElementById('reqdiv');

    doneb.style.display='none';
    reqdiv.style.display='block';
    var starchinput =  document.getElementById('starchinput');
var perfumeinput= document.getElementById('perfumeinput');
var ironinput = document.getElementById('ironinput');
var kleanaryinput = document.getElementById('kleanaryinput');

starchinput.value=starcharray.join();
perfumeinput.value=perfumearray.join();
ironinput.value=ironarray.join();
kleanaryinput.value=karray.join();

    var tshirtprice = 150;
    var trouserprice = 100;
    var bedshitprice = 200;
    var bagsprice = 200;
    var tieprice = 0;
    var towelprice = 100;
    var shoesprice = 200;
    var ironprice = 150;

    nstarch = starcharray.length;
    niron = ironarray.length;
    nperfume = perfumearray.length;

    var favstarchs =  document.getElementById('favstarch').value;
    var favperfumes =   document.getElementById('favperfume').value;
    favstarchs = favstarchs.split(',');
    starchname = favstarchs[0];
    starchprice = favstarchs[1];
    favperfumes = favperfumes.split(',');
    perfumename = favperfumes[0];
    perfumeprice = favperfumes[1];

    
/*
    
    var shirts=  document.getElementById('tshirt').value;
    var trousers =  document.getElementById('trouser').value;
    var bedshit =  document.getElementById('bedshit').value;
    var bags =  document.getElementById('bags').value;
    var tie =  document.getElementById('tie').value;
    var towel =  document.getElementById('towel').value;
    var shoes =  document.getElementById('shoes').value;

     var sshirt=  document.getElementById('statustshirt');
    var strouser =  document.getElementById('statustrouser');
    var sbedshit =  document.getElementById('statusbedshit');
    var sbags =  document.getElementById('statusbags');
    var stie =  document.getElementById('statustie');
    var stowel =  document.getElementById('statustowel');
    var sshoes =  document.getElementById('statusshoes');
   

    tshirtprice = tshirtprice*shirts;
    trouserprice = trouserprice*trousers;
    bedshitprice = bedshitprice*bedshit;
    bagsprice = bagsprice*bags;
    if (tie >= 5) {
      tieprice = 50;
      tieprice = tieprice*tie;
    };
    
    towelprice = towelprice*towel;
    shoesprice = shoesprice*shoes;
     */
     
    perfumeprice = perfumeprice*nperfume;
    //starchprice = starchprice*nstarch;
    ironprice = ironprice*niron;
    var totalprice =  ktotal+perfumeprice+ironprice;

/*
    sshirt.innerHTML='<div class="alert alert-success"> Subtotal: '+tshirtprice+'</div>';
    strouser.innerHTML='<div class="alert alert-success"> Subtotal: '+trouserprice+'</div>';
    sbedshit.innerHTML='<div class="alert alert-success"> Subtotal: '+bedshitprice+'</div>';
    sbags.innerHTML='<div class="alert alert-success"> Subtotal: '+bagsprice+'</div>';
    stie.innerHTML='<div class="alert alert-success"> Subtotal: '+tieprice+'</div>';
    stowel.innerHTML='<div class="alert alert-success"> Subtotal: '+towelprice+'</div>';
    sshoes.innerHTML='<div class="alert alert-success"> Subtotal: '+shoesprice+'</div>';
    */
    
   summary.innerHTML='<dl class="list-group"><dt class="list-group-item active">Summary</dt><dt class="list-group-item alert alert-danger alert-dismissable"><p>Total Clothes to <span class="text-primary">iron </span> <span class="badge">'+niron+'</span> - Total price <span class="badge">&#8358;'+ironprice+'</span></p></dt>';
    summary.innerHTML+='<dt class="list-group-item  alert alert-success alert-dismissable"><p> <span class="text">Favorite perfume</span>  <span class="label label-info">'+perfumename+'</span> Total Clothes to add <span class="text">perfume</span> <span class="badge">'+nperfume+'</span> - Total price <span class="badge">&#8358;'+perfumeprice+'</span></p></dt>';
    summary.innerHTML+='<dt class="list-group-item alert alert-warning alert-dismissable"><p><span class="text-muted">Favorite starch</span>  <span class="label label-info">'+starchname+'</span> Total Clothes to add <span class="text-muted">starch</span> <span class="badge">'+nstarch+'</span> - Total price <span class="badge">&#8358;'+starchprice+'</span></p></dt>';
    summary.innerHTML+='<dt class="list-group-item alert alert-danger alert-dismissable"><p>Total laundry price  <span class="badge">&#8358;'+totalprice+'</span></p></dt></dl>';
     summary.innerHTML+='<textarea id="shortnote" name="shortnote" class="form-control" placeholder="Short Note"></textarea>'; 
    summary.innerHTML+='<div class="input-field"><input type="text" class="datepicker" id="date" name="datepicker"> <label for="date">Choose a Date</label> </div>';
    summary.innerHTML+='<div><input type="text" class="timepicker" id="time" name="timepicker"><label for="time">Choose a Time</label></div>';
    summary.innerHTML+='<input type="submit"  class="btn btn-block btn-info" value="Make Request">'; 

    

}
 

function showGallary(uid,gallary){
   
    
    document.getElementById('tododisplay').innerHTML='loading photos ....';
     document.getElementById('tododisplay').style.display="block";
     if (gallary !="") {
      gallary= gallary.split(',');
      document.getElementById('tododisplay').innerHTML=' ';
     

      for (var i = 0; i < gallary.length-1; i++) {
        var file = 'images/users/users/'+uid+'/'+gallary[i];
         
      document.getElementById('tododisplay').innerHTML += '<img  height="100" width="100" title="'+gallary[i]+'" src="http://kleanary.aubics.tk/'+file+'" />';
      };
      

     };
         
}


function AddtoKleanary () {
     
     var kvalue= document.getElementById("kvalue").value;
     var kqty= document.getElementById("kqty").value;
     if (kqty !=0 && kqty !="" && kvalue!="") {
     var inputvalue = kvalue+"zz"+kqty;

     var kvalues =kvalue.split("|");
     var kname = kvalues[0];
     var kprice = kvalues[1];
     var subtotal = kprice*kqty;


                   
                    var inarray= 0;
                    if (karray.length > 0) {
                    for (var j = 0; j <= karray.length-1; j++) {
                     var namev= karray[j].split("zz")
                       if (namev[0]===kvalue) {
                      
                       karray.splice(j,1);
                        karray.push(inputvalue);
                        DisplayKleanary();
                       
                       inarray=1;
                       break;
                       }else{
                        inarray=2;
                       
                       }}
                       if (inarray==2) {
                        karray.push(inputvalue);
                        DisplayKleanary();
                     };
                   }else{
                        karray.push(inputvalue);
                        DisplayKleanary();
                     }

                   };
          
              }
function DisplayKleanary () {
  ktotal=0;
  var kv= document.getElementById("kv");
  kv.innerHTML="";
  var kleanaries = karray.join().split(',');
   if (karray.length > 0) {
                    for (var j = 0; j <= karray.length-1; j++) {
                     var ks= karray[j].split("zz")
                       var kqty = ks[1];
                       var kvalue = ks[0].split('|');
                       kname = kvalue[0];
                       kprice = kvalue[1];
                       var subtotal = kprice*kqty;
                       ktotal = ktotal+subtotal;

                    
                        kv.innerHTML+="<tr><td>"+kname+"</td><td>"+kprice+"</td><td>"+kqty+"</td><td>"+subtotal+"</td><td><a href='javascript:void(0)' onclick='RemoveK(\""+ks[0]+"\")'><i class='fa fa-trash' aria-hidden='true'></i></button></td></tr>";
                       
                       
                      }
                       
                   }

}

function RemoveK (kvalue) {

   if (karray.length > 0) {
                    for (var j = 0; j <= karray.length-1; j++) {
                     var namev= karray[j].split("zz")
                       if (namev[0]===kvalue) {
                      
                       karray.splice(j,1);
                        
                        DisplayKleanary();
                       
                       
                       };}
                       
                   }
  
}


function JustDisplay (kinput) {
 
  var ktotal = 0;
   var kv= document.getElementById("kv");
  kv.innerHTML="";
   if (kinput != "") {
  var kleanaries = kinput.split(',');
  
                    for (var j = 0; j <= kleanaries.length-1; j++) {
                     var ks= kleanaries[j].split("zz")
                       var kqty = ks[1];
                       var kvalue = ks[0].split('|');
                       kname = kvalue[0];
                       kprice = kvalue[1];
                       var subtotal = kprice*kqty;
                       ktotal = ktotal+subtotal;

                    
                        kv.innerHTML+="<tr><td>"+kname+"</td><td>"+kprice+"</td><td>"+kqty+"</td><td>"+subtotal+"</td></tr>";
                       
                       
                      }
                       
                   }
}


 

