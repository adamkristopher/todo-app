<template>
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-2xl shadow-xl">
        <h1
            class="text-3xl font-bold mb-8 text-transparent bg-clip-text bg-gradient-to-r from-violet-600 to-indigo-600"
        >
            Todo List
        </h1>

        <!-- Add Todo Form -->
        <form @submit.prevent="addTodo" class="mb-8">
            <div class="flex gap-3">
                <input
                    v-model="newTodo"
                    type="text"
                    placeholder="What needs to be done?"
                    class="flex-1 px-6 py-3 border-2 border-violet-100 rounded-xl focus:outline-none focus:border-violet-300 focus:ring-2 focus:ring-violet-200 transition-all duration-200 placeholder:text-gray-400"
                    :class="{ 'border-red-300': error }"
                />
                <button
                    type="submit"
                    class="px-8 py-3 bg-gradient-to-r from-violet-500 to-indigo-500 text-white rounded-xl hover:from-violet-600 hover:to-indigo-600 focus:outline-none focus:ring-2 focus:ring-violet-300 transition-all duration-200 shadow-lg hover:shadow-xl"
                >
                    Add
                </button>
            </div>
            <p v-if="error" class="mt-2 text-red-500 text-sm">{{ error }}</p>
        </form>

        <!-- Todo List -->
        <div v-if="todos.length > 0" class="space-y-3">
            <div
                v-for="todo in todos"
                :key="todo.id"
                class="flex items-center gap-4 p-5 bg-gradient-to-r from-violet-50 to-indigo-50 rounded-xl shadow-sm hover:shadow-md transition-all duration-200"
                :class="{ 'opacity-75': todo.is_completed }"
            >
                <input
                    type="checkbox"
                    :checked="todo.is_completed"
                    @change="toggleTodo(todo)"
                    class="h-5 w-5 rounded-lg border-violet-300 text-violet-500 focus:ring-violet-400 transition-all duration-200"
                />
                <span
                    class="flex-1 text-gray-700"
                    :class="{ 'line-through text-gray-400': todo.is_completed }"
                >
                    {{ todo.description }}
                </span>
                <button
                    @click="deleteTodo(todo)"
                    class="px-4 py-1.5 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all duration-200"
                >
                    Delete
                </button>
            </div>
        </div>
        <p v-else class="text-center text-gray-500 py-12">
            ✨ No todos yet. Add one above! ✨
        </p>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";

// State
const todos = ref([]);
const newTodo = ref("");
const error = ref("");

// Fetch todos
const fetchTodos = async () => {
    try {
        const response = await axios.get("/api/todos", {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                Accept: "application/json",
                "X-CSRF-TOKEN": document.querySelector(
                    'meta[name="csrf-token"]'
                ).content,
            },
            withCredentials: true,
        });
        todos.value = response.data;
    } catch (err) {
        error.value = "Failed to load todos";
        console.error(err);
    }
};

// Add todo
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
