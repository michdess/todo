import React from "react";
import moment from 'moment';
export class Task extends React.Component {
    render() {
        const isCompleted = this.props.task.completed
        let status;

        if (isCompleted != null) {
          status =  <div onClick={() => this.props.complete(this.props.task.id, this.props.task.completed)} className="cursor-pointer rounded-full bg-green-500 text-white w-8 h-8 flex items-center justify-center">✓</div>
        } else {
          status = <div onClick={() => this.props.complete(this.props.task.id, this.props.task.completed)} className="cursor-pointer rounded-full bg-white border-2 border-gray-300 text-white w-8 h-8 flex items-center justify-center"></div>
        }
        return (
            <div className="flex mt-2 justify-between items-center p-3 rounded shadow-lg bg-white">
                <div className="flex items-center">
                    {status}
                    <div className="flex flex-col ml-3">
                        <p className="capitalize text-xl text-gray-900">{this.props.task.body}</p>
                        <p className="text-sm text-gray-600">DUE: {moment(this.props.task.due).format('DD-MM-YYYY')}</p>
                    </div>
                </div>
                <div className="flex items-center">
                    <p onClick={() => this.props.delete(this.props.task.id)} className="cursor-pointer rounded-full bg-red-500 text-white w-8 h-8 flex items-center justify-center">🗑️</p>
                </div>
            </div>
        );
    }
}

