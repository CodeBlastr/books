import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import { Link } from 'react-router';
import MyGlobleSetting from '../components/MyGlobleSetting';
import Loading from '../components/Loading';
import Alert from '../components/Alert';


class EditAccount extends Component {
    constructor(props) {
        super(props);
        this.state = {title: '', description: ''};
        this.handleInputChange = this.handleInputChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
    }


    componentDidMount(){
        axios.get(MyGlobleSetting.url + `/api/accounts/${this.props.params.id}/edit`)
            .then(response => {
            this.setState({ title: response.data.title, description: response.data.description });
    })
    .catch(function (error) {
            console.log(error);
        })
    }

    handleInputChange(event) {
        const target = event.target;
        const value = target.type === 'checkbox' ? target.checked : target.value;
        const name = target.name;

        this.setState({
            [name]: value
        });
    }


    handleSubmit(event) {
        event.preventDefault();
        ReactDOM.render(<Loading />, document.getElementById('loading'));

        const accounts = {
            title: this.state.title,
            description: this.state.description
        }
        let uri = MyGlobleSetting.url + '/api/accounts/'+this.props.params.id;
        axios.patch(uri, accounts).then((response) => {
            this.props.history.push('/accounts');
            ReactDOM.render( <Alert autodismiss="2000" status="alert-success" message={ response.data } />, document.getElementById('loading'));
            ReactDOM.render( <div />, document.getElementById("credential-" + this.props.account.id));
        }).catch(function (error) {
            ReactDOM.render( <Alert status="alert-danger" message={ error.toString() } />, document.getElementById('loading'));
        });
    }
    render(){
        return (
            <div>
                <h1>Update Account</h1>
                <div className="row">
                    <div className="col-md-10"></div>
                    <div className="col-md-2">
                        <Link to="/accounts" className="btn btn-success">Return to Account</Link>
                    </div>
                </div>
                <form onSubmit={this.handleSubmit}>
                    <div className="form-group">
                        <label>Account Title</label>
                        <input name="title" type="text" className="form-control" value={this.state.title} onChange={this.handleInputChange} />
                    </div>
                    <div className="form-group">
                        <label name="account_body">Account Body</label>
                        <textarea name="description" className="form-control" onChange={this.handleInputChange} value={this.state.description}></textarea>
                    </div>
                    <div className="form-group">
                        <button className="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        )
    }
}
export default EditAccount;