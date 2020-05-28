import {combineReducers} from 'redux';
import AuthReducer from './AuthReducer';
import LaundryReducer from './LaundryReducer'



const RootReducer = combineReducers({AuthReducer,LaundryReducer})

export default RootReducer;
