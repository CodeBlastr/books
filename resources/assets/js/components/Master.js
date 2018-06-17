import React, {Component} from 'react';
import { Router, Route, Link } from 'react-router';

class Master extends Component {

    constructor(props) {
        super(props);

        //this.props.handleOverlay = this.handleOverlay.bind(this);
    }

    //handleOverlay(event) {
    //    console.log(event);
    //    var loadingOverlay = document.getElementById('loading-overlay');
    //    loadingOverlay.style.display = "block";
    //}


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
                            <li><Link to="/accounts/add">Create Account</Link></li>
                            <li><Link to="/accounts">Accounts</Link></li>
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