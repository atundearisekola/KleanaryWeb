import React, {Component} from 'react';
import InputAdornment from '@material-ui/core/InputAdornment';
import TextField from '@material-ui/core/TextField';
import MenuItem from '@material-ui/core/MenuItem';
import Container from '@material-ui/core/Container';
import CssBaseline from '@material-ui/core/CssBaseline';
import clsx from 'clsx';
import { withStyles } from '@material-ui/core/styles';
import {connect} from 'react-redux';
import {bindActionCreators} from 'redux';
import {setFav} from '../actions/AuthAction';
import Jumbotron from 'react-bootstrap/Jumbotron'
import Col from 'react-bootstrap/Col'
import Form from 'react-bootstrap/Form'
import Button from 'react-bootstrap/Button'


import '../App.css';


const styles = (theme) => ({
  root: {
    display: 'flex',
    flexWrap: 'wrap',
  },
  margin: {
    margin: theme.spacing(1),
  },
  textField: {
    flexBasis: 200,
  },
});

class Favorite extends Component{

  state={
    
  }
  constructor(props) {
    super(props);

    this.state = {
     
      perfume: this.props.favperfume,
      starch: this.props.favstarch,
      
    };
  }



  render(){

 const handleSubmit =(e)=>{
      e.preventDefault();
       var ps = this.state.perfume.split('|');
      var perfname = ps[0];
      var perfprice = ps[1];
      const newp = {perfname: perfname, perfprice: perfprice};
      var ss = this.state.starch.split('|');
      var starchname = ss[0];
      var starchprice = ss[1];
      const news = {starchname: starchname, starchprice: starchprice}
     const data = {favperf: newp, favstarch: news}
      this.props.setFav(data);
      
    }

    const handleInput =(e)=>{
      e.preventDefault();
      const name = e.target.name;
      const value = e.target.value;
      this.setState({ [name]:value});
      console.log(this.state);
      
    }


    const { classes } = this.props;
  
   
  
  
  return (
    <div className={classes.root}>
       <Container component="main">
      <Jumbotron>
      <Form>
  <Form.Row>
  <Form.Group  as={Col} controlId="formGridState">
      <Form.Label>Select Perfume</Form.Label>
      <Form.Control
      className={clsx(classes.margin, classes.textField)}
        variant="outlined"
        label="Select Perfume"
        name="perfume"
        value={this.state.perfume}
        onChange={handleInput}
       as="select">
       
        {
          this.props.favperfume?(
            <option key={this.props.favperfume.perfname} value={this.props.favperfume.perfname+"|"+this.props.favperfume.perfprice}>
            {this.props.favperfume.perfname} &#8358;{ this.props.favperfume.perfprice}
          </option>
          ):("")
        }
         
        
        {this.props.perfumes.map(option => (
          <option key={option.perfname} value={option.perfname+"|"+option.perfprice}>
            {option.perfname} &#8358;{option.perfprice}
          </option>
        ))}
      </Form.Control>
    </Form.Group>

    <Form.Group   className={clsx(classes.margin, classes.textField)} as={Col} controlId="formGridState">
      <Form.Label>Select Starch</Form.Label>
      <Form.Control  name="starch" value={this.state.starch}  onChange={handleInput} as="select">
         {this.props.favstarch? (
          <option  key={this.props.favstarch.starchname} value={this.props.favstarch.starchname+"|"+this.props.favstarch.starchprice}>
            {this.props.favstarch.starchname} &#8358;{this.props.favstarch.starchprice}
          </option>
        ) : ("")}
        
        {this.props.starchs.map(option => (
          <option key={option.starchname} value={option.starchname+"|"+option.starchprice}>
            {option.starchname} &#8358;{option.starchprice}
          </option>
        ))}
      </Form.Control>
    </Form.Group>
  </Form.Row>

  <Button onClick={handleSubmit} variant="primary" type="submit">
    Submit
  </Button>

</Form>
   
</Jumbotron>
      </Container>

    </div>
  )};
}

const mapDispatchToProps = dispatch =>{
    return{
        ...bindActionCreators({
          setFav
        },dispatch)
    }
}
const mapStateToProps = (state) =>{
    return{
        isAuthenticated: state.AuthReducer.isAuthenticated,
         user: state.AuthReducer.user,
         perfumes: state.AuthReducer.perfumelist,
         starchs: state.AuthReducer.starchlist,
         favstarch: state.AuthReducer.user.favstarch,
         favperfume: state.AuthReducer.user.favperf,
         
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(withStyles(styles)(Favorite));
