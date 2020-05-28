import React, {Component} from 'react';
import Container from '@material-ui/core/Container';
import { withStyles } from '@material-ui/core/styles';
import {connect} from 'react-redux';
import {bindActionCreators} from 'redux';
import {updateFav} from '../actions/AuthAction';
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

class PaymentResponse extends Component{

  state={
    
  }
  constructor(props) {
    super(props);

    this.state = {
      amount: '',
      password: '',
      weight: '',
      perfume: '',
      starch: '',
      
    };
  }



  render(){

 const handleSubmit =(e)=>{
      e.preventDefault();
     const data = {favperfume: this.state.perfume, favstarch: this.state.starch}
      this.props.updateFav(data);
      
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

           {
               this.props.pstatus.status=="success" ? (
                   <div>
                       <h1>Transaction Successful</h1>
  <p>Hi {this.props.pstatus.username} </p> 
<p>The laundry transaction you made  was successful,  transaction total ammount is {this.props.pstatus.totalprice}</p>
                   </div>
               ):(  <div>
                       <h1>Transaction Fail</h1>
  <p>Hi {this.props.pstatus.username} </p> 
<p>The laundry transaction you made was not successful,  transaction total ammount is {this.props.pstatus.totalprice}</p>
                   </div>)
           }
   

      </Container>

    </div>
  )};
}

const mapDispatchToProps = dispatch =>{
    return{
        ...bindActionCreators({
          updateFav
        },dispatch)
    }
}
const mapStateToProps = (state) =>{
    return{
        isAuthenticated: state.AuthReducer.isAuthenticated,
        user: state.AuthReducer.user,
        pstatus: state.LaundryReducer.payment_response,
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(withStyles(styles)(PaymentResponse));
