import React, {Component} from 'react';
import { Router, Route, Link } from 'react-router';

class Master extends Component {
    render(){
        return (
            <div className="container">
                <nav className="navbar navbar-default">
                    <div className="container-fluid">
                        <div className="navbar-header">
                            <a className="navbar-brand" href="http://books.wholesale360.com">stuff (Books)</a>
                        </div>
                        <ul className="nav navbar-nav">
                            <li><Link to="/">Home</Link></li>
                            <li><Link to="add-item">Create Account</Link></li>
                            <li><Link to="display-item">Accounts</Link></li>
                        </ul>
                    </div>
                </nav>
                <div>
                    {this.props.children}
                </div>
            </div>
        )
    }
}
export default Master;