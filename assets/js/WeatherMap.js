import React from 'react';
import ReactDOM from 'react-dom';
import Navigation from "./Components/Navigation";
import Map from "./Components/Map";
import History from "./Components/History";
import Statistics from "./Components/Statistics";

class WeatherMap extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            currentPage: 'map'
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
            <div>
                <Navigation updateCurrentPageHandler={this.updateCurrentPage.bind(this)} />
                <Map display={currentPage === 'map'}/>
                <History display={currentPage === 'history'}/>
                <Statistics display={currentPage === 'statistics'}/>
            </div>
        );
    }
}

ReactDOM.render(<WeatherMap />, document.getElementById('root'));
