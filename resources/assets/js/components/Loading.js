import React, {Component} from 'react';


class Loading extends Component {
    render() {
        return (
            <div className="col-md-12 text-center loading-overlay">
                <span className="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span>
            </div>
        )
    }
}
export default Loading;