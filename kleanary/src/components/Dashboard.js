
  import React,{Component} from 'react';
import Paper from '@material-ui/core/Paper';
import {withStyles}  from '@material-ui/core/styles';
import Tabs from '@material-ui/core/Tabs';
import Tab from '@material-ui/core/Tab';
import PropTypes from 'prop-types';
import Box from '@material-ui/core/Box';
import Typography from '@material-ui/core/Typography';
import clsx from 'clsx';
import Card from '@material-ui/core/Card';
import CardHeader from '@material-ui/core/CardHeader';
import CardMedia from '@material-ui/core/CardMedia';
import CardContent from '@material-ui/core/CardContent';
import CardActions from '@material-ui/core/CardActions';
//import Collapse from '@material-ui/core/Collapse';
import Avatar from '@material-ui/core/Avatar';
import IconButton from '@material-ui/core/IconButton'
//import LockIcon from '@material-ui/icons/Lock'
import FavoriteIcon from '@material-ui/icons/Favorite';
import ShareIcon from '@material-ui/icons/Share';
import ExpandMoreIcon from '@material-ui/icons/ExpandMore';
import MoreVertIcon from '@material-ui/icons/MoreVert';
import { red } from '@material-ui/core/colors';
import Grid from '@material-ui/core/Grid';
import {NavLink,  withRouter} from 'react-router-dom';
import {connect} from 'react-redux';
import {bindActionCreators} from 'redux';
import {requestPLaundry,requestDLaundry,setLoader} from '../actions/LaundryAction';
import CircularProgress from '@material-ui/core/CircularProgress';

const styles = (theme)=>({
  root: {
    flexGrow: 1
  },
   markdownElement: {},
  cardsContent: {
    padding: 15,
    display: 'flex',
    justifyContent: 'space-around',
    flexWrap: 'wrap',
    [theme.breakpoints.only('xs')]: {
      width: '100%',
      padding: 0,
      paddingTop: 15
    }
  },
  card: {
    minWidth: 275,
    maxWidth: 350,
    margin: 15,
    [theme.breakpoints.only('xs')]: {
      width: '100%',
      margin: 0,
      marginTop: 7
    }
  },
  bullet: {
    display: 'inline-block',
    margin: '0 2px',
    transform: 'scale(0.8)'
  },
  cardTitle: {
    marginBottom: 16,
    fontSize: 14
  },
  pos: {
    marginBottom: 12
  },
   header: {
    display: 'flex',
    alignItems: 'center',
    height: 50,
    paddingLeft: theme.spacing(4),
    backgroundColor: theme.palette.background.default,
  },
  img: {
    height: 255,
    display: 'block',
    maxWidth: 400,
    overflow: 'hidden',
    width: '100%',
  },
   media: {
    height: 0,
    paddingTop: '56.25%', // 16:9
  },
  expand: {
    transform: 'rotate(0deg)',
    marginLeft: 'auto',
    transition: theme.transitions.create('transform', {
      duration: theme.transitions.duration.shortest,
    }),
  },
  expandOpen: {
    transform: 'rotate(180deg)',
  },
  avatar: {
    backgroundColor: red[500],
  },
   paper: {
    padding: theme.spacing(2),
    textAlign: 'center',
    color: theme.palette.text.secondary,
  },
  loader:{
    
    margin: 'auto',

  },
});

function TabPanel(props) {
  const { children, value, index, ...other } = props;

  return (
    <Typography
      component="div"
      role="tabpanel"
      hidden={value !== index}
      id={`wrapped-tabpanel-${index}`}
      aria-labelledby={`wrapped-tab-${index}`}
      {...other}
    >
      <Box p={3}>{children}</Box>
    </Typography>
  );
}

TabPanel.propTypes = {
  children: PropTypes.node,
  index: PropTypes.any.isRequired,
  value: PropTypes.any.isRequired,
};

function a11yProps(index) {
  return {
    id: `wrapped-tab-${index}`,
    'aria-controls': `wrapped-tabpanel-${index}`,
  };
}


class Dashboard extends Component {
  constructor(props) {
    super(props);

    this.state = {
      value: 'one'
    };
  }

  componentDidMount(){
    this.props.setLoader(true);
    this.props.requestPLaundry();
    this.props.requestDLaundry();
  }

