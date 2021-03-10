import React, { Component } from 'react'
import ReactDOM from 'react-dom'
import { Button, Carousel, Container, Row, Col, Card } from 'react-bootstrap';
import {
    BrowserRouter as Router,
    Switch,
    Route,
    Link, 
    useHistory,
} from "react-router-dom";
import Header from './site/partials/header/header';
import Footer from './site/partials/footer/footer';
import Search from './site/search/search.jsx';
import Searchsingle from './site/searchsingle/searchsingle';
import Home from './site/home';
import Feedback from './site/feedback/feedback.jsx';



class App extends Component {
    
    render() {
        return (
          
          <div className="App">
          
            <Container className="MainAppFluid" fluid>
              
            <Router basename={"demo/library"} assetPath={app_url+"/public/"} >
              <Header/>
              <Switch>
                    <Route exact path="/" component={Home} />
                    <Route path="/search" component={Search} />
                    <Route path="/searchsingle" component={Searchsingle} />
                    <Route path="/resource" component={Searchsingle} />  
                    <Route path="/feedback" component={Feedback} />  
                </Switch>
               <Footer/>
            </Router>

            </Container>
          </div>
        )
    }
}

export default App
