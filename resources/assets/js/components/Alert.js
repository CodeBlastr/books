import React, {Component} from 'react';
import ReactDOM from 'react-dom';


class Alert extends Component {

    componentDidMount() {
        if (this.props.autodismiss) {
            const time = this.props.autodismiss > 1 ? this.props.autodismiss : 3000

            setTimeout(function () {
                this.dismiss();
            }.bind(this), time);
        }
    }

    dismiss() {
        ReactDOM.render( <div />, document.getElementById('loading'));
    }

    render() {
        const status = this.props.status ? this.props.status : "alert-warning";

        return (
            <div className="loading-overlay" onClick={ this.dismiss }>
                <div className={ "alert " + status } role="alert">
                    { this.props.message }
                </div>
            </div>
        )
    }
}
export default Alert;