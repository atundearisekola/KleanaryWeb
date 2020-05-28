<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Laundry;
use App\StarchList;
use App\PerfumeList;
use App\KleanaryList;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Paystack;
use Intervention\Image\ImageManagerStatic as Image;
class LaundryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function randStrGennosc($len)
{
    $result ="";
    $chars = "abcdefghijklmnpqrstuvwsyz01234567891111111";
    $charArray = str_split($chars);
    for ($i=0; $i < $len; $i++){ 
        $randItem = array_rand($charArray);
        $result .="".  $charArray[$randItem];
    }
    return $result;
}

      public function makerequest(Request $request)
    {
        $this->validate($request,[
           
            'addr'=>'required',
            'state'=>'required',
            'country'=>'required',
            'localgov'=>'required',
            'laundryimg.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048']);
        $laundry= new Laundry();
        
        /*
         $tshirtprice = 150;
    $trouserprice = 100;
    $bedshitprice = 200;
    $bagsprice = 200;
    $tieprice = 0;
    $towelprice = 100;
    $shoesprice = 200;
    */
    $ironprice = 150;
    $clothestotal=0;
    $len=20;
    $totalnum=0;
$txref = $this->randStrGennosc($len);
    $dtime= $txref.time();
    $data ="";
    

    
        $laundryimgs = $request->file('laundryimg');
        
error_log("image loging");
 if($request->hasfile('laundryimg'))
         {
            foreach($laundryimgs as $image)
            {
                
                $name=$dtime.$image->getClientOriginalName();

              // $image->storeAs('public/users/'.Auth::user()->id, $name);  
               // Storage::disk('public')->put('/users/'.Auth::user()->id.'/'.$name,File::get($image));
                 $path = public_path('images/users/'.Auth::user()->id.'/limage/'.$name);
 // Storage::disk('user_uploads')->put($path, File::get($image));
        
               Image::make($image->getRealPath())->resize(400, 400)->save($path);
              // Storage::disk('user_uploads')->put('/users/'.Auth::user()->id.'/'.$name, File::get($image));
                $data .= $name.',';  
            }
         }
         if($request['kleanaryin'] != "") {
        /*
        $laundry->tshirt = $request['tshirt'];
        $laundry->trouser = $request['trouser'];
        $laundry->bedshit = $request['bedshit'];
        $laundry->tie = $request['tie'];
        $laundry->shoes = $request['shoes'];
        $laundry->bags = $request['bags'];
        $laundry->towel = $request['towel'];
        */
        
       
           $favstarchs = $request['favstarch'];
        $favstarchs = explode(',', $favstarchs);
        $laundry->favstarch = $favstarchs[0];
        $starchprice = $favstarchs[1];
         $starlist = new StarchList();
         $starlist = $starlist->List();
        foreach ($starlist as $slist) {
            if ($slist['starchname']==$favstarchs[0]) {
            $starchprice = $slist['starchprice'];
            break;
        }
        }   
            
        $kleanaries = explode(',', $request['kleanaryin']);
        $newk ="";
        $klists = new KleanaryList();
        $klists= $klists->List();
        
        for ($i=0; $i <=count($kleanaries)-1; $i++) { 
           
            $kvalues= explode('zz',  $kleanaries[$i]);
            $kqty = $kvalues[1];
            $kvalue = explode('|', $kvalues[0]);
            $kname = $kvalue[0];
            $kprice = $kvalue[1];

            foreach ($klists as $klist) {
            if ($klist['kname']==$kname) {
            $kprice = $klist['kprice']+$starchprice;
            $totalnum = $totalnum+$kqty;

            $subtotal = $kprice*$kqty;
            $clothestotal = $clothestotal+$subtotal;

            $newk .= $kname."|".$kprice."zz".$kqty.",";
            break;
        }
        }


        }

         $laundry->kleanaryinput = $newk;
         
        }
        
        $favperfumes = $request['favperfume'];
        $favperfumes = explode(',', $favperfumes);
        $laundry->favperfume = $favperfumes[0];
        $perfumeprice = $favperfumes[1];
        $perflist = new PerfumeList();
        $perflist= $perflist->List();
        foreach ($perflist as $plist) {
            if ($plist['perfname']==$favperfumes[0]) {
            $perfumeprice = $plist['perfprice'];
            break;
        }
        }
        
      

        $starchinput = "";
        $starchinputs = $request['starchinput'];
        $starchinputs = explode(',', $starchinputs);
        $nstarch = count($starchinputs);
        for ($i=0; $i <=count($starchinputs)-1; $i++) { 
            $starchinput .= $dtime.$starchinputs[$i].",";

        }
        $laundry->todostarch = $starchinput; 
        
   

        $perfumeinput="";
        $perfumeinputs= $request['perfumeinput'];
        $perfumeinputs = explode(',', $perfumeinputs);
        $nperfume = count($perfumeinputs);
        for ($i=0; $i <= count($perfumeinputs)-1; $i++) { 
            $perfumeinput .= $dtime.$perfumeinputs[$i].",";

        }
        $laundry->todoperfume = $perfumeinput; 

        $ironinput="";
        $ironinputs = $request['ironinput'];
       

        $ironinputs = explode(',', $ironinputs);
        $niron = count($ironinputs);
        for ($i=0; $i <= count($ironinputs)-1; $i++) { 
            $ironinput .= $dtime.$ironinputs[$i].",";

        }
        $laundry->todoiron = $ironinput; 
        
      
        $laundry->paymentstatus = "n"; 
        $laundry->lstatus = "waiting"; 
        $laundry->txref = $txref; 

        $laundry->addr = $request['addr'];
        
        $laundry->country = $request['country'];
        $laundry->state = $request['state'];
        $laundry->localgov = $request['localgov'];
        $laundry->shortnote = $request['shortnote'];
/*
        $tshirtprice = $tshirtprice*$request['tshirt'];
    $trouserprice = $trouserprice*$request['trouser'];
    $bedshitprice = $bedshitprice*$request['bedshit'];
    $bagsprice = $bagsprice*$request['bags'];
    $tieprice = $tieprice*$request['tie'];
    $towelprice = $towelprice*$request['towel'];
    $shoesprice = $shoesprice*$request['shoes'];
    */
    $perfumeprice = $perfumeprice*$nperfume;
    $starchprice = $starchprice*$nstarch;
    $ironprice = $ironprice*$niron;
     $totalprice =  $clothestotal+$perfumeprice+$starchprice+$ironprice;
        $laundry->totalprice = $totalprice; 
        $laundry->laundryimg = $data; 
      
       $laundry->totalnum = $totalnum;
        $request->user()->laundries()->save($laundry);
        $username = Auth::user()->username;
        $email = Auth::user()->email;
        return Paystack::getAuthorizationUrl($totalprice."00",$txref,$email,$username)->redirectNow();

        
    }

    public function viewlaundry(Request $request)
    {
        $single = Laundry::where('id','=',$request['lid'])->first();
        $userid = $single['user_id'];
/*$tshirt = $single['tshirt'];
$trouser = $single['trouser'];
$bedshit = $single['bedshit'];
$tie = $single['tie'];
$shoes = $single['shoes'];
$bags = $single['bags'];
$towel = $single['towel'];
*/
$favperfume = $single['favperfume'];
$favstarch = $single['favstarch'];
$todostarch = $single['todostarch'];
$todoperfume= $single['todoperfume'];
$todoiron = $single['todoiron'];
 $addr = $single['addr'];
 $country = $single['country'];
 $state = $single['state'];
 $localgov = $single['localgov'];
  $totalprice = $single['totalprice'];
  $dtime = $single['created_at'];
  $status = $single['lstatus'];
   $shortnote = $single['shortnote'];
   $txref = $single['txref'];
   $limage = $single['laundryimg'];
   $kinput = $single['kleanaryinput'];
   if($kinput==""){$kinput = "empty";}


// return $tshirt.'|||'.$trouser.'|||'.$bedshit.'|||'.$tie.'|||'.$shoes.'|||'.$bags.'|||'.$towel.'|||'.$favperfume.'|||'.$favstarch.'|||'.$todostarch.'|||'.$todoperfume.'|||'.$todoiron.'|||'.$addr.'|||'.$country.'|||'.$state.'|||'.$localgov.'|||'.$totalprice.'|||'.$dtime.'|||'.$status.'|||'.$userid.'|||'.$shortnote;
        return response()->json(['limage'=>$limage,'createdat'=>$dtime,'favperfume'=>$favperfume,'favstarch'=>$favstarch,'todostarch'=>$todostarch,'todoperfume'=>$todoperfume,'todoiron'=>$todoiron,'addr'=>$addr,'country'=>$country,'state'=>$state,'localgov'=>$localgov,'totalprice'=>$totalprice,'lstatus'=>$status,'userid'=>$userid,'shortnote'=>$shortnote,'txref'=>$txref,'kinputs'=>$kinput],200);
    }



