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
                <td className="text-center"><input type="submit" value="Delete" className="btn btn-danger"/></td>
            </tr>
        );
    }
}

;