  render(){

    const { classes } = this.props;
console.log(this.props);
    const {pendinglaundries} =this.props;
    
    const pendingList = pendinglaundries != ""  ? (
      pendinglaundries.data.plaundry.data.map(plaundries=>{

        return(

        
          <Grid item xs={12} md={6} lg={4}  key={plaundries.id}>
         
         <Card className={classes.card}>
      <CardHeader
        avatar={
          <Avatar aria-label="recipe" className={classes.avatar}>
            {plaundries.totalnum}
          </Avatar>
        }
        action={
          <IconButton aria-label="settings">
             <NavLink to={'/' + plaundries.id}>
        <IconButton aria-label="add to favorites">
        <MoreVertIcon />
       </IconButton>
        </NavLink>
            
          </IconButton>
        }
        title={plaundries.txref}
        subheader={plaundries.created_at}
      />
      <CardActions disableSpacing>
        <Typography variant="body2" color="textSecondary" component="p">
        &#8358;{plaundries.totalprice}
        </Typography>
       
      </CardActions>
    
    </Card>
    
        </Grid>
      )

      })
    ) : (
    <p>You have no pending laundry yet!!!</p>
    )


     const {deliveredlaundries} =this.props
    const deliveredList = deliveredlaundries  !="" ? (
      deliveredlaundries.data.dlaundry.data.map(dlaundries=>{

        return(

          <Grid item xs={12} md={6} lg={4} key={dlaundries.id}>
          
         <Card className={classes.card}>
      <CardHeader
        avatar={
          <Avatar aria-label="recipe" className={classes.avatar}>
            {dlaundries.laundrynum}
          </Avatar>
        }
        action={
          <IconButton aria-label="settings">
            <MoreVertIcon />
          </IconButton>
        }
        title={dlaundries.reference}
        subheader={dlaundries.created_date}
      />
     
      <CardContent>
        <Typography variant="body2" color="textSecondary" component="p">
         
        </Typography>
      </CardContent>
      <CardActions disableSpacing>
        <NavLink to={"/detail/"+dlaundries.id}>
        <IconButton aria-label="add to favorites">
         Details
       </IconButton>
        </NavLink>
        <IconButton aria-label="share">
          <ShareIcon />
        </IconButton>
        <IconButton
          className={clsx(classes.expand, {
            [classes.expandOpen]: this.state.expanded,
          })}
         
          
          aria-label="show more"
        >
          <ExpandMoreIcon />
        </IconButton>
      </CardActions>
    
    </Card>
    
        </Grid>
        )

      })
    ) : (
    <p>You have no delivered laundry yet!!</p>
    )
    
  
    const handleChange = (event, newValue) => {
      this.setState({
        ...this.state,
        value: newValue
      });
    };

  return (

    <div className="App body">
    <Paper square className={classes.root}>
      <Tabs
        value={this.state.value}
        onChange={handleChange}
        variant="fullWidth"
        indicatorColor="secondary"
        textColor="secondary"
        aria-label="icon label tabs example"
      >

        <Tab  label="PENDING" value="one"  wrapped
            {...a11yProps('one')} />
        <Tab  label="RECENTS" value="two" {...a11yProps('two')} /> 
        
        
      </Tabs>
    </Paper>
      <TabPanel value={this.state.value} index="one">
      <Grid container spacing={3}>

        {
          this.props.loader?(
            <div className={classes.loader}>
               <CircularProgress/>
            </div>
    
    ):(pendingList)
        }
        
      
        
         </Grid>
      </TabPanel>
      <TabPanel value={this.state.value} index="two">
         <Grid container spacing={3}>

            {
          this.props.loader?(
     <div className={classes.loader}>
               <CircularProgress/>
            </div>
    ):(deliveredList)
        }
        
     
        
         </Grid>
      </TabPanel>
     
    </div>
  )};
}
const mapDispatchToProps = dispatch =>{
    return{
       ...bindActionCreators({
          requestPLaundry,
          requestDLaundry,
          setLoader,
        },dispatch)
    }
}

const mapStateToProps = (state) =>{
    return{
         pendinglaundries: state.LaundryReducer.pendinglaundries,
         deliveredlaundries: state.LaundryReducer.deliveredlaundries,
          loader: state.LaundryReducer.loader,
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(withRouter(withStyles(styles)(Dashboard)));
   
