import {createAction} from 'redux-actions';

export const REQUEST_LAUNDRY = 'REQUEST_LAUNDRY';
export const GET_REQUESTD = 'GET_REQUESTD';
export const GET_LAUNDRY = 'GET_LAUNDRY';
export const REQUEST_DETAIL = 'REQUEST_DETAIL'
export const REQUEST_PLAUNDRY = 'REQUEST_PLAUNDRY';
export const GET_PLAUNDRY = 'GET_PLAUNDRY';
export const REQUEST_DLAUNDRY = 'REQUEST_DLAUNDRY';
export const GET_DLAUNDRY = 'GET_DLAUNDRY';
export const SET_LOADER = 'SET_LOADER';
export const LOADER = 'LOADER';
export const VERIFY_STACK = 'VERIFY_STACK';
export const PAYSTACK = 'PAYSTACK';


export const geRequestD = createAction(GET_REQUESTD)
export const getLaundry = createAction(GET_LAUNDRY)
export const requestDetail = createAction(REQUEST_DETAIL)
export const requestLaundry = createAction(REQUEST_LAUNDRY)
export const getPLaundry = createAction(GET_PLAUNDRY)
export const requestPLaundry = createAction(REQUEST_PLAUNDRY)
export const getDLaundry = createAction(GET_DLAUNDRY)
export const requestDLaundry = createAction(REQUEST_DLAUNDRY)
export const setLoader = createAction(SET_LOADER)
export const loader = createAction(LOADER)
export const verifyStack = createAction(VERIFY_STACK)
export const payStack = createAction(PAYSTACK)