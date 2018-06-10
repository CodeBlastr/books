require('./bootstrap');
import React from 'react';
import { render } from 'react-dom';
import { Router, Route, browserHistory } from 'react-router';


import Master from './components/Master';
import CreateAccount from './components/CreateAccount';
import ListAccounts from './accounts/Index';
import EditAccount from './accounts/Edit';
import Example from './components/Example';


render(
    <Router history={browserHistory}>
        <Route path="/" component={Master} >
        <Route path="/add-item" component={CreateAccount} />
        <Route path="/accounts" component={ListAccounts} />
        <Route path="/accounts/edit/:id" component={EditAccount} />
        <Route path="/example" component={Example} />
        </Route>
    </Router>,

    document.getElementById('crud-app')
);