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
        const credential = this.props.data;

        this.data.public_data.metadata.accounts.forEach((account) => {
            rows.push(
                <CredentialButtons credential={credential} account={account} key={account.id} />
            )
            });
        return (
            <tr>
                <td>
                    {this.data.name}
                </td>
                <td>
                    <table className="table table-bordered">
                        <tbody>
                            {rows}
                        </tbody>
                    </table>
                </td>
            </tr>
        );
    }
}


export default TableRow;



import AddAccount from '../accounts/Add';

class CredentialButtons extends Component {
    render() {
        const account = this.props.account;
        const credential = JSON.parse(this.props.credential);
        return (
            <tr>
                <td>{ account.name } ( { account.mask } )</td>
                <td className="text-center">
                    <button type="button" className="btn btn-primary" data-toggle="modal" data-target={"#addAccountModal-" + account.id }>Link Connection</button>
                    <div className="modal fade" id={"addAccountModal-" + account.id } tabIndex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div className="modal-dialog" role="document">
                            <div className="modal-content">
                                <div className="modal-header">
                                    <h5 className="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div className="modal-body">
                                    <AddAccount credential={credential} account={account} key={account.id} />
                                </div>
                                <div className="modal-footer">
                                    <button type="button" className="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" className="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td className="text-center"><input type="submit" value="Delete" className="btn btn-danger"/></td>
            </tr>
        );
    }
}

;