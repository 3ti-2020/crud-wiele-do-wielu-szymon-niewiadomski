class Task{
    constructor(name, doned = false){
        this.id = this.generateID();
        this.name = name;
        this.doned = doned;
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
        this.addTask('Dodać ciasteczka');
        this.addTask('Wynieść śmieci', true);
        
        this.addButton.addEventListener('click', this.eventInput.bind(this));
        this.taskInput.addEventListener('keydown', e=>{
            if(e.key == 'Enter')
                this.eventInput();
        });
    },
    addTask(name, doned = false){
        const task = new Task(name, doned);
        this.tasksArray.push(task);
        this.appendTask(task);
    },
    appendTask(task){
        const li = document.createElement('li');
        li.classList.add('task');
        li.innerText = task.name;
        li.setAttribute('data-id', task.id);

        if(task.doned) li.classList.add('doned');
        li.addEventListener('click', ()=>{ this.switchTask(li); });

        const removeButton = document.createElement('button');
        removeButton.innerText = "Usuń";
        removeButton.classList.add('remove-button');
        removeButton.addEventListener('click', ()=>{ this.removeTask(li); });
        
        li.append(removeButton);
        this.tasksList.append(li);
    },
    appendTask(task){
        const li = document.createElement('li');
        const innerElement = document.querySelector('#templateTask').content.cloneNode(true);
        li.append(innerElement);
        li.classList.add('task');
        li.setAttribute('title', task.name);
        li.setAttribute('data-id', task.id);
        li.querySelector('.task__name').innerText = task.name;

        if(task.doned) li.classList.add('doned');
        li.addEventListener('click', ()=>{ this.switchTask(li); });

        const removeButton = li.querySelector('.task__remove-button');
        removeButton.addEventListener('click', ()=>{ this.removeTask(li); });

        this.tasksList.append(li);
    },
    removeTask(li){
        const id = li.getAttribute('data-id');
        li.remove();
        this.tasksArray = this.tasksArray.filter(task=> task.id != id);
    },
    switchTask(li){
        li.classList.toggle('doned');
        const id = li.getAttribute('data-id');
        const task = this.tasksArray.find(task => task.id == id);
        task.doned = !task.doned;
    },
    eventInput(){
        const name = this.taskInput.value;
        if(name.trim().length == 0) return;
        this.addTask(name);

        this.taskInput.value ="";
        this.taskInput.focus();
    }
}

todoList.init();
console.log(document.cookie);