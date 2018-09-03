<template>
     <section class="hero is-dark is-small">
    <div class="hero-body">
        <div class="container">
            <!-- <h1 class="title">
                Bienvenidos a NASANA
            </h1>
            <h3 class="subtitle">
                v1.0
            </h3> -->
        </div>
        <!-- Main container -->
        <nav class="level">
        <!-- Left side -->
        <div class="level-left">
            <div class="navbar-brand">
                <router-link to="/">
                    <a class="handwritting">Nasana</a>
                </router-link>
            </div>
        </div>

        <!-- Right side -->
        <div class="level-right" style="margin-left: auto; margin-right: 0">
            <p class="level-item">
                <router-link v-if="!$auth.check()" to="/register">
                    <a class="button is-light is-outlined">Registrarse</a>
                </router-link>

            </p>
            <p class="level-item">
                <router-link to="/login" v-if="!$auth.check()">
                    <a class="button is-light is-outlined">Iniciar Sesión</a>
                </router-link>
            </p>
            <p class="level-item">
                <router-link to="/logout" v-if="$auth.check()">
                    <a class="button is-light is-outlined" @click.prevent="debouncedLogOut">Cerrar Sesión</a>
                </router-link>
            </p>
        </div>
        </nav>
    </div>
    </section>
</template>
<script>
import _ from 'lodash'

    export default {
      data(){
          return {

          }
      },
      methods: {
          debouncedLogOut: _.debounce(function(e){
              this.$auth.logout()
          }, 1000)

      }
    }
</script>


