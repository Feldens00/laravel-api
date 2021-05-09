<template>
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light mt-4">
      <div class="collapse navbar-collapse">
        <div class="navbar-nav">
          <router-link to="/" class="nav-item nav-link" >Inicio <i class="fas fa-home"></i></router-link>
          <router-link to="/add" class="nav-item nav-link">Adicionar Pessoa <i class="fas fa-user-plus"></i></router-link>
        </div>
      </div>
    </nav>
    <br />
    <router-view></router-view>
  </div>
</template>
 
<script>
export default {};
</script>