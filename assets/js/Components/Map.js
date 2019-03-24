import React from 'react';

class Map extends React.Component {
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
                Map
            </div>
        );
    }
}

export default Map;
