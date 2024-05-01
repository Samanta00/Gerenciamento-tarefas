<script setup>
  const getYear = () => (new Date().getFullYear());
</script>

<template>
  <footer class="mt-5 p-4 text-center">
    {{getYear()}}- &copy; 
    <a>
      <strong>Portfólio Ellen Samanta</strong>
    </a> - Todos os direitos reservados
  </footer>
</template>

<style scoped>
  footer a {
    text-decoration: none;
    color: black;
    transition: all ease-in-out .2s;
  }

  footer a:hover {
    text-decoration: none;
    color: #155956;
    transition: all ease-in-out .2s;
  }
</style>