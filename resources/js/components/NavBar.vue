<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
      <router-link to="/" class="navbar-brand">Início</router-link>
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbar"
        aria-controls="navbar"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <router-link to="/funcionarios" class="nav-link">Funcionários</router-link>
          </li>
          <li class="nav-item">
            <router-link to="/departamentos" class="nav-link">Departamentos</router-link>
          </li>
        </ul>
      </div>
    </nav>
  </div>
</template>

<script>
export default {};
</script>

<style>
</style>