require('./bootstrap');
import React from 'react';
import { render } from 'react-dom';
import { Router, Route, browserHistory } from 'react-router';


import Master from './components/Master';
import CreateAccount from './components/CreateAccount';
import DisplayAccount from './components/DisplayAccount';
import UpdateAccount from './components/UpdateAccount';
import Example from './components/Example';


render(
    <Router history={browserHistory}>
        <Route path="/" component={Master} >
        <Route path="/add-item" component={CreateAccount} />
        <Route path="/display-item" component={DisplayAccount} />
        <Route path="/edit/:id" component={UpdateAccount} />
        <Route path="/example" component={Example} />
        </Route>
    </Router>,

    document.getElementById('crud-app')
);