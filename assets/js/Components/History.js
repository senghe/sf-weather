import React from 'react';

class History extends React.Component {
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
                History
            </div>
        );
    }
}

export default History;
