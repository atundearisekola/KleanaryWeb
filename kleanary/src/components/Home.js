
import Button from '@material-ui/core/Button'
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
import React, { Component } from 'react'
import Typography from '@material-ui/core/Typography'
//import { GitHubIcon } from 'rmw-shell/lib/components/Icons'
//import { Helmet } from 'react-helmet'
import { NavLink } from 'react-router-dom'
import { withStyles } from '@material-ui/core/styles'
import Logo from '../logo.svg'
import MobileStepper from '@material-ui/core/MobileStepper';
import Paper from '@material-ui/core/Paper';
import KeyboardArrowLeft from '@material-ui/icons/KeyboardArrowLeft';
import KeyboardArrowRight from '@material-ui/icons/KeyboardArrowRight';
import SwipeableViews from 'react-swipeable-views';
import { autoPlay } from 'react-swipeable-views-utils';
import { red } from '@material-ui/core/colors';
import FavoriteIcon from '@material-ui/icons/Favorite';
import ShareIcon from '@material-ui/icons/Share';
import ExpandMoreIcon from '@material-ui/icons/ExpandMore';
import MoreVertIcon from '@material-ui/icons/MoreVert';
import Grid from '@material-ui/core/Grid';
import '../App.css';

const AutoPlaySwipeableViews = autoPlay(SwipeableViews);

