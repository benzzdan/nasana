<template>
    <nav class="navbar is-dark" role="navigation" aria-label="main navigation">
        <div class="container">
            <div class="navbar-brand">
                <router-link to="/" v-if="!$auth.check()">
                    <a id="logo" class="handwritting">Nasana</a>
                </router-link>
                <router-link to="/dashboard" v-if="$auth.check()">
                    <a id="logo" class="handwritting">Nasana</a>
                </router-link>
            </div>
             <div class="navbar-menu">
                <div class="navbar-end">
                    <p class="navbar-item">
                        <router-link v-if="!$auth.check()" to="/register">
                            <a class="button is-light is-outlined navbar-item">Registrarse</a>
                        </router-link>
                    </p>
                    <p class="navbar-item">
                        <router-link to="/login" v-if="!$auth.check()">
                            <a class="button is-light is-outlined navbar-item">Iniciar Sesión</a>
                        </router-link>
                    </p>
                    <div v-if="$auth.check()" class="dropdown navbar-item is-right">
  <div class="dropdown-trigger">
      <a class="icon is-medium" style="color: #fff; font-size: 1.5rem">
        <i class="fa fa-user-circle-o" aria-hidden="true"></i>
      </a>
  </div>
  <div class="dropdown-menu" id="dropdown-menu3" role="menu">
    <div class="dropdown-content">
        <router-link to="/cuenta">
            <a class="dropdown-item">
                Mi Cuenta
            </a>
        </router-link>
        <hr class="dropdown-divider">
        <a @click.prevent="debouncedLogOut" class="dropdown-item">
            Cerrar Sesión
        </a>
    </div>
  </div>
</div>
                </div>
            </div>
        </div>
    </nav>

</template>
<style scope>
    .level:not(:last-child) {
        margin: unset !important;
    }
    #logo {
        position: absolute;
        margin: 0 auto;
        width: 100%;
        text-align: center;
        color: #fff;
    }
    .navbar {
        min-height: 3.70rem !important;
    }
</style>
<script>
import _ from 'lodash'
import $ from 'jquery'

    export default {
      data(){
          return {
              isActive : false
          }
      },
      methods: {
          debouncedLogOut: _.debounce(function(e){
              this.$auth.logout()
          }, 1000)

      }
    }

//Cierra el Dropdown de usuario

    let last_drop_open = undefined;
        document.addEventListener('click', function (el) {
            let target = el.target;
            if (target.closest('.dropdown-trigger')) {
                last_drop_open = target.closest('.dropdown');
                last_drop_open.classList.toggle('is-active');
            } else if (last_drop_open) {
                last_drop_open.classList.remove('is-active');
            }
        })
</script>

