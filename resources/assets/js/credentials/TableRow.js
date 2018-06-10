import React, { Component } from 'react';
import { Link, browserHistory } from 'react-router';
import MyGlobleSetting from '../components/MyGlobleSetting';


class TableRow extends Component {
    constructor(props) {
        super(props);
        this.data = JSON.parse(this.props.data);
        console.log(this.data);
        this.handleSubmit = this.handleSubmit.bind(this);
    }
    handleSubmit(event) {
        event.preventDefault();
        let uri = MyGlobleSetting.url + `/api/credentials/${this.data.id}`;
        axios.delete(uri);
        window.location.reload();
    }
    render() {
        return (
            <tr>
                <td>
                    {this.data.name}
                </td>
                    <td>
                    {this.data.status}
                </td>
                <td>
                    {this.data.data}
                </td>
                <td>
                    <form onSubmit={this.handleSubmit}>
                        <Link to={"credentials/edit/"+this.data.id} className="btn btn-primary">Edit</Link>
                        <input type="submit" value="Delete" className="btn btn-danger"/>
                    </form>
                </td>
            </tr>
        );
    }
}


export default TableRow;