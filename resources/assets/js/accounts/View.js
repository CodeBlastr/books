import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import { Link } from 'react-router';
import MyGlobleSetting from '../components/MyGlobleSetting';
import Loading from '../components/Loading';
import TransactionRow from '../transactions/TransactionRow';


class ViewAccount extends Component {
    constructor(props) {
        super(props);
        ReactDOM.render(<Loading />, document.getElementById('loading'));
    }


    componentDidMount(){
        axios.get(MyGlobleSetting.url + '/api/accounts/' + this.props.params.id)
            .then(response => {
                this.setState({
                    account: response.data.account,
                    transactions: response.data.transactions
                });
                ReactDOM.render(<div />, document.getElementById('loading'));
            }).catch(function (error) {
                console.log(error);
            });
    }

    accountProfile(){
        if(this.state){

            const transactions = [];

            this.state.transactions.forEach((transaction) => {
                transactions.push( <TransactionRow transaction={ transaction } key={ transaction.id } />)
            });

            return <div className="col-md-12">
                        <h1>{ this.state.account.title } <small className="pull-right">put balance here</small></h1>
                        <table className="table table-striped">
                            <thead>
                                <tr>
                                    <th>Payee</th>
                                    <th>Payment</th>
                                    <th>Credit</th>
                                </tr>
                            </thead>
                            <tbody>
                                { transactions }
                            </tbody>
                        </table>
                    </div>;
        }
    }


    render(){

        return (
            <div>
                { this.accountProfile() }
            </div>
        )
    }
}
export default ViewAccount;