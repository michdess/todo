import React from 'react';
import ReactDOM from 'react-dom';
import moment from 'moment';
import { Task } from "./Task";

function Todos() {
    return (
        <div className="w-full md:w-1/2 lg:w-1/3 p-3">
            <div className="bg-white">
                    <div className="p-3 bg-blue-500"> 
                        <div className="mb-6 flex items-baseline justify-between">
                            <div className="flex items-center">
                                <p className="text-6xl text-green-200">{moment().format('D')}</p>
                                <div className="ml-4 font-semibold text-gray-200 tracking-wide leading-tight">
                                    <p className="text-2xl">{moment().format('MMMM')}</p>
                                    <p>{moment().format('Y')}</p>
                                </div>
                            </div>
                            <p className="text-xl text-gray-200">{moment().format('dddd')}</p>
                        </div>
                    </div>
                    <div className="p-3">
                        <div className="-mt-12 p-3 bg-white">
                            <input className="w-full p-3 rounded border border-gray-300" placeholder="Add a new todo"/>
                            <Task />
                        </div>
                    </div>
            </div>
        </div>
    );
}

export default Todos;

if (document.getElementById('app')) {
    ReactDOM.render(<Todos />, document.getElementById('app'));
}
