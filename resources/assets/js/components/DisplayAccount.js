import React, {Component} from 'react';
import axios from 'axios';
import { Link } from 'react-router';
import TableRow from './TableRow';
import MyGlobleSetting from './MyGlobleSetting';

class DisplayAccount extends Component {
    constructor(props) {
        super(props);
        this.state = {value: '', accounts: ''};
        console.log('asldkjfalsdkfjasdf');
    }
    componentDidMount(){
        axios.get(MyGlobleSetting.url + '/api/accounts')
            .then(response => {
            this.setState({ accounts: response.data });
    })
    .catch(function (error) {
            console.log(error);
        })
    }
    tabRow(){
        if(this.state.accounts instanceof Array){
            return this.state.accounts.map(function(object, i){
                return ;

            })
        }
    }


    render(){
        return (
            <div>
                <h1>Accounts</h1>
                <div className="row">
                    <div className="col-md-10"></div>
                    <div className="col-md-2">
                        <Link to="/add-item">Create Account</Link>
                    </div>
                </div><br />
                <table className="table table-hover">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Account Title</td>
                            <td>Account Body</td>
                            <td width="200px">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        {this.tabRow()}
                    </tbody>
                </table>
            </div>
        )
    }
}
export default DisplayAccount;