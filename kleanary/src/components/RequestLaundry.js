import React, {Component} from 'react';
import { withStyles } from '@material-ui/core/styles';
import Stepper from '@material-ui/core/Stepper';
import Step from '@material-ui/core/Step';
import StepLabel from '@material-ui/core/StepLabel';
import Button from '@material-ui/core/Button';
import Typography from '@material-ui/core/Typography';
import clsx from 'clsx';
import InputAdornment from '@material-ui/core/InputAdornment';
import TextField from '@material-ui/core/TextField';
import InputLabel from '@material-ui/core/InputLabel';
import MenuItem from '@material-ui/core/MenuItem';
import AddIcon from '@material-ui/icons/Add';
import Fab from '@material-ui/core/Fab';
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
import { red } from '@material-ui/core/colors';
import PropTypes from 'prop-types';
import MaskedInput from 'react-text-mask';
import NumberFormat from 'react-number-format';
import Input from '@material-ui/core/Input';
import FormControl from '@material-ui/core/FormControl';
import TextareaAutosize from '@material-ui/core/TextareaAutosize';
import 'date-fns';
import Grid from '@material-ui/core/Grid';
import DateFnsUtils from '@date-io/date-fns';
import ButtonGroup from '@material-ui/core/ButtonGroup';
import Chip from '@material-ui/core/Chip';
import Paper from '@material-ui/core/Paper';
import {
  MuiPickersUtilsProvider,
  KeyboardTimePicker,
  KeyboardDatePicker,
} from '@material-ui/pickers';
import {connect} from 'react-redux';
import {bindActionCreators} from 'redux';
import {requestLaundry,setLoader,verifyStack} from '../actions/LaundryAction'
import { Carousel } from 'react-materialize';
import '../App.css';
import Dialog from '@material-ui/core/Dialog';
import ListItemText from '@material-ui/core/ListItemText';
import ListItem from '@material-ui/core/ListItem';
import List from '@material-ui/core/List';
import Divider from '@material-ui/core/Divider';
import AppBar from '@material-ui/core/AppBar';
import Toolbar from '@material-ui/core/Toolbar';
import CloseIcon from '@material-ui/icons/Close';
import Slide from '@material-ui/core/Slide';
import CircularProgress from '@material-ui/core/CircularProgress';
import Form from 'react-bootstrap/Form';
import Col from 'react-bootstrap/Col'

//import the library
    import PaystackButton from 'react-paystack';

