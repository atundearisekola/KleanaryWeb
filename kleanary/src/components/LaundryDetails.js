import React, {Component} from 'react';
import { withStyles } from '@material-ui/core/styles';

import Button from '@material-ui/core/Button';

import clsx from 'clsx';

import Card from '@material-ui/core/Card';
import CardHeader from '@material-ui/core/CardHeader';
import CardMedia from '@material-ui/core/CardMedia';
import CardContent from '@material-ui/core/CardContent';
import CardActions from '@material-ui/core/CardActions';
import Avatar from '@material-ui/core/Avatar';
import IconButton from '@material-ui/core/IconButton'
//import LockIcon from '@material-ui/icons/Lock'
import FavoriteIcon from '@material-ui/icons/Favorite';
import ShareIcon from '@material-ui/icons/Share';
import ExpandMoreIcon from '@material-ui/icons/ExpandMore';
import MoreVertIcon from '@material-ui/icons/MoreVert';
import 'date-fns';
import Grid from '@material-ui/core/Grid';
import CircularProgress from '@material-ui/core/CircularProgress';
import ButtonGroup from '@material-ui/core/ButtonGroup';
import Chip from '@material-ui/core/Chip';
import {connect} from 'react-redux';
import {requestDetail,setLoader} from '../actions/LaundryAction'
import {bindActionCreators} from 'redux';

import '../App.css';


const styles=(theme) => ({
  root: {
    width: '100%',
  },
  chi: {
    width: '100%',
    
     
     '& > *': {
      margin: theme.spacing(1),
    },
   
  },
   req: {
    display: 'flex',
    
   
  },
  backButton: {
    marginRight: theme.spacing(1),
  },
  instructions: {
    marginTop: theme.spacing(1),
    marginBottom: theme.spacing(1),
  },
 
  margin: {
    margin: theme.spacing(1),
  },
  textField: {
    flexBasis: 200,
  },
  loader:{
    
    margin: 'auto',

  },

  
  
  
 
});

class LaundryDetails extends Component{

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
      id:'',
      
    };

   
    
  }

 componentDidMount(){
  this.props.setLoader(true);
  const id = {id: this.props.id};
    this.props.requestDetail(id);
    
 }

  render(){

    const { classes } = this.props;
    

    const laundry = this.props.laundries !=""  ? (
      
       <div className={classes.root+" body"}>
   <div className="container">
           <Card className={classes.card}>
      <CardHeader
        avatar={
          <Avatar aria-label="recipe" className={classes.avatar}>
            {this.props.laundries.id}
          </Avatar>
        }
        action={
          <IconButton aria-label="settings">
            Total Price{this.props.laundries.totalprice}
          </IconButton>
        }
        title={this.props.laundries.txref}
        subheader='jj'
       
      />
     
      <CardContent>
      <table class="table  table-bordered table-hover ">
     
     <tr ><td> Laundry Status </td><td >{this.props.laundries.lstatus } </td></tr>
       <tr ><td> Requested Date</td><td >  </td></tr>
            <tr><td> Country</td><td> {this.props.laundries.country}  </td></tr>
           <tr ><td> State </td><td >{this.props.laundries.state}   </td></tr>
           <tr ><td> LGA</td> <td>{this.props.laundries.lovalgov}  </td></tr>
       <tr ><td> Delivery Address </td><td> {this.props.laundries.addr}  </td></tr>
        
      
         
     </table>
        <table class="table table-striped table-bordered table-hover"  id="kv">
              <tr>
                <td>Laundry</td>
                <td>Qty</td>
                <td>Price</td>
                <td>Subtotal</td>
                
                </tr>
           </table>
           <hr />
             <div className={classes.chi}>

            
             <dt class="list-group-item active">Favorite</dt>

            <Grid container justify="space-around">
                 <span>
               <h5>Starch</h5>
               <p> { } { }&#8358;</p>
             
             </span>
             
             <span>
                <h5>Perfume</h5>
                <p> { } { }&#8358;</p>
                   
             </span>
        
            </Grid>

             </div>

              <dt class="list-group-item active">Todo</dt>
             <ButtonGroup
              color="primary"
              size="large"
              variant="outlined"
              aria-label="large outlined primary button group"
            >
              <Button>Iron</Button>
              <Button>Hang</Button>
              <Button>Perfume</Button>
            </ButtonGroup>
            <hr/>
            <fieldset> 
        <legend> Pickup Date and Delivery Date</legend>
       
       <Grid container justify="space-around">
                 <span>
               <h5>Pickup Date</h5>
               <p> { this.props.laundries.addr} </p>
             
             </span>
             
             <span>
                <h5>Delivery Date</h5>
                <p> { this.props.laundries.addr} </p>
                   
             </span>
        
            </Grid>
      </fieldset>
      
      
      </CardContent>
      <CardActions >
        <p> { this.props.laundries.shortnote} </p>
      </CardActions>
    
    </Card>


        </div>
        </div>

    ) :
     (

     <p>loading</p>
      

    )
    
console.log(this.props);
 


  
  return (
    <div>
        {
          this.props.loader?(
     <div className={classes.loader}>
               <CircularProgress/>
            </div>
    ):(laundry)
        }
      
      </div>
  )};
}
const mapDispatchToProps = dispatch =>{
    return{
        ...bindActionCreators({
          requestDetail,
           setLoader,
        },dispatch)
    }
}

const mapStateToProps = (state,ownProps) =>{
    return{
         
         laundries: state.LaundryReducer.singleLaundry,
         id: ownProps.match.params.laundry_id,
         loader: state.LaundryReducer.loader,
         
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(withStyles(styles)(LaundryDetails));
