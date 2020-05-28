import { handleAction, combineActions } from 'redux-actions';
import{
    SET_LOGIN,
    SET_REG,
    UPDATE_USER,
     UPDATE,
    RECIEVE_LOGOUT,
    AUTH,
    RECIEVE_FAV,
    AUTH_LOADER,
    REFRESH_AUTH,


    refreshAuth,
    Authentication,
    recieveLogout,
    updateFav,
    update,
    authLoader,

}from '../actions/AuthAction';


var defaultState = {

    isAuthenticated: false,
    user:{},
    error:[],
    data:[],
    response:"",
    access_token:[],
    loader:false,
    starchlist:'',
    perfumelist:'',
    klist:'',
    refresh:[],

   


};
    const AuthReducer = handleAction(
       
           combineActions( Authentication,recieveLogout,update,updateFav,authLoader,refreshAuth),
            
        
        {
       next(state, action){
        switch(action.type){

             case REFRESH_AUTH:
               console.log(action.payload)
            return {
                ...state,
                 user: action.payload.data.user, 
                 isAuthenticated: true,
                 loader:false,
            };
            break;

            case AUTH:
               
            return {
                ...state,  isAuthenticated: true,
                 user: action.payload.data.user, 
                 access_token: action.payload.data.token,
                  starchlist: action.payload.data.getLists.original.starchlists,
                  klists: action.payload.data.getLists.original.klists,
                  perfumelist: action.payload.data.getLists.original.perfumelists,
                 loader:false,
            };
            break;
             case RECIEVE_LOGOUT:
                localStorage.removeItem('state');
            return {
                ...state,  isAuthenticated: false,
                 user: {}, 
                 response:'',
                 access_token: "",
            };
            break;

            case UPDATE:
               
            return {
                ...state,   user: action.payload.data.user, 
                loader:false,
                  
                
            };
            break;
            case RECIEVE_FAV:
               
            return {
                ...state,
                  user: action.payload.data.user, 
                  loader:false,
                  
                
            };
            break;

            case AUTH_LOADER:
           
            return {
                ...state, loader:action.payload
            };
            break;


            default:
                return state;
            break;

        }
    },
    throw(state,action){

         switch(action.type){

            case AUTH:
               
            return {
                ...state,  isAuthenticated: false, error: action.payload,
                loader:false,
               
            };
            break;
             case RECIEVE_LOGOUT:
              
            return {
                ...state, error: action.payload,
               
                   isAuthenticated: false,
                 user: {}, 
                 response:'',
                 access_token: "",
                
            };
            break;

              case UPDATE:
              
            return {
                ...state, response: action.payload,    
                loader:false,
                
            };
            break;
             case RECIEVE_FAV:
              
            return {
                ...state, error: action.payload,    
                loader:false,
            };
            break;

             case REFRESH_AUTH:
               console.log(action.payload)
            return {
                ...state, refresh:action.payload,  isAuthenticated: false,
                
                 loader:false,
            };
            break;

            default:
                return state;
            break;

        }

    }
  },
  defaultState
    )
    
    export default AuthReducer;
    