import React, { Component } from 'react';
import Avatar from '@material-ui/core/Avatar';
import Button from '@material-ui/core/Button';
import CssBaseline from '@material-ui/core/CssBaseline';
import TextField from '@material-ui/core/TextField';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import Checkbox from '@material-ui/core/Checkbox';
import Link from '@material-ui/core/Link';
import Grid from '@material-ui/core/Grid';
import Box from '@material-ui/core/Box';
import LockOutlinedIcon from '@material-ui/icons/LockOutlined';
import Typography from '@material-ui/core/Typography';
import { withStyles } from '@material-ui/core/styles'
import {connect} from 'react-redux';
import Container from '@material-ui/core/Container';
import {regUser,setAuthLoader} from '../actions/AuthAction';
import {bindActionCreators} from 'redux';
import CircularProgress from '@material-ui/core/CircularProgress';



function Copyright() {
  return (
    <Typography variant="body2" color="textSecondary" align="center">
      {'Copyright © '}
      <Link color="inherit" href="https://material-ui.com/">
        Your Website
      </Link>{' '}
      {new Date().getFullYear()}
      {'.'}
    </Typography>
  );
}

const styles = theme => ({
  '@global': {
    body: {
      backgroundColor: theme.palette.common.white,
    },
  },
  paper: {
    marginTop: theme.spacing(8),
    display: 'flex',
    flexDirection: 'column',
    alignItems: 'center',
  },
  avatar: {
    margin: theme.spacing(1),
    backgroundColor: theme.palette.secondary.main,
  },
  form: {
    width: '100%', // Fix IE 11 issue.
    marginTop: theme.spacing(3),
  },
  submit: {
    margin: theme.spacing(3, 0, 2),
  },
});


class SignupForm extends Component {

 constructor(props) {
    super(props);

    this.state = {
     fname:"",
      lname:"",
      username:"",
        email:'',
        password:'',
        errors:'',
        confirmpass:'',
        loader:this.props.loader,
     
    
    };
  }

  render(){

    const { classes } = this.props;

    const handleSubmit =(e)=>{
      e.preventDefault();
       this.props.setAuthLoader(true);
    const data = {
       email: this.state.email,
        fname:  this.state.fname,
      lname:  this.state.lname,
      name:  this.state.fname,
      password: this.state.password,
    confirmpass: this.state.confirmpass,
    }
   this.setState({...this.state, loader:true})
    this.state.confirmpass== "Password Matches" ? (
      this.props.regUser(data)
    ) : (
      this.setState({...this.state, loader:false, errors:"Password does not Match"})
    )
      
    }

    
    const handleInput =(e)=>{
      e.preventDefault();
      const name = e.target.name;
      const value = e.target.value;
      this.setState({ [name]:value});
      console.log(this.state);
      
    }

    const handlePassword =(e)=>{
      e.preventDefault();
      const name = e.target.name;
      const value = e.target.value;
   if (e.target.value == this.state.password ) {
      
      this.setState({ [name]:"Password Matches"});

       
      
   }else{this.setState({ [name]:"Password does not Match"});};
      
    }
  return (
    <Container component="main" maxWidth="xs">
      <CssBaseline />
      <div className={classes.paper}>
        <Avatar className={classes.avatar}>
         < LockOutlinedIcon/> 
        </Avatar>
        <Typography component="h1" variant="h5">
          Sign up
        </Typography>
        {this.state.errors != ""? (this.state.errors):("")}
        <form className={classes.form}  onSubmit={handleSubmit}>
          <Grid container spacing={2}>
            <Grid item xs={12} sm={6}>
              <TextField
                autoComplete="fname"
                name="fname"
                variant="outlined"
                required
                fullWidth
                id="fname"
                label="First Name"
                autoFocus
                onChange={handleInput}
              />
            </Grid>
            <Grid item xs={12} sm={6}>
              <TextField
                variant="outlined"
                required
                fullWidth
                id="lname"
                label="Last Name"
                name="lname"
                autoComplete="lname"
                 onChange={handleInput}
              />
            </Grid>
            <Grid item xs={12}>
              <TextField
                variant="outlined"
                required
                fullWidth
                id="email"
                label="Email Address"
                name="email"
                autoComplete="email"
                 onChange={handleInput}
              />
            </Grid>
            <Grid item xs={12}>
              <TextField
                variant="outlined"
                required
                fullWidth
                name="password"
                label="Password"
                type="password"
                id="password"
                autoComplete="current-password"
                 onChange={handleInput}
              />
            </Grid>
             <Grid item xs={12}>
              <TextField
                variant="outlined"
                required
                fullWidth
                name="confirmpass"
                label="Confirm Password"
                type="password"
                id="confirmpass"
                autoComplete="current-password"
                 onChange={handlePassword}
              />
            </Grid>
            {this.state.confirmpass=="Password Matches"?( <p className="text-success">{this.state.confirmpass}</p> )
            : ("")}
            {this.state.confirmpass=="Password does not Match"?( <p className="text-info">{this.state.confirmpass}</p> ): ("")}
           
            <Grid item xs={12}>
              <FormControlLabel
                control={<Checkbox value="allowExtraEmails" color="primary" />}
                label="I want to receive inspiration, marketing promotions and updates via email."
              />
            </Grid>
          </Grid>
         
           {!this.props.loader?(
               <Button
              type="submit"
              fullWidth
              variant="contained"
              color="primary"
              className={classes.submit}
            >
              Sign Up
            </Button>
            ):(
              <CircularProgress/>
            )}
          <Grid container justify="flex-end">
            <Grid item>
              <Link href="#" variant="body2">
                Already have an account? Sign in
              </Link>
            </Grid>
          </Grid>
        </form>
      </div>
      <Box mt={5}>
        <Copyright />
      </Box>
    </Container>
  );
}
}

const mapDispatchToProps = dispatch =>{
    return{

       ...bindActionCreators({
          regUser,
          setAuthLoader,

        },dispatch)

    }
}
const mapStateToProps = (state) =>{
    return{
        loader: state.AuthReducer.loader,
       
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(withStyles(styles, { withTheme: true })(SignupForm))