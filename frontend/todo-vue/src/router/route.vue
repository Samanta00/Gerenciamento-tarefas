<script setup>

import { createRouter, createWebHistory } from 'vue-router';
import TelaInicio from '../components/TelaInicio.vue';
import Formulario from '../components/Formulario.vue';
import ListaDeTarefas from '../components/ListaDeTarefas.vue';
import Footer from '../components/Footer.vue';
import Cadastro from '../components/Cadastro.vue';
import Login from '../components/Login.vue'

const router = createRouter({
  history: createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'Inicial',
      component: TelaInicio,
      meta: { requiresAuth: false } // Rota pública
    },
    {
      path: '/formulario',
      name: 'Formulario',
      component: Formulario,
      meta: { requiresAuth: false } // Rota privada
    },
    {
      path: '/lista-de-tarefas',
      name: 'ListaDeTarefas',
      component: ListaDeTarefas,
      meta: { requiresAuth: false } // Rota privada
    },
  ],
});


router.beforeEach((to, from, next) => {
  const isAuthenticated = true

  if (to.meta.requiresAuth && !isAuthenticated) {
    next('/');
  } else {
    console.log("usuário não autenticado")
    next();
  }
});




</script>


<template>
  <div class="container">
    <!-- Conteúdo da tela inicial aqui -->
    <Login/>
  </div>
</template>
