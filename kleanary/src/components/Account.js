import React, {Component} from 'react';
import { SideNav, Button,SideNavItem } from 'react-materialize';
import Card from '@material-ui/core/Card';
import CardContent from '@material-ui/core/CardContent';
import CardActions from '@material-ui/core/CardActions';
import { withStyles } from '@material-ui/core/styles';
import {connect} from 'react-redux';
import {bindActionCreators} from 'redux';
import {updateUser,setAuthLoader} from '../actions/AuthAction';
import CircularProgress from '@material-ui/core/CircularProgress';
import Form from 'react-bootstrap/Form';
import Col from 'react-bootstrap/Col'
import InputGroup from 'react-bootstrap/InputGroup'
import '../App.css';

//import Drawer from './components/Drawer.js';

const styles=(theme) => ({
 
 
});


class Account extends Component{

  constructor(props) {
    super(props);

    this.state = {
      activeStep:0,

      fname: this.props.user.fname,
      lname: this.props.user.lname,
      name: this.props.user.name,
      email: this.props.user.email,
      country: this.props.user.country,
      state: this.props.user.state,
      localgov: this.props.user.localgov,
       addr: this.props.user.addr,
      phone: this.props.user.phone,
      
    };
  }

  render(){

    const { classes } = this.props;

    const handleSubmit =(e)=>{
      e.preventDefault();
      this.props.setAuthLoader(true)
     const data = {
      
        fname:  this.state.fname,
      lname:  this.state.lname,
      name:  this.state.name,
      country:  this.state.country,
      state:  this.state.state,
      localgov:  this.state.localgov,
       addr: this.state.addr,
      phone:  this.state.phone,
    token:  this.props.token,}
      this.props.updateUser(data);
      console.log(this.props);
    }
    const handleInput =(e)=>{
      e.preventDefault();
      const name = e.target.name;
      const value = e.target.value;
      this.setState({ [name]:value});
      console.log(this.state);
      
    }

    
  return (
    <div className="body">
      <br />
     <div className="container body">
        <Card className={classes.card}>
      
     
      <CardContent>

        <Form>
  <Form.Row>
    <Form.Group as={Col} controlId="formGridEmail">
      <Form.Label>First Name</Form.Label>
      <Form.Control onChange={handleInput}  name="fname" value={this.state.fname} id="first_name" type="text" class="validate" placeholder="First Name" />
    </Form.Group>

    <Form.Group as={Col} controlId="formGridPassword">
      <Form.Label>Last Name</Form.Label>
      <Form.Control onChange={handleInput} id="last_name" name="lname" value={this.state.lname} type="text" class="validate" placeholder="Last Name" />
    </Form.Group>
  </Form.Row>

  <Form.Group controlId="formGridAddress1">
    <Form.Label>Username</Form.Label>
    <InputGroup>
     <InputGroup.Prepend>
                  <InputGroup.Text id="inputGroupPrepend">@</InputGroup.Text>
                </InputGroup.Prepend>
    <Form.Control onChange={handleInput}   id="name" name="name" value={this.state.name}  type="text" class="validate" placeholder="Username" />
    </InputGroup>
  </Form.Group>

  <Form.Row>
    <Form.Group as={Col} controlId="formGridEmail">
      <Form.Label>Email</Form.Label>
      <Form.Control disabled id="email" type="email" name="email" value={this.state.email} class="validate" placeholder="Enter email" />
    </Form.Group>

    <Form.Group as={Col} controlId="formGridPassword">
      <Form.Label>Phone Number</Form.Label>
      <Form.Control  placeholder="+234" onChange={handleInput} id="icon_telephone" name="phone" value={this.state.phone} type="number" class="validate" />
    </Form.Group>
  </Form.Row>

   <Form.Row>
    <Form.Group as={Col} controlId="formGridState">
      <Form.Label>Country</Form.Label>
      <Form.Control onChange={handleInput} as="select" name="country">
         <option value={this.state.country} selected>{this.state.country}</option>
        <option>Nigeria</option>
        
      </Form.Control>
    </Form.Group>

    <Form.Group as={Col} controlId="formGridState">
      <Form.Label>State</Form.Label>
      <Form.Control onChange={handleInput} name="state" as="select">
         <option value={this.state.state} selected>{this.state.state}</option>
        <option>Lagos</option>
        <option>...</option>
      </Form.Control>
    </Form.Group>

   <Form.Group as={Col} controlId="formGridState">
      <Form.Label>LGA</Form.Label>
      <Form.Control onChange={handleInput} name="localgov" as="select">
         <option value={this.state.localgov} selected>{this.state.localgov}</option>
        <option>Alimosho</option>
        <option>...</option>
      </Form.Control>
    </Form.Group>
  </Form.Row>

  <Form.Group controlId="formGridAddress1">
    <Form.Label>Address</Form.Label>
    <Form.Control onChange={handleInput}   name="addr" value={this.state.addr} type="text" class="validate" placeholder="1234 Main St" />
  </Form.Group>

  

  
   {
        this.props.loader?(
          <CircularProgress/>
        ):(
         <Button onClick={handleSubmit} variant="primary" type="submit">
    Update
  </Button>
        )
      }
</Form>
   

 </CardContent>
      <CardActions disableSpacing>
       
      </CardActions>
    
    </Card>
         
        </div>
        </div>
        

  )};
}

const mapDispatchToProps = dispatch =>{
     return{
        ...bindActionCreators({
          updateUser,
          setAuthLoader,
        },dispatch)
    }
}
const mapStateToProps = (state) =>{
    return{
        isAuthenticated: state.AuthReducer.isAuthenticated,
         user: state.AuthReducer.user,
         token: state.AuthReducer.access_token,
         loader: state.AuthReducer.loader,
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(withStyles(styles)(Account));
