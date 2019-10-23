import React from 'react';
import ReactDOM from 'react-dom';
import moment from 'moment';
import axios from 'axios';
import Pikaday from 'pikaday';
import { Task } from "./Task";

export class Todos extends React.Component {
    constructor(props) {
        super(props);
        this.state = { 
            tasks: [],
            newTodo: '', 
        };
        this.myRef = React.createRef();
    }
    componentDidMount() {
        axios.get(`/todos`)
          .then(result => {
            const tasks = result.data;
            this.setState({ tasks });
          });
        new Pikaday({
          field: this.myRef.current,
          format: 'DD/MM/YYYY',
          onSelect: this.onChangeStart
        });          
    }
    handleChange = e => {
        this.setState({ newTodo: e.target.value });
    }
    handleSubmit = (e) =>{
        e.preventDefault();
        axios.post(`/todo`, { body: this.state.newTodo, due: moment().format('YYYY-MM-DD') })
          .then(result => {
            console.log(result);
            console.log(result.data);
            this.setState(state => ({
              tasks: state.tasks.concat(result.data),
              newTodo: ''
            }));
          })
    }
    onDelete = taskId => {
        axios.delete(`todo/${taskId}`)
          .then(result => {
                this.setState(state => ({
                  tasks: state.tasks.filter(task => task.id != taskId),
                }));
          })
    }
    onComplete = (taskId, complete) => {
        axios.patch(`todo/${taskId}`, { completed: complete != null ? null : moment().format('YYYY-MM-DD') })
          .then(result => {
            let tasks = this.state.tasks.map(task => task.id === taskId ? task = result.data : task)
                this.setState(state => ({
                  tasks: tasks,
                }));
          })
    }
    render() {
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
                                <input type='text' ref={this.myRef} />
                                <form onSubmit={this.handleSubmit}>
                                    <input className="w-full p-3 rounded border border-gray-300" type="text" name="newTodo" onChange={this.handleChange} value={this.state.newTodo} placeholder="Add a new todo..."/>
                                </form>
                                <div>Filter:...</div>
                                {this.state.tasks.map(todo => <Task key={todo.id} task={todo} delete={this.onDelete} complete={this.onComplete}/> )}
                            </div>
                        </div>
                </div>
            </div>
        );
    }
}

export default Todos;

if (document.getElementById('app')) {
    ReactDOM.render(<Todos />, document.getElementById('app'));
}
