<template>
    <div class="max-w-2xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Todo List</h1>

        <!-- Add Todo Form -->
        <form @submit.prevent="addTodo" class="mb-8">
            <div class="flex gap-2">
                <input
                    v-model="newTodo"
                    type="text"
                    placeholder="What needs to be done?"
                    class="flex-1 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    :class="{ 'border-red-500': error }"
                />
                <button
                    type="submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                    Add
                </button>
            </div>
            <p v-if="error" class="mt-2 text-red-500 text-sm">{{ error }}</p>
        </form>

        <!-- Todo List -->
        <div v-if="todos.length > 0" class="space-y-2">
            <div
                v-for="todo in todos"
                :key="todo.id"
                class="flex items-center gap-4 p-4 bg-white rounded-lg shadow"
            >
                <input
                    type="checkbox"
                    :checked="todo.is_completed"
                    @change="toggleTodo(todo)"
                    class="h-5 w-5 rounded border-gray-300 text-blue-500 focus:ring-blue-500"
                />
                <span
                    class="flex-1"
                    :class="{ 'line-through text-gray-400': todo.is_completed }"
                >
                    {{ todo.description }}
                </span>
                <button
                    @click="deleteTodo(todo)"
                    class="text-red-500 hover:text-red-700 focus:outline-none"
                >
                    Delete
                </button>
            </div>
        </div>
        <p v-else class="text-center text-gray-500">
            No todos yet. Add one above!
        </p>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

const todos = ref([]);
const newTodo = ref("");
const error = ref("");

// Fetch all todos
const fetchTodos = async () => {
    try {
        const response = await axios.get("/api/todos");
        todos.value = response.data;
    } catch (err) {
        error.value = "Failed to load todos";
    }
};

// Add new todo
const addTodo = async () => {
    if (!newTodo.value.trim()) {
        error.value = "Please enter a todo description";
        return;
    }

    try {
        const response = await axios.post("/api/todos", {
            description: newTodo.value,
        });
        todos.value.unshift(response.data);
        newTodo.value = "";
        error.value = "";
    } catch (err) {
        error.value = err.response?.data?.message || "Failed to add todo";
    }
};

// Toggle todo completion
const toggleTodo = async (todo) => {
    try {
        const response = await axios.put(`/api/todos/${todo.id}`);
        const index = todos.value.findIndex((t) => t.id === todo.id);
        todos.value[index] = response.data;
    } catch (err) {
        error.value = "Failed to update todo";
    }
};

// Delete todo
const deleteTodo = async (todo) => {
    try {
        await axios.delete(`/api/todos/${todo.id}`);
        todos.value = todos.value.filter((t) => t.id !== todo.id);
    } catch (err) {
        error.value = "Failed to delete todo";
    }
};

// Load todos when component mounts
onMounted(fetchTodos);
</script>
