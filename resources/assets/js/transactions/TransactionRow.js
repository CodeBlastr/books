import React, { Component } from 'react';
import { Link, browserHistory } from 'react-router';
import MyGlobleSetting from '../components/MyGlobleSetting';


class TransactionRow extends Component {

    constructor(props) {
        super(props);
        //console.log(this.props);
    }

    render() {

        return (
            <tr>
                <td>
                    <h4>{ this.props.transaction.payee }</h4>
                </td>
                <td> { new Intl.NumberFormat('en', { style: 'currency', currency: 'USD' }).format(this.props.transaction.payment) } </td>
                <td> { new Intl.NumberFormat('en', { style: 'currency', currency: 'USD' }).format(this.props.transaction.credit) } </td>
            </tr>
        );
    }
}


export default TransactionRow;
