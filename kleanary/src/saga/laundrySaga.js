import {call,takeLatest,put} from 'redux-saga/effects'

import{
requestApi,


}from '../api/laundryApi';

import{
    REQUEST_LAUNDRY,
   

    getLaundry,
    requestLaundry,
    

}from '../actions/LaundryAction';

function* request(action){
  var  data = yield call(requestApi,action.payload);
  yield put(getLaundry(data));


}

export function* requestWatcher(){
    yield takeLatest(REQUEST_LAUNDRY,request)
}
//////////////////////////////////////////////////////////