import { stringify } from 'querystring';
import { loadState, saveState } from "../Utils/localstorage";
const axios = require('axios');
var cors = require('cors')

 
cors()

export  async function loginApi(data){
  
  return await axios.post('http://127.0.0.1:8000/api/login', stringify(data)
   
  )
  .then(function (response) {
    console.log(response)
    return response;
  })
  .catch(function (error) {
   console.log(error)
   return error;
  })
};

export  async function LogoutApi(){
   axios.defaults.headers.common["Authorization"] = `Bearer ${loadState().AuthReducer.access_token}`;
  return await axios.post('http://127.0.0.1:8000/api/logout' )
  .then(function (response) {
    console.log(response)
    return response;
  })
  .catch(function (error) {
   console.log(error)
   return error;
  })
};


export  async function registerApi(data){
  
  return await axios.post('http://127.0.0.1:8000/api/register', stringify(data)
   
  )
  .then(function (response) {
    console.log(response)
    return response;
  })
  .catch(function (error) {
   console.log(error)
   return error;
  })
};


export  async function updateApi(data){
  axios.defaults.headers.common["Authorization"] = `Bearer ${loadState().AuthReducer.access_token}`;
  console.log(data.token)
  return await axios.post('http://127.0.0.1:8000/api/updateuser', stringify(data)
  )
  .then(function (response) {
    console.log(response)
    return response;
  })
  .catch(function (error) {
   console.log(error)
   return error;
  })
};

export  async function favApi(data){
  axios.defaults.headers.common["Authorization"] = `Bearer ${loadState().AuthReducer.access_token}`;
  console.log(data)
  return await axios.post('http://127.0.0.1:8000/api/updatefav', data
  )
  .then(function (response) {
    console.log(response)
    return response;
  })
  .catch(function (error) {
   console.log(error)
   return error;
  })
};

export  async function authApi(){
  axios.defaults.headers.common["Authorization"] = `Bearer ${loadState().AuthReducer.access_token}`;
 
  return await axios.post('http://127.0.0.1:8000/api/auth')
  .then(function (response) {
    console.log(response)
    return response;
  })
  .catch(function (error) {
   console.log(error)
   return error;
  })
};