const styles=(theme) => ({
  root: {
    width: '100%',
    
     
     '& > *': {
      margin: theme.spacing(1),
    },
   
  },
   req: { 
    display: 'flex',
    margin:'auto',
   
    
    
   
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
    appBar: {
    position: 'relative',
  },

  
  
  
 
});

const Transition = React.forwardRef(function Transition(props, ref) {
  return <Slide direction="up" ref={ref} {...props} />;
});

function getSteps() {
  return ['Reuest laundry', 'Laundry Details', 'Pickup & delivery details '];
}

function TextMaskCustom(props) {
  const { inputRef, ...other } = props;

  return (
    <MaskedInput
      {...other}
      ref={ref => {
        inputRef(ref ? ref.inputElement : null);
      }}
      mask={['(', /[1-9]/, /\d/, /\d/, ')', ' ', /\d/, /\d/, /\d/, '-', /\d/, /\d/, /\d/, /\d/]}
      placeholderChar={'\u2000'}
      showMask
    />
  );
}

TextMaskCustom.propTypes = {
  inputRef: PropTypes.func.isRequired,
};

function NumberFormatCustom(props) {
  const { inputRef, onChange, ...other } = props;

  return (
    <NumberFormat
      {...other}
      getInputRef={inputRef}
      onValueChange={values => {
        onChange({
          target: {
            value: values.value,
          },
        });
      }}
      thousandSeparator
      isNumericString
      prefix=""
    />
  );
}

NumberFormatCustom.propTypes = {
  inputRef: PropTypes.func.isRequired,
  onChange: PropTypes.func.isRequired,
};



class RequestLaundry extends Component {
  constructor(props) {
    super(props);

    this.state = {
     
      activeStep:0,
      numberformat: '0',
      pickupDate: new Date('2019-08-18T21:11:54'),
      deliveryDate: new Date('2019-08-18T21:11:54'),
      name:"",
      qty:"",
      klist:[],
      newList:[],
      selectedFile:null,
      selectedFiles:null,
      imageSrcArray:[],
      todoIron:[],
      todoHang:[],
      todoperfume:[],
      todo:"",
       shortNote:"",
      email:this.props.user.email,
      phone:this.props.user.phone,
      country:this.props.user.country,
      state:this.props.user.state,
      localgov:this.props.user.localgov,
      addr:this.props.user.addr,
      starch:this.props.user.favstarch,
      perfume:this.props.user.favperf,
      open:false,
      loading:false,
     
        
      
      total:0,

    };
  }

  render(){
    const imgp = document.getElementById("imgp");


    const { classes } = this.props;
     const handleChange = prop => event => {
      this.setState({ ...this.state, [prop]: event.target.value });
    };

    const handlePDateChange = date => {
    
     this.setState({ ...this.state, pickupDate:date });
  };
   const handleDDateChange = date => {
    
     this.setState({ ...this.state, deliveryDate:date });
  };

    
  
  
  const steps = getSteps();

  const handleNext = () => {
    const newstep = this.state.activeStep + 1;
    this.setState({...this.state, activeStep: newstep});
  };

  const handleBack = () => {
    const newstep = this.state.activeStep - 1;
    this.setState({...this.state, activeStep: newstep});
  };

  const handleReset = () => {
     console.log(this.props.loader)
    this.props.setLoader(true);
    console.log(this.props.loader)
    
      const data ={
        pickupDate: this.state.pickupDate,
      deliveryDate: this.state.deliveryDate,
      name: this.state.name,
      qty: this.state.qty,
      klist: this.state.klist,
      
      selectedFile: this.state.selectedFile,
      laundryimg: this.state.selectedFiles,
      imgSrc: this.state.imageSrcArray,
      todoIron: this.state.todoIron,
      todoHang: this.state.todoHang,
      todoPerfume: this.state.todoperfume,
      

      email: this.state.email,
      phone: this.state.phone,
      country: this.state.country,
      state: this.state.state,
      localgov: this.state.localgov,
      addr: this.state.addr,
      shortNote:this.state.shortNote,
      favstarch: this.state.starch,
      favperfume: this.state.perfume,
      token: this.props.token,
      }

      this.props.requestLaundry(data);

  };

  const handleClickOpen = () => {
    
     this.setState({
      ...this.state, 
      open:true });
  };

  const handleClose = () => {
    
     this.setState({
      ...this.state, 
      open:false });
  };

const getStepContent=(stepIndex)=> {
  switch (stepIndex) {
    case 0:
      return (
        <div className="container">

           <Card className={classes.servis}>
      
     
      <CardContent>

         <div >
 <div class="file-field input-field">
      <div class="btn">
        <span>File</span>
        <input onChange={imageChangeHandler} type="file" multiple/>
      </div>
      <div class="file-path-wrapper">
        <input onChange={imageChangeHandler} multiple class="file-path validate" type="text" placeholder="Upload one or more files"/>
      </div>
    </div>
</div>

        <div className={classes.req} >

<TextField
select
className={clsx(classes.margin, classes.textField)}
variant="outlined"
label="Select Laundry"
value={this.state.name}
onChange={handleInput}
name="name"

>
{this.props.klaundries.map(option => (
<MenuItem key={option.kname} value={option.kname+"|"+option.kprice}>
{option.kprice+" - "+option.kname}
</MenuItem>
))}
</TextField>

 <TextField
          id="filled-number"
          label="Quantity"
          type="number"
          className={classes.textField}
          InputLabelProps={{
            shrink: true,
          }}
          name="qty"
          margin="normal"
          variant="filled"
          onChange={handleInput}
        />


        <Button onClick={handleLaundry} variant="outlined" size="medium" color="primary" className={classes.margin}>
        <AddIcon />
        </Button>
        
</div>
<table class="table table-striped table-bordered table-hover"  id="kv">

  { 
    
     this.state.klist !="" ? (
      this.state.klist.map(klists=>{
        return(
        
              <tr>
                <td>{klists.kname}</td>
                <td>{klists.qty}</td>
                <td>{klists.kprice}</td>
                <td>{klists.subtotal}</td>
                <td><button onClick={()=>{delLaundry(klists.kname)}}><i class='fa fa-trash' aria-hidden='true'></i></button></td>
                </tr>
        )
        
      })

      ) : ("")
      }
           </table>

           <div className={classes.root}>

            
             <dt class="list-group-item active">Favorite</dt>
              <Grid container justify="space-around">
                 <span>
               <h5>Starch</h5>
               <p> {this.state.starch.starchname } { this.state.starch.starchprice}&#8358;</p>
              

             </span>
             
             <span>
                <h5>Perfume</h5>
                <p> {this.state.perfume.perfname } { this.state.perfume.perfprice}&#8358;</p>
                   
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
              <Button onClick={()=>{todoHandler('iron')}}>Iron</Button>
              <Button onClick={()=>{todoHandler('hang')}}>Hang</Button>
              <Button onClick={()=>{todoHandler('perfume')}}>Perfume</Button>
            </ButtonGroup>
            
              
              
            

            
            

           <MuiPickersUtilsProvider utils={DateFnsUtils}>
      <Grid container justify="space-around">
        
        <KeyboardDatePicker
          margin="normal"
          id="date-picker-dialog"
          label="Pickup Date"
          format="MM/dd/yyyy"
          value={this.state.pickupDate}
          onChange={handlePDateChange}
          KeyboardButtonProps={{
            'aria-label': 'change date',
          }}
        />
        <KeyboardTimePicker
          margin="normal"
          id="time-picker"
          label="pickup Time"
          value={this.state.pickupDate}
          onChange={handlePDateChange}
          KeyboardButtonProps={{
            'aria-label': 'change time',
          }}
        />
      </Grid>
    </MuiPickersUtilsProvider>
     <MuiPickersUtilsProvider utils={DateFnsUtils}>
      <Grid container justify="space-around">
        
        <KeyboardDatePicker
          margin="normal"
          id="date-picker-dialog"
          label="Delivery Date"
          format="MM/dd/yyyy"
          value={this.state.deliveryDate}
          onChange={handleDDateChange}
          KeyboardButtonProps={{
            'aria-label': 'change date',
          }}
        />
        <KeyboardTimePicker
          margin="normal"
          id="time-picker"
          label="Delivery Time"
          value={this.state.deliveryDate}
          onChange={handleDDateChange}
          KeyboardButtonProps={{
            'aria-label': 'change time',
          }}
        />
      </Grid>
    </MuiPickersUtilsProvider>

      
 <Form.Group controlId="exampleForm.ControlTextarea1">
    <Form.Label>Short Note</Form.Label>
    <Form.Control aria-label="Short Message" placeholder="Short Message" name="shortNote" as="textarea" rows="3" value={this.state.shortNote}  onChange={handleInput} />
  </Form.Group>
      </CardContent>
      
    
    </Card>
         
        </div>
      );


    case 1:
      return (
        <div className="container">


           <Card className={classes.card}>
      <CardHeader
        avatar={
          <Avatar aria-label="recipe" className={classes.avatar}>
            R
          </Avatar>
        }
        action={
          <IconButton aria-label="settings">
            <MoreVertIcon />
          </IconButton>
        }
        title="Confirm Laundries"
       
      />
     
      <CardContent>
        
        <table class="table table-striped table-bordered table-hover" >

  { 
    
     this.state.klist !="" ? (
      this.state.klist.map(klists=>{
        return(
        
              <tr>
                <td>{klists.kname}</td>
                <td>{klists.qty}</td>
                <td>{klists.kprice}</td>
                <td>{klists.subtotal}</td>
                <td><button onClick={()=>{delLaundry(klists.kname)}}><i class='fa fa-trash' aria-hidden='true'></i></button></td>
                </tr>
        )
        
      })

      ) : ("")
      }
           </table>
           <hr />
             <div className={classes.root}>

           
             <dt class="list-group-item active">Favorite</dt>

            <Grid container justify="space-around">
                 <span>
               <h5>Starch</h5>
               <p> {this.state.starch.starchname } { this.state.starch.starchprice}&#8358;</p>
             
             </span>
             
             <span>
                <h5>Perfume</h5>
                <p> {this.state.perfume.perfname } { this.state.perfume.perfprice}&#8358;</p>
                   
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
              <Button onClick={()=>{todoHandler('iron')}}>Iron</Button>
              <Button onClick={()=>{todoHandler('hang')}}>Hang</Button>
              <Button onClick={()=>{todoHandler('perfume')}}>Perfume</Button>
            </ButtonGroup>
            <hr/>
            <fieldset> 
        <legend> Pickup and Delivery Date</legend>
       
       <Grid container justify="space-around">
        
        <Chip variant="contained" color="primary" size="large" label={this.state.pickupDate.Date}/>
        <Chip variant="contained" color="primary" size="large" label={this.state.deliveryDate.Date} />
      </Grid>
      </fieldset>
      
      
      </CardContent>
      <CardActions disableSpacing>
      
      </CardActions>
    
    </Card>


        </div>
      );


    case 2:
      return (
        <div className="container">
        <Card className={classes.card}>
      
     
      <CardContent>

        <Form>
  <Form.Row>
    <Form.Group as={Col} controlId="formGridEmail">
      <Form.Label>Email</Form.Label>
      <Form.Control onChange={handleInput} id="email" type="email" disabled value={this.state.email} class="validate" placeholder="Enter email" />
    </Form.Group>

    <Form.Group as={Col} controlId="formGridPassword">
      <Form.Label>Phone Number</Form.Label>
      <Form.Control onChange={handleInput}  id="icon_telephone" name="phone" value={this.state.phone} type="tel" class="validate" placeholder="Phone Number" />
    </Form.Group>
  </Form.Row>

  <Form.Group controlId="formGridAddress1">
    <Form.Label>Pickup Address</Form.Label>
    <Form.Control onChange={handleInput} name="addr" value={this.state.addr}   id="addr" type="text"  placeholder="1234 Main St" />
  </Form.Group>

  <Form.Group controlId="formGridAddress2">
    <Form.Label>Address 2</Form.Label>
    <Form.Control placeholder="Apartment, studio, or floor" />
  </Form.Group>

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

</Form>
       
        
   </CardContent>
      <CardActions disableSpacing>
       
      </CardActions>
    
    </Card>
         
        </div>
        
      );
    default:
      return 'Unknown stepIndex';
  }
}

const handleLaundry = (e) => {
    e.preventDefault();
      var name = this.state.name;
      var names = name.split('|');
      var kl = names[0];
      var kp = names[1];
      var newkp = kl;
      var newList="";

      const qty = this.state.qty;
      const subt = qty*kp;
      const data ={kname:kl, kprice: kp, qty:qty, subtotal: subt, };
   
    if(this.state.klist.length > 0 ){

      this.state.klist.forEach(element => {
       if (element.kname==newkp) {
         delLaundry(newkp);
       }else{
          let klist = [...this.state.klist, data];
        this.setState({klist})
                
       }
     })

}else{
        let klist = [...this.state.klist, data];
        this.setState({klist})
}
      
      
  };

  const handleInput =(e)=>{
      e.preventDefault();
      const name = e.target.name;
      const value = e.target.value;
      this.setState({ [name]:value});
     
    }

     const delLaundry =(kname)=>{
      
       const list = this.state.klist.filter(lis=>{
       return lis.kname !==kname
      })
      this.setState({...this.state, klist:list});
     
      console.log(this.state);
      
    }

    const imageChangeHandler=(e)=>{
     const files = e.target.files;
     this.setState({...this.state, selectedFiles:files});
      console.log(this.state.selectedFiles);

    }

    const todoHandler = (todo) =>{

      if (this.state.selectedFiles !=null) {
 
      const files = Array.from( this.state.selectedFiles);
       var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;            
            if (files.length > 0) {
        /* Map each file to a promise that resolves to an array of image URI's */ 
        handleClickOpen();
        Promise.all(files.map(file => {
          if (regex.test(file.name.toLowerCase())) {
            if(file.size < 2000000000000000){
            return (new Promise((resolve,reject) => {
                const reader = new FileReader();
                reader.addEventListener('load', (ev) => {
                  var filename = ev.target.fileName;
                  var size = ev.target.imgsize;
                  var url= ev.target.result
                  var data = {filename:filename, url:url, size:size,}
                    resolve(data);
                });
                reader.addEventListener('error', reject);
                 reader.fileName = file.name;
                 reader.imgsize = file.size;
                reader.readAsDataURL(file);
            }));
          }else {
            alert(file.name + " is more than 2Mb."+file.size);
            handleClose();
            return false;
        }
          }else {
              alert(file.name + " is not a valid image file.");
              handleClose();
              return false;
          }
        }))
        .then(images => {

            /* Once all promises are resolved, update state with image URI array */
            
            this.setState({ imageSrcArray : images })
            this.setState({...this.state, todo:todo })

        }, error => {        
            console.error(error);
        });
 
            }else{alert("Upload image first. ");}

      }
      
    }

    

    const todoImage = this.state.imageSrcArray.length > 0 ? (
      this.state.imageSrcArray.map(imgSrc =>{
        var style = "greyy";
        
        switch (this.state.todo) {
          case "iron":
              
            for (let i = 0; i < this.state.todoIron.length; i++) {
          const element = this.state.todoIron[i];
          if (imgSrc.filename==element.filename) {
            style="greenn";
            break;
          }
        }
        return( 
         <Grid item xs={4} md={3} lg={2}  key={imgSrc.filename}>
        <div  >
          <a  onClick={()=>{addToToDo('iron',imgSrc.filename,imgSrc.url)}}>
          <img className={style}  id={imgSrc.filename} width="150" height="150" src={imgSrc.url}   />
          </a>
        
      </div>
        </Grid>
        );
            break;

              case "hang":
              
            for (let i = 0; i < this.state.todoHang.length; i++) {
          const element = this.state.todoHang[i];
          if (imgSrc.filename==element.filename) {
            style="greenn";
            break;
          }
        }
        return( 
         <Grid item xs={4} md={3} lg={2}  key={imgSrc.filename}>
        <div  >
          <a  onClick={()=>{addToToDo('hang',imgSrc.filename,imgSrc.url)}}>
          <img className={style}  id={imgSrc.filename} width="150" height="150" src={imgSrc.url}   />
          </a>
        
      </div>
        </Grid>
        );
            break;

              case "perfume":
              
            for (let i = 0; i < this.state.todoperfume.length; i++) {
          const element = this.state.todoperfume[i];
          if (imgSrc.filename==element.filename) {
            style="greenn";
            break;
          }
        }
        return( 
         <Grid item xs={4} md={3} lg={2}  key={imgSrc.filename}>
        <div  >
          <a  onClick={()=>{addToToDo('perfume',imgSrc.filename,imgSrc.url)}}>
          <img className={style}  id={imgSrc.filename} width="150" height="150" src={imgSrc.url}   />
          </a>
        
      </div>
        </Grid>
        );
            break;
        
          default:
            break;
        }
      })
    ) :("");

    const addToToDo = (todo,filename,url)=>{

      switch (todo) {
        case "iron":
          if(this.state.todoIron.length > 0){
            var isIn=false;
            for (let i = 0; i < this.state.todoIron.length; i++) {
              const element = this.state.todoIron[i];
              if (element.filename == filename) {
                isIn=true;
                break;
              }  
            }
            if (isIn) {
               const list = this.state.todoIron.filter(lis=>{
       return lis.filename !==filename;
      
      })
      this.setState({...this.state, todoIron:list});
       document.getElementById(filename).style.borderColor="grey";
            }else{
             const data={todo:todo,filename:filename,url:url};
               let todoIron = [...this.state.todoIron, data];
        
        this.setState({todoIron})
         document.getElementById(filename).style.borderColor="green";
            }

          }else{
             const data={todo:todo,filename:filename,url:url};
               let todoIron = [...this.state.todoIron, data];
        
        this.setState({todoIron})
         document.getElementById(filename).style.borderColor="green";
          }
          
          break;

           case "hang":
          if(this.state.todoHang.length > 0){
            var isIn=false;
            for (let i = 0; i < this.state.todoHang.length; i++) {
              const element = this.state.todoHang[i];
              if (element.filename == filename) {
                isIn=true;
                break;
              }  
            }
            if (isIn) {
               const list = this.state.todoHang.filter(lis=>{
       return lis.filename !==filename;
      
      })
      this.setState({...this.state, todoHang:list});
       document.getElementById(filename).style.borderColor="grey";
            }else{
             const data={todo:todo,filename:filename,url:url};
               let todoHang = [...this.state.todoHang, data];
        
        this.setState({todoHang})
         document.getElementById(filename).style.borderColor="green";
            }

          }else{
             const data={todo:todo,filename:filename,url:url};
               let todoHang = [...this.state.todoHang, data];
        
        this.setState({todoHang})
         document.getElementById(filename).style.borderColor="green";
          }
          
          break;

           case "perfume":
          if(this.state.todoperfume.length > 0){
            var isIn=false;
            for (let i = 0; i < this.state.todoperfume.length; i++) {
              const element = this.state.todoperfume[i];
              if (element.filename == filename) {
                isIn=true;
                break;
              }  
            }
            if (isIn) {
               const list = this.state.todoperfume.filter(lis=>{
       return lis.filename !==filename;
      
      })
      this.setState({...this.state, todoperfume:list});
       document.getElementById(filename).style.borderColor="grey";
            }else{
             const data={todo:todo,filename:filename,url:url};
               let todoperfume = [...this.state.todoperfume, data];
        
        this.setState({todoperfume})
         document.getElementById(filename).style.borderColor="green";
            }

          }else{
             const data={todo:todo,filename:filename,url:url};
               let todoperfume = [...this.state.todoperfume, data];
        
        this.setState({todoperfume})
         document.getElementById(filename).style.borderColor="green";
          }
          
          break;
      
        default:
          break;
      }
    }

    const callback = (response) => {
      this.props.setLoader(true);
      this.props.verifyStack(response);
    		console.log(response); // card charged successfully, get reference here
    	}

    const	close = () => {
      this.props.setLoader(false);
    		console.log("Payment closed");
        }

  return (

    
    <div className={classes.root+" body"}>
      


      <Stepper activeStep={this.state.activeStep} alternativeLabel>
        {steps.map(label => (
          <Step key={label}>
            <StepLabel>{label}</StepLabel>
          </Step>
        ))}
      </Stepper>
      <div>
        {this.state.activeStep === steps.length ? (
          <div>
            {this.props.loader?(<div>
              <CircularProgress/>
            </div>):(
          <div>
            {this.props.request.status==200 ?
      (
       
        <div>
          
            <br />
            <p>
              <PaystackButton
                text="Make Payment"
                className="payButton btn btn-primary"
                callback={callback}
                close={close}
                disabled={false} 
                embed={false}
                reference={this.props.request.data.txref}
                email={this.props.request.data.email}
                amount={this.props.request.data.totalprice}
                paystackkey={this.props.request.data.pkey}
                tag="button"
              />
            </p>
             <div>
             <Typography className={classes.instructions}>All steps completed</Typography>
             <Button
                disabled={this.state.activeStep === 0}
                onClick={handleBack}
                className={classes.backButton}
              >
                Back
              </Button>
            <Button onClick={handleReset}>Checkout</Button>
          </div>
          </div>
        
        ):(
       
            <div>
             <Typography className={classes.instructions}>All steps completed</Typography>
             <Button
                disabled={this.state.activeStep === 0}
                onClick={handleBack}
                className={classes.backButton}
              >
                Back
              </Button>
            <Button onClick={handleReset}>Checkout</Button>
          </div>)}
          
        </div>
        )}
        </div>
     
        ) : (
          <div>
            <Typography className={classes.instructions}>{getStepContent(this.state.activeStep)}</Typography>
            <div>
              <Button
                disabled={this.state.activeStep === 0}
                onClick={handleBack}
                className={classes.backButton}
              >
                Back
              </Button>
              <Button variant="contained" color="primary" onClick={handleNext}>
                {this.activeStep === steps.length - 1 ? 'Finish' : 'Next'}
              </Button>
            </div>
          </div>
        )}
      </div>


       <Dialog fullScreen open={this.state.open} onClose={handleClose} TransitionComponent={Transition}>
        <AppBar className={classes.appBar}>
          <Toolbar>
            <IconButton edge="start" color="inherit" onClick={handleClose} aria-label="close">
              <CloseIcon />
            </IconButton>
            <Typography variant="h6" className={classes.title}>
              Select laundry images
            </Typography>
            <Button autoFocus color="inherit" onClick={handleClose}>
              Ok
            </Button>
          </Toolbar>
        </AppBar>
       <Grid container spacing={3}>
        
              {todoImage}
                                 
              </Grid>
      </Dialog>



    </div>
  )};
}

const mapDispatchToProps = dispatch =>{

   return{
        ...bindActionCreators({
          requestLaundry,
          setLoader,
          verifyStack,
        },dispatch)
    }
   
}

const mapStateToProps = (state,ownProps) =>{
    return{
         
         klaundries: state.AuthReducer.klists,
         id: ownProps.match.params.laundry_id,
         user:state.AuthReducer.user,
         token:state.AuthReducer.access_token,
         request: state.LaundryReducer.requestdetail,
         history: ownProps.history,
         loader: state.LaundryReducer.loader,
         
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(withStyles(styles)(RequestLaundry));