import {createAction} from 'redux-actions'
export const SET_LOGIN = 'SET_LOGIN';
export const SET_REG = 'SET_REG';
export const UPDATE_USER = 'UPDATE_USER';
export const UPDATE = 'UPDATE'
export const LOGOUT = 'LOGOUT';
export const RECIEVE_LOGOUT = 'RECIEVE_LOGOUT';
export const AUTH = 'AUTH';
export const SET_FAV = 'SET_FAV';
export const RECIEVE_FAV = 'RECIEVE_FAV';
export const SET_AUTHLOADER = 'SET_AUTHLOADER';
export const AUTH_LOADER = 'AUTH_LOADER'
export const CHECK_AUTH = 'CHECK_AUTH'
export const REFRESH_AUTH = 'REFRESH_AUTH'



export const refreshAuth = createAction(REFRESH_AUTH);
export const checkAuth = createAction(CHECK_AUTH);
export const loginUser = createAction(SET_LOGIN);
export const regUser = createAction(SET_REG);
export const updateUser = createAction(UPDATE_USER);
export const update = createAction(UPDATE);
export const Authentication = createAction(AUTH);
export const logoutUser = createAction(LOGOUT);
export const recieveLogout = createAction(RECIEVE_LOGOUT);
export const setFav = createAction(SET_FAV);
export const updateFav = createAction(RECIEVE_FAV);
export const setAuthLoader = createAction(SET_AUTHLOADER)
export const authLoader = createAction(AUTH_LOADER)