import React from 'react';
import NavigationLink from "./NavigationLink";

class Navigation extends React.Component {

    constructor(props) {
        super(props);

        this.state = {
            currentPage: 'map',
            links: [
                'Map',
                'History',
                'Statistics'
            ],
        };

        this.render = this.render.bind(this);
        this.updateCurrentPage = this.updateCurrentPage.bind(this);
    }

    updateCurrentPage(page) {
        this.setState({
            currentPage: page
        });
        this.props.updateCurrentPageHandler(page);
    }

    render() {
        const links = this.state.links;

        return (
            <nav className="navbar navbar-expand-lg navbar-light bg-light">
                <a className="navbar-brand" href="#">WeatherMap</a>
                <div className="collapse navbar-collapse">
                    <ul className="navbar-nav mr-auto">
                        {links.map(
                            (label, key) => {
                                return <NavigationLink
                                    key={key}
                                    name={label.toLocaleLowerCase()}
                                    label={label}
                                    active={this.state.currentPage === label.toLowerCase()}
                                    updateCurrentPageHandler={this.updateCurrentPage.bind(this)}
                                />
                            }
                        )}
                    </ul>
                </div>
            </nav>
        );
    }
}

export default Navigation;
