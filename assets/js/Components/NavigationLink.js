import React from 'react';

class NavigationLink extends React.Component {

    constructor(props) {
        super(props);

        this.state = {
            classes: ['nav-item', 'active'],
        };

        this.handleClick = this.handleClick.bind(this);
        this.render = this.render.bind(this);
    }

    handleClick() {
        this.props.updateCurrentPageHandler(this.props.name);
    }

    render() {
        if (!this.props.active) {
            delete this.state.classes[1];
        }

        const classes = this.state.classes;
        const label = this.props.label;

        return (
            <li className={classes.join(' ')}>
                <a className="nav-link" onClick={this.handleClick} href="javascript:void(0);">{label}</a>
            </li>
        );
    }
}

export default NavigationLink;
