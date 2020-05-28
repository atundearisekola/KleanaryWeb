import React, {Component} from 'react';
import { withStyles } from '@material-ui/core/styles';
import AppBar from '@material-ui/core/AppBar';
import Toolbar from '@material-ui/core/Toolbar';
import Typography from '@material-ui/core/Typography';
import IconButton from '@material-ui/core/IconButton';
import MenuIcon from '@material-ui/icons/Menu';
import AccountCircle from '@material-ui/icons/AccountCircle';
import Switch from '@material-ui/core/Switch';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import FormGroup from '@material-ui/core/FormGroup';
import MenuItem from '@material-ui/core/MenuItem';
import Menu from '@material-ui/core/Menu';
import List from '@material-ui/core/List';
//import Divider from '@material-ui/core/Divider';
import ListItem from '@material-ui/core/ListItem';
import ListItemIcon from '@material-ui/core/ListItemIcon';
import ListItemText from '@material-ui/core/ListItemText';
import InboxIcon from '@material-ui/icons/MoveToInbox';
//import MailIcon from '@material-ui/icons/Mail';
import SwipeableDrawer from '@material-ui/core/SwipeableDrawer';
//import Button from '@material-ui/core/Button';
import {NavLink,  withRouter} from 'react-router-dom';
import Tooltip from '@material-ui/core/Tooltip'
//import { blue, red } from '@material-ui/core/colors';
import SvgIcon from '@material-ui/core/SvgIcon';
//import { SideNav, Button,SideNavItem } from 'react-materialize';
import DashboardIcon from '@material-ui/icons/Dashboard';
import FavoriteIcon from '@material-ui/icons/Favorite';
import HomeIcon from '@material-ui/icons/Home';
import PersonOutlineIcon from '@material-ui/icons/PersonOutline';
import {connect} from 'react-redux';
import {bindActionCreators} from 'redux';
import {logoutUser} from '../actions/AuthAction';
import '../App.css';

