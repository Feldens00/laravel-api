<template>
  <div class="container">
    <nav class="navbar navbar-expand-md bg-dark navbar-dark mt-4">
      <router-link to="/" class="navbar-brand" >Inicio <i class="fas fa-home"></i></router-link>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
          <li class="nav-item">
            <router-link to="/add" class="nav-link">Adicionar Pessoa <i class="fas fa-user-plus"></i></router-link>
          </li>  
        </ul>
      </div>  
    </nav>
    <br />
    <router-view></router-view>
  </div>
</template>
 
<script>
export default {};
</script>