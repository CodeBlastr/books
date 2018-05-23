import React, {Component} from 'react';
import axios from 'axios';
import { Link } from 'react-router';
import MyGlobleSetting from './MyGlobleSetting';


class UpdateAccount extends Component {
    constructor(props) {
        super(props);
        this.state = {title: '', body: ''};
        this.handleChange1 = this.handleChange1.bind(this);
        this.handleChange2 = this.handleChange2.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }


    componentDidMount(){
        axios.get(MyGlobleSetting.url + `/api/accounts/${this.props.params.id}/edit`)
            .then(response => {
            this.setState({ title: response.data.title, body: response.data.body });
    })
    .catch(function (error) {
            console.log(error);
        })
    }
    handleChange1(e){
        this.setState({
            title: e.target.value
        })
    }
    handleChange2(e){
        this.setState({
            body: e.target.value
        })
    }


    handleSubmit(event) {
        event.preventDefault();
        const accounts = {
            title: this.state.title,
            body: this.state.body
        }
        let uri = MyGlobleSetting.url + '/api/accounts/'+this.props.params.id;
        axios.patch(uri, accounts).then((response) => {
            this.props.history.push('/display-item');
    });
    }
    render(){
        return (
            <div>
            <h1>Update Account</h1>
        <div className="row">
            <div className="col-md-10"></div>
            <div className="col-md-2">
            <Link to="/display-item" className="btn btn-success">Return to Account</Link>
        </div>
        </div>
        <form onSubmit={this.handleSubmit}>
    <div className="form-group">
            <label>Account Title</label>
        <input type="text"
        className="form-control"
        value={this.state.title}
        onChange={this.handleChange1} />
    </div>


        <div className="form-group">
            <label name="account_body">Account Body</label>
        <textarea className="form-control"
        onChange={this.handleChange2} value={this.state.body}></textarea>
        </div>


        <div className="form-group">
            <button className="btn btn-primary">Update</button>
            </div>
            </form>
            </div>
    )
    }
}
export default UpdateAccount;