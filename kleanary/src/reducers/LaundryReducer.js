import { handleAction, combineActions } from 'redux-actions';
import{
   
    GET_LAUNDRY,
    GET_REQUESTD,
    LOADER,
    PAYSTACK,
    GET_PLAUNDRY,
    GET_DLAUNDRY,
   

   
   getLaundry,
   geRequestD,
   loader,
   payStack,
   getDLaundry,
   getPLaundry,
   
   
}from '../actions/LaundryAction';
 let initState = {
     loader:false,
     paymentstatus:[],
    laundries:{},
    singleLaundry:{},
    pendinglaundries:[],
    deliveredlaundries:[],

    klaundries:[
         { kname:'White-Shirt',  kprice: '170',},
    {kname:'Colour-Shirt', kprice:'120',},
    { kname:'Trouser', kprice:'120',},
    { kname:'Shorts', kprice: '120',},
    { kname:'Native',kprice:'370',},
    {kname:'Bags', kprice:'400',},
    {kname:'Blazer', kprice:'370',},
    {kname:'Bedshit',kprice:'500',},
    {kname:'Culton', kprice:'500',},
    {kname:'Shoes',kprice:'400',},
   
    ],
    requestdetail:[],



}    
    const LaundryReducer =handleAction(
       
           combineActions( getLaundry,geRequestD,loader,payStack,getDLaundry,getPLaundry),
            
        
        {
       next(state, action){
        switch(action.type){

            case GET_LAUNDRY:
               
            console.log(action.payload)
            return {
                ...state, singleLaundry:action.payload.data,
                loader:false,
            };
            break;

            case GET_REQUESTD:
               
            console.log(action.payload)
            return {
                ...state, requestdetail:action.payload,
                loader:false,
            };
            break;

            case LOADER:
            
            return {
                ...state, loader:action.payload
            };
            break;

            case PAYSTACK:
            
            return {
                ...state, payment_response:action.payload,
                 loader:false,
            };
            break;

             case GET_PLAUNDRY:
            return {
                ...state, pendinglaundries:action.payload,
                loader:false,
            };
            break;

            case GET_DLAUNDRY:
            return {
                ...state, deliveredlaundries:action.payload,
                loader:false,
            };
            break;
            


            default:
                return state;
            break;

        }
    },
    throw(state,action){

         switch(action.type){

            case GET_LAUNDRY:
               
            return {
                ...state, error:action.payload,
                loader:false,
                
            };
            break;

             case GET_REQUESTD:
               
            return {
                ...state, error:action.payload,
                loader:false,
                
            };
            break;
            case PAYSTACK:
            
            return {
                ...state, payment_response:action.payload,
                 loader:false,
            };
            break;

             case GET_PLAUNDRY:
            return {
                ...state, error:action.payload,
                loader:false,
            };
            break;

            case GET_DLAUNDRY:
            return {
                ...state, error:action.payload,
                loader:false,
            };
            break;
            

            default:
                return state;
            break;

        }

    }
  },
  initState
    )
    
    export default LaundryReducer;