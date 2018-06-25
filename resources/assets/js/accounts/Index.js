import React, {Component} from 'react';
import axios from 'axios';
import { Link } from 'react-router';
import TableRow from '../components/TableRow'; // @todo move this to accounts/TableRow
import CredentialRow from '../credentials/CredentialRow';
import MyGlobleSetting from '../components/MyGlobleSetting';

class ListAccounts extends Component {
    constructor(props) {
        super(props);
        this.state = {value: '', accounts: ''};
    }
    componentDidMount(){
        axios.get(MyGlobleSetting.url + '/api/accounts').then(response => {
            this.setState({ accounts: response.data });
        }).catch(function (error) {
            console.log(error);
        })
        // going to need to add filters on this api endpoint
        axios.get(MyGlobleSetting.url + '/api/credentials').then(response => {
            this.setState({ credentials: response.data });
        }).catch(function (error) {
            console.log(error);
        })
    }
    tabRow(){
        if(this.state.accounts instanceof Array){
            return this.state.accounts.map(function(object, i){
                return <TableRow key={i} data={JSON.stringify(object)} />
            })
        }
    }
    credentialRow(){
        if(this.state.credentials instanceof Array){
            return this.state.credentials.map(function(object, i){
                return <CredentialRow key={i} data={JSON.stringify(object)} />
            })
        }
    }


    render(){
        return (

            <div>
                <h1>Accounts</h1>
                <p>Next step is clicking on an account to view the transactions</p>
                <p>Then on to downloading transactions.</p>
                <div className="row">
                    <div className="col-md-10"></div>
                    <div className="col-md-2">
                        <Link to="/add-item">Create Account</Link>
                        <button id="link-button">Link Account</button>
                    </div>
                </div><br />
                <table className="table table-hover">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Account Title</td>
                            <td>Account Body</td>
                            <td width="200px">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        {this.tabRow()}
                    </tbody>
                </table>

                <h1>Unlinked Connections</h1>

                <table className="table table-hover">
                    <thead>
                    <tr>
                        <td>Name</td>
                        <td>Accounts</td>
                    </tr>
                    </thead>
                    <tbody>
                        {this.credentialRow()}
                    </tbody>
                </table>
            </div>
        )
    }
}
export default ListAccounts;