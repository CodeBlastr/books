import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import {browserHistory} from 'react-router';
import MyGlobleSetting from '../components/MyGlobleSetting';
import Loading from '../components/Loading';
import Alert from '../components/Alert';


class AddAccount extends Component {
    constructor(props){
        super(props);
        this.state = {accountTitle: this.props.account.name + " (" + this.props.account.mask + ")", accountType: this.props.account.type, accountCredentialId: this.props.credential.id};
        this.handleChange1 = this.handleChange1.bind(this);
        this.handleChange2 = this.handleChange2.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }
    handleChange1(e){ // give this a better name
        this.setState({
            accountTitle: e.target.value
        })
    }
    handleChange2(e){ // give this a better name
        this.setState({
            accountType: e.target.value
        })
    }

    handleSubmit(e){
        e.preventDefault();

        ReactDOM.render(<Loading />, document.getElementById('loading'));

        const accounts = {
            title: this.state.accountTitle,
            type: this.state.accountType,
            credential_id: this.state.accountCredentialId
        }
        let uri = MyGlobleSetting.url + '/api/accounts';

        axios.post(uri, accounts).then((response) => {
            browserHistory.push('/accounts');
            ReactDOM.render( <Alert autodismiss="2000" status="alert-success" message={ response.data } />, document.getElementById('loading'));
        }).catch(function (error) {
            ReactDOM.render( <Alert status="alert-danger" message={ error.toString() } />, document.getElementById('loading'));
        });
    }


    render() {

        return (
            <div>
                <h1>Create Account</h1>
                <form onSubmit={this.handleSubmit}>
                    <input type="hidden" className="form-control" value={this.props.credential.id} />
                    <div className="row">
                        <div className="col-md-12">
                            <div className="form-group">
                                <label>Account Nickname:</label>
                                <input type="text" className="form-control" onChange={this.handleChange1} value={this.props.account.name + " (" + this.props.account.mask + ")"} />
                            </div>
                        </div>
                    </div>
                    <div className="row">
                        <div className="col-md-12">
                            <div className="form-group">
                                <select className="form-control col-md-6" onChange={this.handleChange2}>
                                    <option value={ this.props.account.type }>{ this.props.account.type }</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div className="form-group">
                        <button className="btn btn-primary">Add Account</button>
                    </div>
                </form>
            </div>
        )
    }
}
export default AddAccount;