const styles = (theme) => ({
  root: {
    flexGrow: 1,
  },
  menuButton: {
    marginRight: theme.spacing(2),
  },
 title: {
    flexGrow: 1,
  },
   list: {
    width: 250,
    color:"red",
  },
  fullList: {
    width: 'auto',
  },
});

 class Header extends Component {
  constructor(props) {
    super(props);

    this.state = {
      value: 0,
      auth: true,
      anchorEl: null,
      top: false,
    left: false,
    bottom: false,
    right: false,
      
    };
  }




  render(){


    

    const { classes } = this.props;
    console.log(this.props);
  
  const open = Boolean(this.state.anchorEl);

  function HomeIcon(props) {
  return (
    <SvgIcon {...props}>
      <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z" />
    </SvgIcon>
  );
}
  

  const Logout = (e) => {
    e.preventDefault();
     
    this.props.logoutUser();
  };

  const handleMenu = event => {
    this.setState({...this.state, anchorEl: event.currentTarget});
  };

  const handleClose = () => {
    this.setState({...this.state, anchorEl: null});
  };


   const toggleDrawer = (side, open) => event => {
    if (event && event.type === 'keydown' && (event.key === 'Tab' || event.key === 'Shift')) {
      return;
    }

    this.setState({ ...this.state, [side]: open });
  };

  const sideList = side => (
    <div
      className={classes.list}
      class="list"
      role="presentation"
      onClick={toggleDrawer(side, false)}
      onKeyDown={toggleDrawer(side, false)}
    >
      <List>
        
           <ListItem button >
            <ListItemIcon>{ <InboxIcon /> }</ListItemIcon>
            <NavLink to="/"><ListItemText primary="Home" /></NavLink>
          </ListItem>
          {this.props.isAuthenticated ? (
            <div>
          <ListItem button >
            <ListItemIcon>{ <InboxIcon /> }</ListItemIcon>
            <NavLink to="/dashboard"><ListItemText primary="Dashboard" /></NavLink>
          </ListItem>
           <ListItem button >
            <ListItemIcon>{ <InboxIcon /> }</ListItemIcon>
            <NavLink to="/request"><ListItemText primary="Request Laundry" /></NavLink>
          </ListItem>
          <ListItem button >
            <ListItemIcon>{ <InboxIcon /> }</ListItemIcon>
            <NavLink to="/account"><ListItemText primary="Account" /></NavLink>
          </ListItem>
          <ListItem button >
            <ListItemIcon>{ <InboxIcon /> }</ListItemIcon>
            <NavLink to="/favorite"><ListItemText primary="Favourite" /></NavLink>
          </ListItem>
          <ListItem button >
            <ListItemIcon>{ <InboxIcon /> }</ListItemIcon>
            <NavLink to="/logout" onClick={Logout}><ListItemText primary="Logout" /></NavLink>
          </ListItem></div>) 
          :(
            <div>
             <ListItem button >
            <ListItemIcon>{ <InboxIcon /> }</ListItemIcon>
            <NavLink to="/login"><ListItemText primary="Login" /></NavLink>
          </ListItem>
          <ListItem button >
            <ListItemIcon>{ <InboxIcon /> }</ListItemIcon>
            <NavLink to="/signup"><ListItemText primary="Register" /></NavLink>
          </ListItem>
         </div>)}
       
      </List>
     
    </div>
  );

  const fullList = side => (
    <div
      className={classes.fullList}
      role="presentation"
      class="list"
      onClick={toggleDrawer(side, false)}
      onKeyDown={toggleDrawer(side, false)}
    >
      <List>
        <ListItem button >
            <ListItemIcon>{ <InboxIcon /> }</ListItemIcon>
            <NavLink to="/"><ListItemText primary="Home" /></NavLink>
          </ListItem>
          {this.props.isAuthenticated ? (
            <div>
          <ListItem button >
            <ListItemIcon>{ <InboxIcon /> }</ListItemIcon>
            <NavLink to="/dashboard"><ListItemText primary="Dashboard" /></NavLink>
          </ListItem>
           <ListItem button >
            <ListItemIcon>{ <InboxIcon /> }</ListItemIcon>
            <NavLink to="/request"><ListItemText primary="Request Laundry" /></NavLink>
          </ListItem>
          <ListItem button >
            <ListItemIcon>{ <InboxIcon /> }</ListItemIcon>
            <NavLink to="/account"><ListItemText primary="Account" /></NavLink>
          </ListItem>
          <ListItem button >
            <ListItemIcon>{ <InboxIcon /> }</ListItemIcon>
            <NavLink to="/favorite"><ListItemText primary="Favourite" /></NavLink>
          </ListItem>
          <ListItem button >
            <ListItemIcon>{ <InboxIcon /> }</ListItemIcon>
            <NavLink to="/logout"><ListItemText primary="Logout" /></NavLink>
          </ListItem></div>) 
          :(
            <div>
             <ListItem button >
            <ListItemIcon>{ <InboxIcon /> }</ListItemIcon>
            <NavLink to="/login"><ListItemText primary="Login" /></NavLink>
          </ListItem>
          <ListItem button >
            <ListItemIcon>{ <InboxIcon /> }</ListItemIcon>
            <NavLink to="/signup"><ListItemText primary="Register" /></NavLink>
          </ListItem>
         </div>)}
         </List>
      
     
    </div>
  );


 



  return (
    <div className={classes.root}>
      
    
      <AppBar position="static">
        <Toolbar>
          <IconButton edge="start" onClick={toggleDrawer('left', true)}  className={classes.menuButton} color="inherit" aria-label="menu">
            <MenuIcon  />
          </IconButton>
          <Typography variant="h6" className={classes.title}>
           <Tooltip id="tooltip-icon1" title="Home">
             <NavLink to='/'><HomeIcon color="disabled" fontSize="large" /></NavLink>
          </Tooltip>
          </Typography>
          

          

          
          {this.props.isAuthenticated ? (
            <div>
              <IconButton
                aria-label="account of current user"
                aria-controls="menu-appbar"
                aria-haspopup="true"
                onClick={handleMenu}
                color="inherit"
              >
                <AccountCircle />
              </IconButton>
              <Menu
                id="menu-appbar"
                 anchorEl={this.state.anchorEl}
                anchorOrigin={{
                  vertical: 'top',
                  horizontal: 'right',
                }}
                keepMounted
                transformOrigin={{
                  vertical: 'top',
                  horizontal: 'right',
                }}
                open={open}
                onClose={handleClose}
              >
                <MenuItem onClick={handleClose}>Dashboard</MenuItem>
                <MenuItem onClick={Logout}>Logout</MenuItem>
              </Menu>
            </div>
          ): (

            <div className='toolls'>
              <Tooltip id="tooltip-icon1" title="Sign in">
             <NavLink to='/login'>LOGIN</NavLink>
          </Tooltip>
          
          <Tooltip id="tooltip-icon2" title="Sign up">
             <NavLink to='/signup'>SIGNUP</NavLink>
          </Tooltip>
            </div>
            
             ) }

           
        </Toolbar>
      </AppBar>



      <div>

 <SwipeableDrawer
        open={this.state.left}
        onClose={toggleDrawer('left', false)}
        onOpen={toggleDrawer('left', true)}
      >
        {sideList('left')}
      </SwipeableDrawer>
      
      <SwipeableDrawer
        anchor="bottom"
        open={this.state.bottom}
        onClose={toggleDrawer('bottom', false)}
        onOpen={toggleDrawer('bottom', true)}
      >
        {fullList('bottom')}
      </SwipeableDrawer>
     
</div>
    </div>
  )};
}
const mapStateToProps = state => {
    return{
     isAuthenticated: state.AuthReducer.isAuthenticated,
     user: state.AuthReducer.user,
    
    }
}

const mapDispatchToProps = dispatch =>{
    return{
        ...bindActionCreators({
          logoutUser
        },dispatch)
    }
}

export default connect(mapStateToProps,mapDispatchToProps)(withRouter(withStyles(styles)(Header)))