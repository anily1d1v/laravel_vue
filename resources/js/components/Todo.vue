<template>
    <div class="container mt-4">
        <div class="row justify-content-center ">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Todo
                        <button @click="resetData()" class="btn btn-primary btn-sm float-end">Reset</button>
                    </div>

                    <div class="card-body">
                         <ul class="alert alert-warning" v-if="Object.keys(this.errorList).length > 0" > 
                              <li v-for="(error, index) in this.errorList" :key="index">
                               {{ error[0] }}</li>
                       </ul>
                        <div class="input-group">
                            <input v-model="model.todo.name" type="text" name="" placeholder="Todo.." class="form-control">
                            <div class="input-group-append">
                                <button v-if="!edit_todo_id" type="button" @click="saveTodo()" class="btn btn-info text-white">Add</button>
                                <button v-else type="button" @click="updateTodo()" class="btn btn-info text-white">Update</button>
                            </div>
                        </div>

               <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody v-if="this.todos.length > 0">
                        <tr v-for="(todo, index) in this.todos" :key="index">
                              <th>{{ todo.id }}</th>
                              <th>{{ todo.name }}</th>
                              <th>
                                <RouterLink @click="getTodoDetail(todo.id)" class="btn btn-primary btn-sm m-1">Edit</RouterLink>
                                <button @click="deteleRecord(todo.id)" class="btn btn-primary btn-sm" >Delete</button>
                              </th>

                        </tr>   
                    </tbody>
                    <tbody v-else>
                        <tr>
                            <th colspan="7">Loading..</th>
                        </tr>
                     </tbody>
                </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import axios from 'axios'
export default {
    name: 'Todos',
    data() {
        return {
            todos: [],
            errorList: '',
               model: {
                todo: {
                    name: '',
                }
            },
            edit_todo_id:'',
            edit_index:'',
        }
    },
    mounted() {
        this.getTodo();
    },

    methods: {
        getTodo() {
            axios
                .get('http://127.0.0.1:8000/api/todos')
                .then((response) => {
                    this.todos = response.data
                })
        },
        saveTodo() {
            var mythis = this;
            axios
                .post('http://127.0.0.1:8000/api/todos', this.model.todo)
                .then((res) => {
                    alert(res.data.message);
                    this.model.todo = {
                        name: '',
                    }
                    this.errorList = '';
                    this.getTodo();
                })

                .catch(function (error) {
                    if (error.response) {
                        if (error.response.status == 422) {

                            mythis.errorList = error.response.data.errors;
                        }
                    } else if (error.request) {
                    } else {
                        console.log('Error', error.message);
                    }
                    console.log(error.config);
                });


        },
        getTodoDetail(id) {
            axios
                .get(`http://127.0.0.1:8000/api/todos/${id}/edit`)
                .then(response => {
                    this.model.todo.name = response.data.data[0].name;
                    this.edit_todo_id = id;
                })
                .catch(function (error) {
                    if (error.response) {
                        if (error.response.status == 404) {
                            alert('Student Id Not Fount')
                        }
                    }
                });
        },
        resetData() {
            this.edit_todo_id = '';
            this.model.todo.name = '';
        },

        updateTodo() {
            var todo_id = this.edit_todo_id
            var mythis = this;
            axios
                .put(`http://127.0.0.1:8000/api/todos/${todo_id}/edit`, this.model.todo)
                .then((res) => {
                    alert(res.data.message);
                    this.errorList = '';
                    this.getTodo();
                    this.resetData();
                })

                .catch(function (error) {
                    if (error.response) {
                        if (error.response.status == 422) {

                            mythis.errorList = error.response.data.errors;
                        }
                        if (error.response.status == 404) {
                            alert(error.response.data.message);
                        }
                    } else if (error.request) {
                    } else {
                        console.log('Error', error.message);
                    }
                    console.log(error.config);
                });


        },
        deteleRecord(id) {
            if (confirm('Are you sure, you want to delete this data?')) {
                axios
                    .delete(`http://127.0.0.1:8000/api/todos/${id}/destroy`)
                    .then(response => {
                        alert(response.data.message);
                        this.getTodo();
                    })
                    .catch(function (error) {
                        if (error.response) {
                            if (error.response.status == 404) {
                                alert('Todo Id Not Fount')
                            }
                        }
                    });
            }

        }
    }

}
</script>
