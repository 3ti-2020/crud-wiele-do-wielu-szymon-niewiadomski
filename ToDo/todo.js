class Task{
    constructor(name){
        this.id = this.generateID();
        this.name = name;
    }

    generateID(){
        return Date.now();
    }
}

const todoList = {
    tasksList: document.querySelector('.tasks'),
    tasksArray: [],
    taskInput: document.querySelector('.task-input'),
    addButton: document.querySelector('.add-button'),
    init(){
        this.addButton.addEventListener('click', ()=>this.addTask());
    },
    addTask(){
        const name = this.taskInput.value;
        if(name.trim().length == 0) return;

        const task = new Task(name);
        this.tasksArray.push(task);
        this.appendTask(task);
        this.tasksArray.value = "";
    },
    appendTask(task){
        const li = document.createElement('li');
        li.classList.add('task');
        li.innerText = task.name;
        li.setAttribute('data-id', task.id);

        const removeButton = document.createElement('button');
        removeButton.innerText = "Usuń";
        removeButton.classList.add('remove-button');
        removeButton.addEventListener('click', ()=>{
            const id = li.getAttribute('data-id');
            this.removeTask(id);
        });
        li.append(removeButton);

        this.tasksList.append(li);
    },
    removeTask(id){
        document.querySelector(`li[data-id="${id}"]`).remove();
        this.tasksArray = this.tasksArray.filter(task=> task.id != id);
    }
}

todoList.init();