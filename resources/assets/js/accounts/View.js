import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import { Link } from 'react-router';
import MyGlobleSetting from '../components/MyGlobleSetting';
import Loading from '../components/Loading';


class ViewAccount extends Component {
    constructor(props) {
        super(props);
        ReactDOM.render(<Loading />, document.getElementById('loading'));
    }


    componentDidMount(){
        axios.get(MyGlobleSetting.url + '/api/accounts/' + this.props.params.id)
            .then(response => {
                this.setState({ account: response.data.account});
                ReactDOM.render(<div />, document.getElementById('loading'));
            }).catch(function (error) {
                console.log(error);
            });
    }

    accountProfile(){
        if(this.state){
            return <div className="col-md-12">
                        <h1>{ this.state.account.title } <small className="pull-right">put balance here</small></h1>
                        <table>
                            <tbody>
                                <tr>
                                    <td>
                                        Put TransactionRow component here
                                    </td>
                                </tr>
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