const tutorialSteps = [
  {
    label: 'San Francisco – Oakland Bay Bridge, United States',
    imgPath:
      'https://images.unsplash.com/photo-1537944434965-cf4679d1a598?auto=format&fit=crop&w=400&h=250&q=60',
  },
  {
    label: 'Bird',
    imgPath:
      'https://images.unsplash.com/photo-1538032746644-0212e812a9e7?auto=format&fit=crop&w=400&h=250&q=60',
  },
  {
    label: 'Bali, Indonesia',
    imgPath:
      'https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=400&h=250&q=80',
  },
  {
    label: 'NeONBRAND Digital Marketing, Las Vegas, United States',
    imgPath:
      'https://images.unsplash.com/photo-1518732714860-b62714ce0c59?auto=format&fit=crop&w=400&h=250&q=60',
  },
  {
    label: 'Goč, Serbia',
    imgPath:
      'https://images.unsplash.com/photo-1512341689857-198e7e2f3ca8?auto=format&fit=crop&w=400&h=250&q=60',
  },
];
const styles = theme => ({
  main: {
    display: 'flex',
    flexDirection: 'column'
  },
  root: {
    flexGrow: 1,
    flex: '1 0 100%'
    // height: '100%',
    // overflow: 'hidden'
  },
  hero: {
    height: '100%',
    // minHeight: '80vh',
    flex: '0 0 auto',
    display: 'flex',
    justifyContent: 'center',
    alignItems: 'center',
    backgroundColor: theme.palette.background.paper,
    color: theme.palette.type === 'light' ? theme.palette.primary.dark : theme.palette.primary.main
  },
  text: {
    display: 'flex',
    flexDirection: 'column',
    alignItems: 'center',
    justifyContent: 'center'
  },
  title: {
    letterSpacing: '.7rem',
    textIndent: '.7rem',
    fontWeight: theme.typography.fontWeightLight,
    [theme.breakpoints.only('xs')]: {
      fontSize: 24,
      letterSpacing: '.1em',
      textIndent: '.1rem'

    },
    whiteSpace: 'nowrap',
    
    
  },
  h5: {
    paddingLeft: theme.spacing(1) * 4,
    paddingRight: theme.spacing(1) * 4,
    marginTop: theme.spacing(1),
    maxWidth: 600,
    textAlign: 'center',
    [theme.breakpoints.only('xs')]: {
      fontSize: 18
    }
  },
  content: {
    height: '100%',
    // paddingTop: theme.spacing(1) * 8,
    [theme.breakpoints.up('sm')]: {
      paddingTop: theme.spacing(1)
    }
  },
  button: {
    marginTop: theme.spacing(1) * 3
  },
  logo: {
    color: 'red',
    margin: `${theme.spacing(1) * 3}px 0 ${theme.spacing(1) * 4}px`,
    width: '100%',
    height: '40vw',
    maxHeight: 250
  },
  steps: {
    maxWidth: theme.spacing(1) * 130,
    margin: 'auto'
  },
  step: {
    padding: `${theme.spacing(1) * 3}px ${theme.spacing(1) * 2}px`
  },
  stepIcon: {
    marginBottom: theme.spacing(1)
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
    display: 'block',
    alignItems: 'center',
   
    paddingLeft: theme.spacing(4),
    backgroundColor: theme.palette.background.default,
  },
  img: {
    
    display: 'block',
    
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

  servis: {
    backgroundImage: 'url(/map-image.png)',
    backgroundRepeat: 'no-repeat',
    backgroundSize: 'cover',
    backgroundPosition: 'center',
    background: '#7ff0ce',
  },
})

class Home extends Component {
  constructor(props) {
    super(props);

    this.state = {
      value: 0,
      activeStep:0,
      expanded:false
    };
  }

  render(){

    const { classes } = this.props;
     const {theme} = this.props;

  
  const maxSteps = tutorialSteps.length;

   const handleNext = () => {
    const newstep = this.state.activeStep + 1;
    this.setState({...this.state, activeStep: newstep});
  };

  const handleBack = () => {
    const newstep = this.state.activeStep - 1;
    this.setState({...this.state, activeStep: newstep});
  };

  const handleStepChange = step => {
    this.setState({...this.state, activeStep: step});
   
  };
 

  return (
    <div className={classes.main}>
      
     

      <div className={classes.root}>

 <Paper square elevation={0} className={classes.header}>
        <Typography>{tutorialSteps[this.state.activeStep].label}</Typography>
      </Paper>
      <AutoPlaySwipeableViews
axis={theme.direction === 'rtl' ? 'x-reverse' : 'x'}
index={this.state.activeStep}
onChangeIndex={handleStepChange}
enableMouseEvents
>
        {tutorialSteps.map((step, index) => (
          <div key={step.label}>
            {Math.abs(this.state.activeStep - index) <= 2 ? (
              <img className={classes.img} src={step.imgPath} alt={step.label} />
            ) : null}
          </div>
        ))}
     </AutoPlaySwipeableViews>
      <MobileStepper
        steps={maxSteps}
        position="static"
        variant="text"
        activeStep={this.state.activeStep}
        nextButton={
          <Button size="small" onClick={handleNext} disabled={this.state.activeStep === maxSteps - 1}>
            Next
            {theme.direction === 'rtl' ? <KeyboardArrowLeft /> : <KeyboardArrowRight />}
          </Button>
        }
        backButton={
          <Button size="small" onClick={handleBack} disabled={this.state.activeStep === 0}>
            {theme.direction === 'rtl' ? <KeyboardArrowRight /> : <KeyboardArrowLeft />}
            Back
          </Button>
        }
      />

      
            <section id="services" class="board">
      <div className="container">
        <div className="row">
          <div className="col-lg-12 text-center">
            <h2 className="section-heading text-uppercase">HOW IT WORKS</h2>
            <h3 className="section-subheading text-muted">We have our customer as number one priority.</h3>
          </div>
        </div>
        <div className="row text-center">
          <div className="col-md-6">
            <span className="fa-stack fa-4x">
              <i className="fas fa-circle fa-stack-2x text-primary"></i>
              <i className="fas fa-shopping-cart fa-stack-1x fa-inverse"></i>
            </span>
            <h4 className="service-heading">E-Laundry</h4>
            <p className="text-muted">Request for laundry on our web or Mobile platform or call our customer line.</p>
          </div>
          <div className="col-md-6">
            <span className="fa-stack fa-4x">
              <i className="fas fa-circle fa-stack-2x text-primary"></i>
              <i className="fas fa-laptop fa-stack-1x fa-inverse"></i>
            </span>
            <h4 className="service-heading">We Pickup</h4>
            <p className="text-muted">Tell us where you are and when you'd like us to come get your laundry and we will be there! We promise to take good care of your laundry..</p>
          </div>
          <div className="col-md-6">
            <span className="fa-stack fa-4x">
              <i className="fas fa-circle fa-stack-2x text-primary"></i>
              <i className="fas fa-lock fa-stack-1x fa-inverse"></i>
            </span>
            <h4 className="service-heading">We Secure/Clean</h4>
            <p className="text-muted">Asuring a reliable and secure laundry service, We take absolute care of your laundry and dry cleaning with love. For that reason, your laundry is treated to the highest quality service. </p>
          </div>
           <div className="col-md-6">
            <span className="fa-stack fa-4x">
              <i className="fas fa-circle fa-stack-2x text-primary"></i>
              <i className="fas fa-briefcase fa-stack-1x fa-inverse"></i>
            </span>
            <h4 className="service-heading">We Deliver</h4>
            <p className="text-muted">Your laundry will certainly be delivered to you on time. Our valets will be at your doorstep to hand over your laundry cleaned and sparkling... with a SMILE!. </p>
          </div>
        </div>
      </div>
    </section>
    

    <div class="board ">
 
              <Card className={classes.servis}>
                <br />
                 <CardHeader
                 className={classes.title}
        title={  <Typography
                variant="h3"
                align="center"
                component="h1"
                color="inherit"
                gutterBottom
                className={classes.title}
              >
                {'REACT MOST WANTED'}
              </Typography>}
        subheader="September 14, 2016"
      />
              
            <div className={classes.cardsContent}>
              
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
        title="Shrimp and Chorizo Paella"
        subheader="September 14, 2016"
      />
      <CardMedia
        className={classes.media}
        image="/static/images/cards/paella.jpg"
        title="Paella dish"
      />
      <CardContent>
        <Typography variant="body2" color="textSecondary" component="p">
          This impressive paella is a perfect party dish and a fun meal to cook together with your
          guests. Add 1 cup of frozen peas along with the mussels, if you like.
        </Typography>
      </CardContent>
      <CardActions disableSpacing>
        <IconButton aria-label="add to favorites">
          <FavoriteIcon />
        </IconButton>
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
        title="Shrimp and Chorizo Paella"
        subheader="September 14, 2016"
      />
      <CardMedia
        className={classes.media}
        image="/static/images/cards/paella.jpg"
        title="Paella dish"
      />
      <CardContent>
        <Typography variant="body2" color="textSecondary" component="p">
          This impressive paella is a perfect party dish and a fun meal to cook together with your
          guests. Add 1 cup of frozen peas along with the mussels, if you like.
        </Typography>
      </CardContent>
      <CardActions disableSpacing>
        <IconButton aria-label="add to favorites">
          <FavoriteIcon />
        </IconButton>
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
        title="Shrimp and Chorizo Paella"
        subheader="September 14, 2016"
      />
      <CardMedia
        className={classes.media}
        image="/static/images/cards/paella.jpg"
        title="Paella dish"
      />
      <CardContent>
        <Typography variant="body2" color="textSecondary" component="p">
          This impressive paella is a perfect party dish and a fun meal to cook together with your
          guests. Add 1 cup of frozen peas along with the mussels, if you like.
        </Typography>
      </CardContent>
      <CardActions disableSpacing>
        <IconButton aria-label="add to favorites">
          <FavoriteIcon />
        </IconButton>
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
            </div>
            </Card>
            </div>

        <div className={classes.hero} class="board">
          <div className={classes.content}>
            <img src={Logo} alt="Material-UI Logo" className={classes.logo} />
            <div className={classes.text}>
              <Typography
                variant="h3"
                align="center"
                component="h1"
                color="inherit"
                gutterBottom
                className={classes.title}
              >
                {'REQUEST FOR A QUICK PICKUP'}
              </Typography>
              <Typography variant="h5" component="h2" color="inherit" gutterBottom className={classes.h5}>
                {'Our services is lightening quick from the moment your package is picked up. Satisfaction guaranteed!'}
              </Typography>
              <Button
                onClick={() => {
                  this.props.history.push('/signin')
                }}
                className={classes.button}
                variant="outlined"
                color="primary"
              >
                {'Get Started'}
              </Button>
            </div>

          </div>
        </div>
      </div>


<section id="contact" class="board contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 text-center">
            <h2 class="section-heading text-uppercase">Contact Us</h2>
            <h3 class="section-subheading text">Let us know how we can help you and also improve our service delivery.</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <form id="contactForm" name="sentMessage" novalidate="novalidate">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input class="form-control" id="name" type="text" placeholder="Your Name *" required="required" data-validation-required-message="Please enter your name."/>
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="email" type="email" placeholder="Your Email *" required="required" data-validation-required-message="Please enter your email address."/>
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <input class="form-control" id="phone" type="tel" placeholder="Your Phone *" required="required" data-validation-required-message="Please enter your phone number."/>
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <textarea class="form-control" id="message" placeholder="Your Message *" required="required" data-validation-required-message="Please enter a message."></textarea>
                    <p class="help-block text-danger"></p>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-lg-12 text-center">
                  <div id="success"></div>
                  <button id="sendMessageButton" class="btn btn-primary btn-xl text-uppercase" type="submit">Send Message</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

   
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <span class="copyright">Copyright &copy; Cleanary 2019</span>
          </div>
          <div class="col-md-4">
            <ul class="list-inline social-buttons">
              <li class="list-inline-item">
                <NavLink to="#">
                  <i class="fab fa-twitter"></i>
                </NavLink>
              </li>
              <li class="list-inline-item">
                <NavLink to="#">
                  <i class="fab fa-facebook-f"></i>
                </NavLink>
              </li>
              <li class="list-inline-item">
                <NavLink to="#">
                  <i class="fab fa-linkedin-in"></i>
                </NavLink>
              </li>
            </ul>
          </div>
          <div class="col-md-4">
            <ul class="list-inline quicklinks">
              <li class="list-inline-item">
                <NavLink to="#">Privacy Policy</NavLink>
              </li>
              <li class="list-inline-item">
                <NavLink to="#">Terms of Use</NavLink>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>


    </div>
  )}
}

export default withStyles(styles, { withTheme: true })(Home)
