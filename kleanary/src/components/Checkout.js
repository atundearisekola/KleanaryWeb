import React, {Component} from 'react';

import { withStyles } from '@material-ui/core/styles';
import {connect} from 'react-redux';
import {bindActionCreators} from 'redux';
import {updateFav} from '../actions/AuthAction';
    //import the library
    import PaystackButton from 'react-paystack';




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

class Checkout extends Component{

  
  constructor(props) {
    super(props);

    this.state = {
      totalprice: this.props.request.data.totalprice,
      email: this.props.request.data.email,
      username: this.props.request.data.username,
      txref: this.props.request.data.txref,
      key: this.props.request.data.pkey,
      
    };
  }



  render(){

   const callback = (response) => {
    		console.log(response); // card charged successfully, get reference here
    	}

    const	close = () => {
    		console.log("Payment closed");
        }
        
     const   getReference = () => {
    		//you can put any unique reference implementation code here
    		let text = "";
        let possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-.=";

    		for( let i=0; i < 15; i++ )
    			text += possible.charAt(Math.floor(Math.random() * possible.length));

    		return text;
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
    

         
          <div>
            <br />
            <p>
              <PaystackButton
                text="Make Payment"
                className="payButton"
                callback={callback}
                close={close}
                disabled={false} 
                embed={false}
                reference={this.state.txref}
                email={this.state.email}
                amount={this.state.totalprice+".00"}
                paystackkey={this.state.key}
                tag="button"
              />
            </p>
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
          request: state.LaundryReducer.requestdetail,
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(withStyles(styles)(Checkout));
