import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import MyGlobleSetting from './MyGlobleSetting';

export default class Example extends Component {
    constructor(props) {
        super(props);
        this.state = {response: ''};
    }
    componentDidMount(){

        console.log('we got here');
        axios.get(MyGlobleSetting.url + '/api/app')
            .then(response => {
            this.setState({ app: response.data });
        console.log(this.state.app)
        console.log('then we got here');
    })
    .catch(function (error) {
            console.log(error);
        })
    }

    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col-md-8 col-md-offset-2">
                        <div className="panel panel-default">
                            <div className="panel-heading">Example Component</div>

                            <div className="panel-body">
                                I'm an example component!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

if (document.getElementById('example')) {
    ReactDOM.render(<Example />, document.getElementById('example'));
}
