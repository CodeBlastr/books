import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import {browserHistory} from 'react-router';
import MyGlobleSetting from '../components/MyGlobleSetting';
import Loading from '../components/Loading';
import Alert from '../components/Alert';


class AddAccount extends Component {
    constructor(props){
        super(props);
        this.state = {
            title: this.props.account.name + " (" + this.props.account.mask + ")",
            type: this.props.account.type,
            detail: this.props.account.subtype,
            credential_id: this.props.credential.id,
            plaid_id: this.props.account.id
        };
        this.handleInputChange = this.handleInputChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }

    handleInputChange(event) {
        const target = event.target;
        const value = target.type === 'checkbox' ? target.checked : target.value;
        const name = target.name;

        this.setState({
            [name]: value
        });
    }

    handleSubmit(e){
        e.preventDefault();

        ReactDOM.render(<Loading />, document.getElementById('loading'));

        const account = {
            title: this.state.title,
            type: this.state.type,
            detail: this.state.detail,
            credential_id: this.state.credential_id,
            plaid_id: this.state.plaid_id
        }
        let uri = MyGlobleSetting.url + '/api/accounts';
        
        axios.post(uri, account).then((response) => {
            browserHistory.push('/accounts');
            ReactDOM.render( <Alert autodismiss="2000" status="alert-success" message={ response.data } />, document.getElementById('loading'));
            ReactDOM.render( <div />, document.getElementById("credential-" + this.props.account.id));
        }).catch(function (error) {
            ReactDOM.render( <Alert status="alert-danger" message={ error.toString() } />, document.getElementById('loading'));
        });
    }


    render() {

        return (
            <div id={"credential-" + this.props.account.id }>
                <form onSubmit={this.handleSubmit}>
                    <div className="row">
                        <div className="col-md-12">
                            <div className="form-group">
                                <label>Account Nickname:</label>
                                <input name="title" type="text" className="form-control" onChange={this.handleInputChange} value={ this.state.title } />
                            </div>
                        </div>
                    </div>
                    <div className="row">
                        <div className="col-md-12">
                            <div className="form-group">
                                <select name="type" className="form-control col-md-6" onChange={this.handleInputChange}>
                                    <option value={ this.state.type }>{ this.state.type }</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div className="row">
                        <div className="col-md-12">
                            <div className="form-group">
                                <select name="detail" className="form-control col-md-6" onChange={this.handleInputChange}>
                                    <option value={ this.state.detail }>{ this.state.detail }</option>
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