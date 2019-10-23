import React from "react";

export class Task extends React.Component {
    render() {
        return (
            <div className="flex mt-2 justify-between items-center p-3 rounded shadow-lg bg-white">
                <div className="flex flex-col">
                    <p className="text-xl text-gray-900">The actual task</p>
                    <p className="text-sm text-gray-600">DUE: 12/12/19</p>
                </div>
                <p>X</p>
                <p>Done</p>
            </div>
        );
    }
}