/*public function PerfumeList()
{
    $perfumelists = [

    '0'=>[
    'perfname'=>'421',
    'perfprice'=>'70'
    ],
    '1'=>[
    'perfname'=>'radel',
    'perfprice'=>'50'
    ],
    '2'=>[
    'perfname'=>'Masello',
    'perfprice'=>'100'
    ],
    '3'=>[
    'perfname'=>'Jagua',
    'perfprice'=>'70'
    ],


    ];
    return $perfumelists;
}
public function StarchList()
{
    $starchlists = [

    '0'=>[
    'starchname'=>'421',
    'starchprice'=>'70'
    ],
    '1'=>[
    'starchname'=>'radel',
    'starchprice'=>'50'
    ],
    '2'=>[
    'starchname'=>'Masello',
    'starchprice'=>'100'
    ],
    '3'=>[
    'starchname'=>'Jagua',
    'starchprice'=>'70'
    ],


    ];
    return $starchlists;
}
*/

public function laundryimage($filename)
{
    
        $file = Storage::url($filename);
       // return new Response($file,200);
        return Image::make(storage_path().$file)->response();
    
}


public function FunctionName(Type $var = null)
{
    

        $perfumeinput="";
        $perfumeinputs = $todoPerfume;
       
        $nperfume = count($perfumeinputs);
        for ($i=0; $i <=count($perfumeinputs)-1; $i++) { 
            $todo= $perfumeinputs[$i]['todo'];
          $filename= $dtime.$perfumeinputs[$i]['filename'];
           $url= $perfumeinputs[$i]['url'];
            $data = ['todo'=>$todo,'filename'=>$filename,'url'=>$url];
            $perfumeinput .= $data;
        }
      //  $laundry->todoperfume = $perfumeinput; 

        $ironinput="";
      $ironinputs = $todoIron;
        $niron = count($ironinputs);
        for ($i=0; $i <=count($ironinputs)-1; $i++) { 
            $todo= $ironinputs[$i]['todo'];
          $filename= $dtime.$ironinputs[$i]['filename'];
           $url= $ironinputs[$i]['url'];
            $data = ['todo'=>$todo,'filename'=>$filename,'url'=>$url];
            $ironinput .= $data;
        }
       // $laundry->todoiron = $ironinput; 


      //   $laundry->paymentstatus = "n"; 
      //  $laundry->lstatus = "waiting"; 
      //  $laundry->txref = $txref; 

       // $laundry->addr = $addr;
        
      //  $laundry->country = $country;
      //  $laundry->state = $state;
       // $laundry->localgov = $localgov;
       // $laundry->shortnote = 'shortnote';

        $perfumeprice = $perfumeprice*$nperfume;
        $starchprice = $starchprice*$nstarch;
        $ironprice = $ironprice*$niron;
        $totalprice =  $clothestotal+$perfumeprice+$starchprice+$ironprice;
       // $laundry->totalprice = $totalprice; 
      //  $laundry->laundryimg = $data; 
      
      //  $laundry->totalnum = $totalnum;
      //  $request->user()->laundries()->save($laundry);
      //  $username = Auth::user()->username;
      //  $email = Auth::user()->email;
       // return Paystack::getAuthorizationUrl($totalprice."00",$txref,$email,$username)->redirectNow();
}


}
