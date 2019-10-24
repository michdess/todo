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
            newTodoDue: moment().format('DD-MM-YYYY'),
            filter: 'all',
            sort: 'created',
        };
        this.dateRef = React.createRef();
    }
    componentDidMount() {
        axios.get(`/todos`)
          .then(result => {
            const tasks = result.data;
            this.setState({ tasks });
          });
        new Pikaday({
          field: this.dateRef.current,
          format: 'DD/MM/YYYY',
          onSelect: this.onChangeStart
        });          
    }
    handleChange = e => {
        this.setState({ newTodo: e.target.value });
    }
    handleDateChange = e => {
        this.setState({ newTodoDue: e.target.value });
    }
    onChangeStart = e =>{
        this.setState({ newTodoDue: moment(e).format('YYYY-MM-DD')});
    }
    handleSubmit = (e) =>{
        e.preventDefault();
        axios.post(`/todo`, { body: this.state.newTodo, due: moment(this.state.newTodoDue).format('YYYY-MM-DD') })
          .then(result => {
            this.setState(state => ({
              tasks: state.tasks.concat(result.data),
              newTodo: '',
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
    handleFilter = (filter) => {
        this.setState(state => ({
          filter: filter,
        }));
    }
    handleSort = (sort) => {
        this.setState(state => ({
          sort: sort,
        }));
    }
    render() {
        const filter = this.state.filter
        const sort = this.state.sort
        let tasks;

        if(sort === 'created'){
          tasks =  this.state.tasks.sort((a,b) => a.id - b.id);
        } else if(sort === 'first'){
          tasks =  this.state.tasks.sort((a,b) => moment(a.due) - moment(b.due));
        } else {
          tasks =  this.state.tasks.sort((a,b) => moment(b.due) - moment(a.due));      
        }

        if (filter == 'all') {
          tasks =  this.state.tasks.map(todo => <Task key={todo.id} task={todo} delete={this.onDelete} complete={this.onComplete}/> );
        } else if (filter == 'completed'){
          tasks =  this.state.tasks.map(todo => todo.completed != null ? <Task key={todo.id} task={todo} delete={this.onDelete} complete={this.onComplete}/> : null );
        } else {
            tasks =  this.state.tasks.map(todo => todo.completed == null ? <Task key={todo.id} task={todo} delete={this.onDelete} complete={this.onComplete}/> : null );
        }

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
                                <form className="flex" onSubmit={this.handleSubmit}>
                                    <input className="w-full p-3 rounded-bl rounded-tl border border-gray-300" type="text" name="newTodo" onChange={this.handleChange} value={this.state.newTodo} placeholder="Add a new todo..."/>
                                    <input className="w-1/4 p-3 border border-gray-300" type='text' name="due" ref={this.dateRef} value={this.state.newTodoDue} onChange={this.handleDateChange} placeholder="Due on:"/>
                                    <button className="p-3 border rounded-br rounded-tr text-white bg-green-500 text-2xl" type="submit">+</button>
                                </form>
                                <hr className="my-3"/>
                                <div className="flex items-center">
                                    <p className="uppercase text-gray-500 text-sm">Filter by:</p>
                                    <div className="flex justify-center my-2"><button className="px-2 uppercase text-gray-500 text-sm" onClick={() => this.handleFilter('all')}>All</button><button className="px-2 uppercase text-gray-500 text-sm" onClick={() => this.handleFilter('completed')}>Complete</button><button className="px-2 uppercase text-gray-500 text-sm" onClick={() => this.handleFilter('incomplete')}>Incomplete</button></div>
                                </div>
                                <div className="flex items-center">
                                    <p className="uppercase text-gray-500 text-sm">Order by:</p>
                                    <div className="flex justify-center my-2"><button className="px-2 uppercase text-gray-500 text-sm" onClick={() => this.handleSort('created')}>Created</button><button className="px-2 uppercase text-gray-500 text-sm" onClick={() => this.handleSort('first')}>Due First</button><button className="px-2 uppercase text-gray-500 text-sm" onClick={() => this.handleSort('last')}>Due Last</button></div>
                                </div>
                                {tasks}
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
