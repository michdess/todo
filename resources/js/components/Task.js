import React from "react";
import moment from 'moment';
export class Task extends React.Component {
    render() {
        return (
            <div className="flex mt-2 justify-between items-center p-3 rounded shadow-lg bg-white">
                <div className="flex flex-col">
                    <p className="capitalize text-xl text-gray-900">{this.props.task.body}</p>
                    <p className="text-sm text-gray-600">DUE: {moment(this.props.task.due).format('DD-MM-YYYY')}</p>
                </div>
                <p>X</p>
                <p>Done</p>
            </div>
        );
    }
}

