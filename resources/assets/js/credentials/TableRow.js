import React, { Component } from 'react';
import { Link, browserHistory } from 'react-router';
import MyGlobleSetting from '../components/MyGlobleSetting';


class TableRow extends Component {
    constructor(props) {
        super(props);
        this.data = JSON.parse(this.props.data);
        this.handleSubmit = this.handleSubmit.bind(this);
    }
    handleSubmit(event) {
        event.preventDefault();
        let uri = MyGlobleSetting.url + `/api/credentials/${this.data.id}`;
        axios.delete(uri);
        window.location.reload();
    }
    render() {
        const rows = [];
        const account = this.props.account;

        this.data.public_data.metadata.accounts.forEach((account) => {
            rows.push(
                <CredentialButtons account={account} key={account.id} />
            )
            });
        return (
            <tr>
                <td>
                    {this.data.name}
                </td>
                <td>
                    <form onSubmit={this.handlesubmit}>
                        <table className="table table-bordered">
                            <tbody>
                                {rows}
                            </tbody>
                        </table>
                    </form>
                </td>
            </tr>
        );
    }
}


export default TableRow;



class CredentialButtons extends Component {
    render() {
        const account = this.props.account;
        return (
            <tr>
                <td>{ account.name } ( { account.mask } )</td>
                <td className="text-center"><Link to = { "credentials/link/" + account.id } className="btn btn-primary">Link Connection</Link></td>
                <td className="text-center"><input type="submit" value="Delete" className="btn btn-danger"/>



            {/* <!-- Button trigger modal --> */}
        <button type="button" className="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Launch demo modal
        </button>

        {/* <!-- Modal --> */}
        <div className="modal fade" id="exampleModal" tabIndex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div className="modal-dialog" role="document">
            <div className="modal-content">
            <div className="modal-header">
            <h5 className="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" className="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div className="modal-body">
    ...
    </div>
        <div className="modal-footer">
            <button type="button" className="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" className="btn btn-primary">Save changes</button>
        </div>
        </div>
        </div>
        </div>




        </td>
            </tr>
        );
    }
}

;