import React from 'react';
import ReactDOM from 'react-dom';
import Navigation from "./Components/Navigation";

class WeatherMap extends React.Component {
    constructor(props) {
        super(props);

        this.state = {

        };

        this.updateCurrentPage = this.updateCurrentPage.bind(this);
    }

    updateCurrentPage(page) {
        this.setState({
            currentPage: page
        });
    }

    render() {
        const currentPage = this.state.currentPage;

        return (
            <Navigation updateCurrentPageHandler={this.updateCurrentPage.bind(this)} />
        );
    }
}

ReactDOM.render(<WeatherMap />, document.getElementById('root'));
