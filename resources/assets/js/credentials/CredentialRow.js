import React, { Component } from 'react';
import { Link, browserHistory } from 'react-router';
import MyGlobleSetting from '../components/MyGlobleSetting';
import AddAccount from '../accounts/Add';


class CredentialRow extends Component {

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
        const credentialAccounts = [];
        const account = this.props.account;
        const credential = JSON.parse(this.props.data);

        this.data.public_data.metadata.accounts.forEach((account) => {
            if (account._status !== 'used') {
                credentialAccounts.push( <AddAccount credential={ credential } account={ account } key={ account.id } />)
            }
        });

        return (
            <tr>
                <td>
                    <h4>{this.data.name} </h4>
                </td>
                <td>
                    <button type="button" className="btn btn-primary" data-toggle="modal" data-target={"#addAccountModal-" + this.data.id }>Link Connection</button>
                    <div className="modal fade" id={"addAccountModal-" + this.data.id } tabIndex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div className="modal-dialog" role="document">
                            <div className="modal-content">
                                <div className="modal-header">
                                    <h2 className="modal-title pull-left" id="exampleModalLabel">Link {this.data.name} Accounts</h2>
                                    <button type="button" className="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div className="modal-body">
                                    { credentialAccounts }
                                </div>
                                <div className="modal-footer">
                                    <button type="button" className="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        );
    }
}


export default CredentialRow;
