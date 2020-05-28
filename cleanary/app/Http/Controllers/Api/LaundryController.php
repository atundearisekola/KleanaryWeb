<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
         
        $klist = $request->input('klist');
        $laundryimg = $request->input('laundryimg');
        $imgSrc = $request->input('imgSrc');
        $todoIron = $request->input('todoIron');
        $todoHang = $request->input('todoHang');
        $todoPerfume = $request->input('todoPerfume');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $country = $request->input('country');
        $state = $request->input('state');
        $localgov = $request->input('localgov');
        $addr = $request->input('addr');
        $favperfume = $request->input('favperfume');
        $favstarch = $request->input('favstarch');
        $pickupDate = $request->input('pickupDate');
        $deliveryDate = $request->input('deliveryDate');
        $shortNote = $request->input('shortNote');

        $laundry= new Laundry();

         $ironprice = 150;
         $clothestotal=0;
         $len=20;
         $totalnum=0;
         $txref = $this->randStrGennosc($len);
         $dtime = $txref.time();
         $img ="";


          for ($i=0; $i < count($imgSrc)-1; $i++) {

              $image= $imgSrc[$i]['url'];
              $fl= $imgSrc[$i]['filename'];
              $name=$dtime.$fl;
              $path = public_path('images/users/'.Auth::user()->id.'/limage/'.$name);
              Image::make($image)->resize(400, 400)->save($path);
             
               $img .= json_encode(['filename'=>$name]).',';
          }

           if($klist != "") {

             $favstarchs = $favstarch;
      //  $favstarchs = explode('|', $favstarchs);
        $laundry->favstarch = 'stan';//$favstarchs[0];
        $starchprice = 50; //$favstarchs[1];
         $starlist = new StarchList();
         $starlist = $starlist->List();
        foreach ($starlist as $slist) {
            if ($slist['starchname']=='stan') {
            $starchprice = 50;//$slist['starchprice'];
            break;
        }
        } 
        
        $newk ="";
        $klists = new KleanaryList();
        $klists= $klists->List();
        
       for ($i=0; $i < count($klist)-1; $i++) { 
          $kname= $klist[$i]['kname'];
          $kprice= $klist[$i]['kprice'];
           $kqty= $klist[$i]['qty'];
          

            foreach ($klists as $klis) {
            if ($klis['kname']==$kname) {
            $kprice = $klis['kprice']+$starchprice;
            $totalnum = $totalnum+$kqty;

            $subtotal = $kprice*$kqty;
            $clothestotal = $clothestotal+$subtotal;
            $data= ['kname'=>$kname,'kprice'=>$kprice,'qty'=>$kqty];

            $newk .= json_encode($data).',';
          
            
            
            break;
        }
        }
        
        }

         $laundry->kleanaryinput =[$newk];
         
        }

         
        $favperfumes = $favperfume;
      //  $favperfumes = explode('|', $favperfumes);
        $laundry->favperfume ='gon';// $favperfumes[0];
        $perfumeprice =50;// $favperfumes[1];
        $perflist = new PerfumeList();
        $perflist= $perflist->List();
        foreach ($perflist as $plist) {
            if ($plist['perfname']=='gon') {
            $perfumeprice =50; // $plist['perfprice'];
            break;
        }
        }
        
      

        $starchinput = "";
        $starchinputs = $todoHang;
       
        $nstarch = count($starchinputs);
        for ($i=0; $i <=count($starchinputs)-1; $i++) { 
            $todo= $starchinputs[$i]['todo'];
          $filename= $dtime.$starchinputs[$i]['filename'];
           $url= $starchinputs[$i]['url'];
            $data = ['todo'=>$todo,'filename'=>$filename,];
            $starchinput .= json_encode($data).',';

        }
          $laundry->todostarch =  $starchinput; 

         $perfumeinput="";
        $perfumeinputs = $todoPerfume;
       
        $nperfume = count($perfumeinputs);
        for ($i=0; $i <=count($perfumeinputs)-1; $i++) { 
            $todo= $perfumeinputs[$i]['todo'];
          $filename= $dtime.$perfumeinputs[$i]['filename'];
           $url= $perfumeinputs[$i]['url'];
            $data = ['todo'=>$todo,'filename'=>$filename,];
            $perfumeinput .= json_encode($data).',';
        }
          $laundry->todoperfume = $perfumeinput; 

        $ironinput="";
      $ironinputs = $todoIron;
        $niron = count($ironinputs);
        for ($i=0; $i <=count($ironinputs)-1; $i++) { 
            $todo= $ironinputs[$i]['todo'];
          $filename= $dtime.$ironinputs[$i]['filename'];
           $url= $ironinputs[$i]['url'];
            $data = ['todo'=>$todo,'filename'=>$filename,];
            $ironinput .= json_encode($data).',';
        }
        $laundry->todoiron = $ironinput; 


           $laundry->paymentstatus = "n"; 
           $laundry->lstatus = "waiting"; 
           $laundry->txref = $txref; 

           $laundry->addr = $addr;
        
          $laundry->country = $country;
          $laundry->state = $state;
          $laundry->localgov = "hhhh";
          $laundry->shortnote = $shortNote;

        $perfumeprice = $perfumeprice*$nperfume;
        $starchprice = $starchprice*$nstarch;
        $ironprice = $ironprice*$niron;
        $totalprice =  $clothestotal+$perfumeprice+$starchprice+$ironprice;
        $laundry->totalprice = $totalprice; 
        $laundry->laundryimg = $img; 
      
        $laundry->totalnum = $totalnum;
        $request->user()->laundries()->save($laundry);
        $username = Auth::user()->username;
        $email = Auth::user()->email;
        //return Paystack::getAuthorizationUrl($totalprice."00",$txref,$email,$username)->redirectNow();
        return response()->json(['totalprice'=>$totalprice."00",'txref'=>$txref,'email'=>$email,'username'=>$username,'pkey'=>'pk_test_2fc262695039b96d69e55bb57482b4ef532b5437'],200);
        
  
 
      
        
    }

    public function RequestPLaundry()
    {
         $pls = Laundry::where([['user_id',Auth::user()->id],['lstatus','!=','Delivered']])->orderBy('created_at', 'DESC')->simplePaginate(10);
         return response()->json(['plaundry'=>$pls],200);

    }

    public function RequestDLaundry()
    {
       $lhs = Laundry::where([['user_id',Auth::user()->id],['lstatus','=','Delivered']])->orderBy('created_at', 'DESC')->simplePaginate(10);
        return response()->json(['dlaundry'=>$lhs],200);
    }

    public function viewlaundry(Request $request)
    {
        $single = Laundry::where('id','=',$request['id'])->first();
        $userid = $single['user_id'];

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
        //return response()->json(["laundry"=>$single],200);
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

}
