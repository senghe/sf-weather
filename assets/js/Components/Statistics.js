import React from 'react';

class Statistics extends React.Component {
    constructor(props) {
        super(props);

        this.render = this.render.bind(this);
    }

    render() {
        if (!this.props.display) {
            return '';
        }

        return (
            <div>
                Statistics
            </div>
        );
    }
}

export default Statistics;
