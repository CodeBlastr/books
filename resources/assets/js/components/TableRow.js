import React, { Component } from 'react';
import { Link, browserHistory } from 'react-router';
import MyGlobleSetting from './MyGlobleSetting';


class TableRow extends Component {
    constructor(props) {
        super(props);
        this.data = JSON.parse(this.props.data);
        this.handleSubmit = this.handleSubmit.bind(this);
    }
    handleSubmit(event) {
        event.preventDefault();
        let uri = MyGlobleSetting.url + `/api/accounts/${this.data.id}`;
        axios.delete(uri);
        window.location.reload();
    }
    render() {
        return (
            <tr>
                <td>
                    {this.data.title}
                </td>
                <td>
                    {this.data.type}
                </td>
                <td>
                    {this.data.detail}
                </td>
                <td>
                    <form onSubmit={this.handleSubmit}>
                        <Link to={"accounts/"+this.data.id} className="btn btn-primary">View</Link>
                        <Link to={"accounts/edit/"+this.data.id} className="btn btn-primary">Edit</Link>
                        <input type="submit" value="Delete" className="btn btn-danger"/>
                    </form>
                </td>
            </tr>
        );
    }
}


export default TableRow;