import React, {Component} from 'react';
import {browserHistory} from 'react-router';
import MyGlobleSetting from './MyGlobleSetting';


class CreateAccount extends Component {
    constructor(props){
        super(props);
        this.state = {accountTitle: '', accountBody: ''};
        
        this.handleChange1 = this.handleChange1.bind(this);
        this.handleChange2 = this.handleChange2.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }
    handleChange1(e){
        this.setState({
            accountTitle: e.target.value
        })
    }
    handleChange2(e){
        this.setState({
            accountBody: e.target.value
        })
    }
    handleSubmit(e){
        e.preventDefault();
        const accounts = {
            title: this.state.accountTitle,
            body: this.state.accountBody
        }
        let uri = MyGlobleSetting.url + '/api/accounts';
        axios.post(uri, accounts).then((response) => {
            browserHistory.push('/display-item');
    });
    }


    render() {
        return (
            <div>
                <h1>Create Account</h1>
                <form onSubmit={this.handleSubmit}>
                    <div className="row">
                        <div className="col-md-6">
                            <div className="form-group">
                                <label>Account Title:</label>
                                <input type="text" className="form-control" onChange={this.handleChange1} />
                            </div>
                        </div>
                    </div>
                    <div className="row">
                        <div className="col-md-6">
                            <div className="form-group">
                                <label>Account Body:</label>
                                <textarea className="form-control col-md-6" onChange={this.handleChange2}></textarea>
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
export default CreateAccount;