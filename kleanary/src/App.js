import React, {Component} from 'react';

import './App.css';
//import NavBar from './components/NavBar.js';
import Header from './components/Header.js';
//import Drawer from './components/Drawer.js';
import Home from './components/Home';
import RequestLaundry from './components/RequestLaundry';
import Favorite from './components/Favorite';
import Account from './components/Account';
import LoginForm from './components/LoginForm';
import SignupForm from './components/SignupForm';
import Dashboard from './components/Dashboard';
import LaundryDetails from './components/LaundryDetails';
import Checkout from './components/Checkout';
import {BrowserRouter, Route, Switch} from 'react-router-dom';
import GuestRoute from './routes/GuestRoute';
import AuthRoute from './routes/AuthRoute';
import {checkAuth} from './actions/AuthAction'
import {bindActionCreators} from 'redux';
import {connect} from 'react-redux';
class App extends Component{

  componentDidMount(){
    this.props.checkAuth();

  }

  render(){

    
  return (
 
    <BrowserRouter>
    <div className="App">
  <Header />

<Switch>
  <Route exact path="/" component={Home}  />
  <AuthRoute path="/request" component={RequestLaundry}  />
  <AuthRoute path="/favorite" component={Favorite}  />
  <AuthRoute path="/account" component={Account}  />
  <GuestRoute path="/login" component={LoginForm}  />
  <GuestRoute path="/signup" component={SignupForm}  />
  <AuthRoute path="/dashboard" component={Dashboard}  />
   <AuthRoute path="/checkout" component={Checkout}  />
  <AuthRoute path="/:laundry_id" component={LaundryDetails}  />
  
</Switch>
  
 
     
    </div>
    </BrowserRouter>
  )};
}

const mapDispatchToProps = dispatch =>{
    return{
        ...bindActionCreators({
          checkAuth,
        },dispatch)
    }
}

const mapStateToProps = (state) =>{
    return{
        loader: state.AuthReducer.loader,
       
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(App);
