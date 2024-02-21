@php 
  $authAuth = auth()->user();
  $todos = $authAuth->todos;

@endphp

<fieldset class="border-slate-500/50 border p-4 rounded-md my-4" x-data="{todo:null}">

  <legend class="font-bold">
    Todo List 
  </legend>
  <ul>
    @foreach($todos as $n => $todo)
    <li class="flex items-center gap-2"><input x-on:change="updateTodoList" value="{{$todo->id}}" type="checkbox" class="peer checkbox" id="todo{{$todo->id}}"> <label for="todo{{$todo->id}}" class="flex-1 peer-checked:line-through peer-checked:opacity-45 cursor-pointer">{{$todo->title}}</label></li>
    @endforeach
  </ul>
  
  <div>
    <form action="/todo/add" method="post" class="flex items-center gap-2 w-full justify-between">
      @csrf
      <input x-on:change="todo=$el.value" type="text" name="todo" placeholder="Title of Todo" class="input flex-1"/> <button x-on:click="submitTodo" type="submit" class="btn-primary">Save Todo</button>
    </form>
  </div>
</fieldset>